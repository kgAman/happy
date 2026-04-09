<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountryCode extends Model
{
    protected $fillable = [
        'country_name',
        'country_code',
        'dial_code',
        'status'
    ];
}
