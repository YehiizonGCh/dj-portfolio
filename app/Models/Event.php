<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    protected $fillable = [
        'title',
        'venue',
        'city',
        'date',
        'start_time',
        'end_time',
        'flyer_image',
        'status',
        'is_featured',
        'description',
    ];

    protected $casts = [
        'date' => 'date',
        'is_featured' => 'boolean',
    ];

    public function gallery()
    {
        return $this->hasMany(Gallery::class);
    }

    public function getIsPastAttribute(): bool
    {
        return $this->date->isPast();
    }
}