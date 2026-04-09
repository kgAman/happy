<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'profile_id',
        'type',
        'title',
        'message',
        'data',
        'is_read',
        'read_at',
        'action_url',
        'priority',
        'expires_at',
        'sent_via', // email, sms, push, in-app
        'sent_at',
    ];

    protected $casts = [
        'data' => 'array',
        'is_read' => 'boolean',
        'read_at' => 'datetime',
        'expires_at' => 'datetime',
        'sent_at' => 'datetime',
        'priority' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Notification types
    const TYPE_INTEREST_RECEIVED = 'interest_received';
    const TYPE_INTEREST_ACCEPTED = 'interest_accepted';
    const TYPE_MESSAGE_RECEIVED = 'message_received';
    const TYPE_PROFILE_VIEW = 'profile_view';
    const TYPE_MATCH_SUGGESTION = 'match_suggestion';
    const TYPE_PROFILE_APPROVED = 'profile_approved';
    const TYPE_PROFILE_REJECTED = 'profile_rejected';
    const TYPE_PAYMENT_SUCCESS = 'payment_success';
    const TYPE_SUBSCRIPTION_EXPIRY = 'subscription_expiry';
    const TYPE_REPORT_RESOLVED = 'report_resolved';
    const TYPE_SYSTEM_ANNOUNCEMENT = 'system_announcement';

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    // Scopes
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeHighPriority($query)
    {
        return $query->where('priority', '>=', 3);
    }

    public function scopeActive($query)
    {
        return $query->where(function($q) {
            $q->whereNull('expires_at')
              ->orWhere('expires_at', '>', now());
        });
    }

    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    // Methods
    public function markAsRead()
    {
        if (!$this->is_read) {
            $this->update([
                'is_read' => true,
                'read_at' => now(),
            ]);
        }
        return $this;
    }

    public function markAsUnread()
    {
        $this->update([
            'is_read' => false,
            'read_at' => null,
        ]);
        return $this;
    }

    public static function sendNotification($userId, $type, $title, $message, $data = [], $profileId = null)
    {
        $notification = self::create([
            'user_id' => $userId,
            'profile_id' => $profileId,
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'data' => $data,
            'priority' => self::getDefaultPriority($type),
            'expires_at' => now()->addDays(7), // Notifications expire after 7 days
        ]);

        return $notification;
    }

    protected static function getDefaultPriority($type)
    {
        $priorityMap = [
            self::TYPE_PAYMENT_SUCCESS => 4,
            self::TYPE_SUBSCRIPTION_EXPIRY => 4,
            self::TYPE_REPORT_RESOLVED => 3,
            self::TYPE_INTEREST_ACCEPTED => 3,
            self::TYPE_PROFILE_APPROVED => 3,
            self::TYPE_PROFILE_REJECTED => 3,
            self::TYPE_INTEREST_RECEIVED => 2,
            self::TYPE_MESSAGE_RECEIVED => 2,
            self::TYPE_PROFILE_VIEW => 1,
            self::TYPE_MATCH_SUGGESTION => 1,
            self::TYPE_SYSTEM_ANNOUNCEMENT => 1,
        ];
        
        return $priorityMap[$type] ?? 2;
    }
}