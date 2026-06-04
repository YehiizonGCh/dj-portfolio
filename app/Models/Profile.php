<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'dj_name',
        'real_name',
        'bio',
        'bio_short',
        'photo',
        'email',
        'phone',
        'location',
        'instagram',
        'soundcloud',
        'mixcloud',
        'youtube',
        'spotify',
        'facebook',
        'tiktok',
        'gigs_played',
        'countries',
    ];

    protected $casts = [
        'gigs_played' => 'integer',
        'countries' => 'integer',
    ];
}