<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'title',
        'type',
        'file_path',
        'thumbnail',
        'caption',
        'event_id',
        'order',
    ];

    protected $casts = [
        'event_id' => 'integer',
        'order' => 'integer',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}