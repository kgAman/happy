<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'wedding_date',
        'inquiry_type',
        'message',
        'subscribe_newsletter',
        'request_guide',
        'ip_address',
        'status'
    ];

    protected $casts = [
        'wedding_date' => 'date',
        'subscribe_newsletter' => 'boolean',
        'request_guide' => 'boolean',
    ];

    protected $attributes = [
        'status' => 'pending',
    ];

    // Accessor for full name
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    
    // Scope for different inquiry types
    public function scopePlanning($query)
    {
        return $query->where('inquiry_type', 'planning');
    }

    public function scopeVendor($query)
    {
        return $query->where('inquiry_type', 'vendor');
    }

    public function scopeInspiration($query)
    {
        return $query->where('inquiry_type', 'inspiration');
    }
}