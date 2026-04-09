<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shortlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'profile_id',
        'notes',
        'match_score',
        'notify_me',
        'status',
    ];

    protected $casts = [
        'notify_me' => 'boolean',
        'match_score' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

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
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeArchived($query)
    {
        return $query->where('status', 'archived');
    }

    public function scopeWithHighMatchScore($query, $minScore = 70)
    {
        return $query->where('match_score', '>=', $minScore);
    }
}