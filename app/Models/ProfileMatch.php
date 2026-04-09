<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileMatch extends Model
{
    use HasFactory;

    protected $table = 'profile_matches';

    protected $fillable = [
        'profile1_id',
        'profile2_id',
        'match_score',
        'score_details',
        'mutual_interest',
        'is_compatible',
        'last_calculated_at',
    ];

    protected $casts = [
        'match_score' => 'integer',
        'score_details' => 'array',
        'mutual_interest' => 'boolean',
        'is_compatible' => 'boolean',
        'last_calculated_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function profile1()
    {
        return $this->belongsTo(Profile::class, 'profile1_id');
    }

    public function profile2()
    {
        return $this->belongsTo(Profile::class, 'profile2_id');
    }

    // Scopes
    public function scopeHighMatchScore($query, $minScore = 70)
    {
        return $query->where('match_score', '>=', $minScore);
    }

    public function scopeCompatible($query)
    {
        return $query->where('is_compatible', true);
    }

    public function scopeMutualInterest($query)
    {
        return $query->where('mutual_interest', true);
    }

    public function scopeForProfile($query, $profileId)
    {
        return $query->where('profile1_id', $profileId)
                     ->orWhere('profile2_id', $profileId);
    }

    public function scopeOrderByMatchScore($query, $direction = 'desc')
    {
        return $query->orderBy('match_score', $direction);
    }

    // Methods
    public function getOtherProfile($profileId)
    {
        if ($this->profile1_id == $profileId) {
            return $this->profile2;
        }
        if ($this->profile2_id == $profileId) {
            return $this->profile1;
        }
        return null;
    }

    public function calculateMutualInterest()
    {
        $mutual = Interest::where('sender_id', $this->profile1_id)
            ->where('receiver_id', $this->profile2_id)
            ->where('status', 'accepted')
            ->exists() && 
            Interest::where('sender_id', $this->profile2_id)
            ->where('receiver_id', $this->profile1_id)
            ->where('status', 'accepted')
            ->exists();

        $this->update(['mutual_interest' => $mutual]);
        return $mutual;
    }

    public function updateCompatibility()
    {
        $isCompatible = $this->match_score >= 70;
        $this->update(['is_compatible' => $isCompatible]);
        return $isCompatible;
    }
}