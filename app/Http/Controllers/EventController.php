<?php

namespace App\Http\Controllers;

use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $upcomingEvents = Event::where('date', '>=', now())
            ->orderBy('date', 'asc')
            ->get();

        $pastEvents = Event::where('date', '<', now())
            ->orderBy('date', 'desc')
            ->get();

        return view('public.events', compact(
            'upcomingEvents',
            'pastEvents'
        ));
    }
}