<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileView extends Model
{
    use HasFactory;

    protected $fillable = [
        'viewer_id',
        'profile_id',
        'ip_address',
        'user_agent',
        'referrer',
        'is_premium_viewer',
        'viewed_at',
        'session_id',
        'country',
        'city',
        'device_type',
        'time_spent_seconds',
        'source_type', // direct, search, suggested, match, etc.
    ];

    protected $casts = [
        'is_premium_viewer' => 'boolean',
        'viewed_at' => 'datetime',
        'time_spent_seconds' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function viewer()
    {
        return $this->belongsTo(Profile::class, 'viewer_id');
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }

    // Accessors
    public function getTimeSpentFormattedAttribute()
    {
        $seconds = $this->time_spent_seconds;
        if ($seconds < 60) {
            return "{$seconds} seconds";
        } elseif ($seconds < 3600) {
            $minutes = floor($seconds / 60);
            return "{$minutes} minutes";
        } else {
            $hours = floor($seconds / 3600);
            $minutes = floor(($seconds % 3600) / 60);
            return "{$hours}h {$minutes}m";
        }
    }

    public function getIsRecentAttribute()
    {
        return $this->viewed_at->diffInHours(now()) < 24;
    }

    // Scopes
    public function scopeToday($query)
    {
        return $query->whereDate('viewed_at', today());
    }

    public function scopeThisWeek($query)
    {
        return $query->whereBetween('viewed_at', [now()->startOfWeek(), now()->endOfWeek()]);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('viewed_at', now()->month)
                     ->whereYear('viewed_at', now()->year);
    }

    public function scopeByViewer($query, $viewerId)
    {
        return $query->where('viewer_id', $viewerId);
    }

    public function scopePremiumViews($query)
    {
        return $query->where('is_premium_viewer', true);
    }

    public function scopeUniqueViews($query)
    {
        return $query->selectRaw('profile_id, viewer_id, MAX(viewed_at) as last_viewed_at, COUNT(*) as view_count')
                     ->groupBy('profile_id', 'viewer_id');
    }

    public function scopeWithDetails($query)
    {
        return $query->with(['viewer.user', 'profile.user']);
    }

    // Methods
    public function recordTimeSpent($seconds)
    {
        $this->update(['time_spent_seconds' => $seconds]);
        return $this;
    }

    public static function trackView($profileId, $viewerId = null, $request = null)
    {
        $view = self::create([
            'viewer_id' => $viewerId,
            'profile_id' => $profileId,
            'ip_address' => $request ? $request->ip() : null,
            'user_agent' => $request ? $request->userAgent() : null,
            'referrer' => $request ? $request->header('referer') : null,
            'is_premium_viewer' => $viewerId ? Profile::find($viewerId)?->is_premium : false,
            'viewed_at' => now(),
            'session_id' => $request ? session()->getId() : null,
        ]);

        // Update profile views count
        $profile = Profile::find($profileId);
        if ($profile) {
            $profile->incrementViews();
        }

        return $view;
    }

    // Calculate analytics methods
    public static function getProfileViewStats($profileId, $period = 'month')
    {
        $query = self::where('profile_id', $profileId);
        
        switch ($period) {
            case 'today':
                $query->today();
                break;
            case 'week':
                $query->thisWeek();
                break;
            case 'month':
                $query->thisMonth();
                break;
            case 'year':
                $query->whereYear('viewed_at', now()->year);
                break;
        }

        return [
            'total_views' => $query->count(),
            'unique_viewers' => $query->distinct('viewer_id')->count(),
            'premium_views' => $query->premiumViews()->count(),
            'average_time_spent' => $query->avg('time_spent_seconds'),
        ];
    }
}