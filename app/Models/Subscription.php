<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'profile_id',
        'plan_id',
        'plan_name',
        'plan_type', // free, basic, premium, vip
        'amount',
        'currency',
        'billing_cycle', // monthly, quarterly, yearly, lifetime
        'starts_at',
        'ends_at',
        'renewal_date',
        'status', // active, expired, cancelled, pending
        'payment_method',
        'transaction_id',
        'payment_status',
        'payment_gateway',
        'gateway_response',
        'features',
        'is_auto_renew',
        'cancelled_at',
        'cancellation_reason',
        'notes',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'renewal_date' => 'datetime',
        'cancelled_at' => 'datetime',
        'features' => 'array',
        'gateway_response' => 'array',
        'is_auto_renew' => 'boolean',
        'is_trial' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Plan types
    const PLAN_FREE = 'free';
    const PLAN_BASIC = 'basic';
    const PLAN_PREMIUM = 'premium';
    const PLAN_VIP = 'vip';

    // Billing cycles
    const CYCLE_MONTHLY = 'monthly';
    const CYCLE_QUARTERLY = 'quarterly';
    const CYCLE_YEARLY = 'yearly';
    const CYCLE_LIFETIME = 'lifetime';

    // Statuses
    const STATUS_ACTIVE = 'active';
    const STATUS_EXPIRED = 'expired';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_PENDING = 'pending';
    const STATUS_FAILED = 'failed';

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    // Accessors
    public function getIsActiveAttribute()
    {
        return $this->status === self::STATUS_ACTIVE && 
               $this->ends_at > now();
    }

    public function getDaysRemainingAttribute()
    {
        if (!$this->is_active) {
            return 0;
        }
        return now()->diffInDays($this->ends_at);
    }

    public function getFormattedAmountAttribute()
    {
        return $this->currency . ' ' . number_format($this->amount, 2);
    }

    public function getPlanFeaturesAttribute()
    {
        $features = $this->features ?: [];
        
        // Default features based on plan type
        $defaultFeatures = config("subscription.plans.{$this->plan_type}.features", []);
        
        return array_merge($defaultFeatures, $features);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE)
                     ->where('ends_at', '>', now());
    }

    public function scopeExpired($query)
    {
        return $query->where(function($q) {
            $q->where('status', self::STATUS_EXPIRED)
              ->orWhere(function($q2) {
                  $q2->where('status', self::STATUS_ACTIVE)
                     ->where('ends_at', '<=', now());
              });
        });
    }

    public function scopeByPlanType($query, $planType)
    {
        return $query->where('plan_type', $planType);
    }

    public function scopePremium($query)
    {
        return $query->whereIn('plan_type', [self::PLAN_PREMIUM, self::PLAN_VIP]);
    }

    public function scopeExpiringSoon($query, $days = 7)
    {
        return $query->active()
                     ->whereBetween('ends_at', [now(), now()->addDays($days)]);
    }

    public function scopeRecent($query, $months = 3)
    {
        return $query->where('created_at', '>=', now()->subMonths($months));
    }

    // Methods
    public function activate()
    {
        $this->update([
            'status' => self::STATUS_ACTIVE,
            'starts_at' => now(),
            'ends_at' => $this->calculateEndDate(),
        ]);

        // Update profile premium status
        if ($this->profile) {
            $this->profile->update([
                'is_premium' => true,
                'premium_expiry' => $this->ends_at,
            ]);
        }

        return $this;
    }

    public function cancel($reason = null)
    {
        $this->update([
            'status' => self::STATUS_CANCELLED,
            'cancelled_at' => now(),
            'cancellation_reason' => $reason,
            'is_auto_renew' => false,
        ]);

        return $this;
    }

    public function renew()
    {
        if (!$this->is_auto_renew) {
            return false;
        }

        $newSubscription = self::create([
            'user_id' => $this->user_id,
            'profile_id' => $this->profile_id,
            'plan_id' => $this->plan_id,
            'plan_name' => $this->plan_name,
            'plan_type' => $this->plan_type,
            'amount' => $this->amount,
            'currency' => $this->currency,
            'billing_cycle' => $this->billing_cycle,
            'payment_method' => $this->payment_method,
            'is_auto_renew' => true,
            'status' => self::STATUS_PENDING,
        ]);

        return $newSubscription;
    }

    protected function calculateEndDate()
    {
        $startDate = $this->starts_at ?: now();
        
        switch ($this->billing_cycle) {
            case self::CYCLE_MONTHLY:
                return $startDate->addMonth();
            case self::CYCLE_QUARTERLY:
                return $startDate->addMonths(3);
            case self::CYCLE_YEARLY:
                return $startDate->addYear();
            case self::CYCLE_LIFETIME:
                return $startDate->addYears(100); // Basically lifetime
            default:
                return $startDate->addMonth();
        }
    }

    public static function createFreeSubscription($userId, $profileId)
    {
        return self::create([
            'user_id' => $userId,
            'profile_id' => $profileId,
            'plan_type' => self::PLAN_FREE,
            'plan_name' => 'Free Plan',
            'amount' => 0,
            'currency' => 'INR',
            'billing_cycle' => self::CYCLE_MONTHLY,
            'starts_at' => now(),
            'ends_at' => now()->addYears(100), // Free plan never expires
            'status' => self::STATUS_ACTIVE,
            'features' => config('subscription.plans.free.features'),
        ]);
    }

    public function upgradeTo($newPlanType, $paymentData = [])
    {
        // Create new subscription
        $newSubscription = self::create([
            'user_id' => $this->user_id,
            'profile_id' => $this->profile_id,
            'plan_type' => $newPlanType,
            'plan_name' => ucfirst($newPlanType) . ' Plan',
            'amount' => config("subscription.plans.{$newPlanType}.price"),
            'currency' => 'INR',
            'billing_cycle' => $this->billing_cycle,
            'payment_method' => $paymentData['payment_method'] ?? null,
            'transaction_id' => $paymentData['transaction_id'] ?? null,
            'payment_status' => 'success',
            'payment_gateway' => $paymentData['gateway'] ?? null,
            'gateway_response' => $paymentData['response'] ?? null,
            'features' => config("subscription.plans.{$newPlanType}.features"),
            'status' => self::STATUS_ACTIVE,
            'starts_at' => now(),
            'ends_at' => $this->calculateEndDate(),
            'is_auto_renew' => $paymentData['auto_renew'] ?? true,
        ]);

        // Cancel old subscription
        $this->cancel('Upgraded to ' . $newPlanType);

        return $newSubscription;
    }
}