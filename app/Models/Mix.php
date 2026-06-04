<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mix extends Model
{
    protected $fillable = [
        'title',
        'genre',
        'platform',
        'embed_url',
        'cover_image',
        'recorded_at',
        'is_featured',
    ];

    protected $casts = [
        'recorded_at' => 'date',
        'is_featured' => 'boolean',
    ];
}