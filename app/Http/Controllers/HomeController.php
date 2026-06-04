<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Mix;
use App\Models\Profile;

class HomeController extends Controller
{
    public function index()
    {
        $profile = Profile::first();

        $upcomingEvents = Event::where('date', '>=', now())
            ->orderBy('date', 'asc')
            ->take(3)
            ->get();

        $featuredMix = Mix::where('is_featured', true)
            ->latest()
            ->first();

        return view('public.home', compact(
            'profile',
            'upcomingEvents',
            'featuredMix'
        ));
    }
}