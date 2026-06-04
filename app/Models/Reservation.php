<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'client_name',
        'client_email',
        'client_phone',
        'event_type',
        'event_date',
        'event_location',
        'budget_range',
        'message',
        'status',
    ];

    protected $casts = [
        'event_date' => 'date',
    ];
}