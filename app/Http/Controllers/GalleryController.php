<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Event;

class GalleryController extends Controller
{
    public function index()
    {
        $photos = Gallery::with('event')
            ->where('type', 'photo')
            ->orderBy('order')
            ->get();

        $videos = Gallery::with('event')
            ->where('type', 'video')
            ->orderBy('order')
            ->get();

        $events = Event::whereHas('gallery')
            ->orderBy('date', 'desc')
            ->get();

        return view('public.gallery', compact('photos', 'videos', 'events'));
    }
}