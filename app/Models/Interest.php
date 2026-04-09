<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'status',
        'message',
        'viewed',
        'viewed_at',
        'responded_at',
    ];

    protected $casts = [
        'viewed' => 'boolean',
        'viewed_at' => 'datetime',
        'responded_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function sender()
    {
        return $this->belongsTo(Profile::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(Profile::class, 'receiver_id');
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeAccepted($query)
    {
        return $query->where('status', 'accepted');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    public function scopeUnviewed($query)
    {
        return $query->where('viewed', false);
    }

    public function scopeMutual($query)
    {
        return $query->where('status', 'accepted')
                     ->whereExists(function ($query) {
                         $query->selectRaw(1)
                               ->from('interests as i2')
                               ->whereColumn('i2.sender_id', 'interests.receiver_id')
                               ->whereColumn('i2.receiver_id', 'interests.sender_id')
                               ->where('i2.status', 'accepted');
                     });
    }

    // Methods
    public function accept()
    {
        $this->update([
            'status' => 'accepted',
            'responded_at' => now(),
        ]);
    }

    public function reject()
    {
        $this->update([
            'status' => 'rejected',
            'responded_at' => now(),
        ]);
    }

    public function markAsViewed()
    {
        if (!$this->viewed) {
            $this->update([
                'viewed' => true,
                'viewed_at' => now(),
            ]);
        }
    }

    public function isMutual()
    {
        return Interest::where('sender_id', $this->receiver_id)
            ->where('receiver_id', $this->sender_id)
            ->where('status', 'accepted')
            ->exists();
    }
}