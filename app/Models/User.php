<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
        'profile_type',
        'avatar',
        'settings',
        'last_login_at',
        'last_login_ip',
        'is_active'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'settings' => 'array',
        'last_login_at' => 'datetime',
        'is_active' => 'boolean'
    ];

    // Relationships
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function shortlists()
    {
        return $this->hasMany(Shortlist::class);
    }

    public function sentInterests()
    {
        return $this->hasManyThrough(Interest::class, Profile::class, 'user_id', 'sender_id');
    }

    public function receivedInterests()
    {
        return $this->hasManyThrough(Interest::class, Profile::class, 'user_id', 'receiver_id');
    }

    public function approvedProfiles()
    {
        return $this->hasMany(Profile::class, 'approved_by');
    }

    public function resolvedReports()
    {
        return $this->hasMany(ProfileReport::class, 'resolved_by');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }

    public function scopeModerators($query)
    {
        return $query->where('role', 'moderator');
    }

    public function scopeRegularUsers($query)
    {
        return $query->where('role', 'user');
    }

    // Methods
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isModerator()
    {
        return $this->role === 'moderator';
    }

    public function isParent()
    {
        return $this->role === 'parent';
    }

    public function getAvatarUrl()
    {
        if ($this->avatar) {
            return asset('storage/avatars/' . $this->avatar);
        }
        
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7F9CF5&background=EBF4FF';
    }

    public function updateLastLogin($ip)
    {
        $this->update([
            'last_login_at' => now(),
            'last_login_ip' => $ip
        ]);
    }

    public function hasProfile()
    {
        return $this->profile()->exists();
    }
}
