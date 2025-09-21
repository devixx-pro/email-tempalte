<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'age',
        'primary_business_phone',
        'alt_business_phone',
        'email1',
        'email2',
        'business_email',
        'dedupe_key',
        'unsubscribed',
        'last_sent_at',
        'send_attempts',
    ];

    protected $casts = [
        'age' => 'integer',
        'unsubscribed' => 'boolean',
        'last_sent_at' => 'datetime',
        'send_attempts' => 'integer',
    ];
}
