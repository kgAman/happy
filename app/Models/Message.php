<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
        'is_read',
        'read_at',
        'is_delivered',
        'delivered_at',
        'attachments',
        'message_type',
        'is_deleted_by_sender',
        'is_deleted_by_receiver',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime',
        'is_delivered' => 'boolean',
        'delivered_at' => 'datetime',
        'attachments' => 'array',
        'is_deleted_by_sender' => 'boolean',
        'is_deleted_by_receiver' => 'boolean',
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
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    public function scopeBetween($query, $profile1Id, $profile2Id)
    {
        return $query->where(function ($q) use ($profile1Id, $profile2Id) {
            $q->where('sender_id', $profile1Id)
              ->where('receiver_id', $profile2Id);
        })->orWhere(function ($q) use ($profile1Id, $profile2Id) {
            $q->where('sender_id', $profile2Id)
              ->where('receiver_id', $profile1Id);
        });
    }

    public function scopeNotDeleted($query, $profileId)
    {
        return $query->where(function ($q) use ($profileId) {
            $q->where(function ($q2) use ($profileId) {
                $q2->where('sender_id', $profileId)
                   ->where('is_deleted_by_sender', false);
            })->orWhere(function ($q2) use ($profileId) {
                $q2->where('receiver_id', $profileId)
                   ->where('is_deleted_by_receiver', false);
            });
        });
    }

    public function scopeLatestConversations($query, $profileId)
    {
        return $query->selectRaw('
            CASE 
                WHEN sender_id = ? THEN receiver_id
                ELSE sender_id
            END as other_profile_id,
            MAX(created_at) as last_message_at
        ', [$profileId])
        ->where(function ($q) use ($profileId) {
            $q->where('sender_id', $profileId)
              ->orWhere('receiver_id', $profileId);
        })
        ->groupBy('other_profile_id')
        ->orderBy('last_message_at', 'desc');
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
    }

    public function markAsDelivered()
    {
        if (!$this->is_delivered) {
            $this->update([
                'is_delivered' => true,
                'delivered_at' => now(),
            ]);
        }
    }

    public function deleteForSender()
    {
        $this->update(['is_deleted_by_sender' => true]);
    }

    public function deleteForReceiver()
    {
        $this->update(['is_deleted_by_receiver' => true]);
    }

    public function isVisibleTo($profileId)
    {
        if ($this->sender_id == $profileId) {
            return !$this->is_deleted_by_sender;
        }
        if ($this->receiver_id == $profileId) {
            return !$this->is_deleted_by_receiver;
        }
        return false;
    }
}