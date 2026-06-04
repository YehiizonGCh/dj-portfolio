<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Reservation;
use App\Models\Message;
use App\Models\Mix;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEvents      = Event::count();
        $upcomingEvents   = Event::where('date', '>=', now())->count();
        $pendingReservations = Reservation::where('status', 'pending')->count();
        $unreadMessages   = Message::where('is_read', false)->count();
        $totalMixes       = Mix::count();

        $latestReservations = Reservation::latest()->take(5)->get();
        $nextEvents         = Event::where('date', '>=', now())
            ->orderBy('date', 'asc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalEvents',
            'upcomingEvents',
            'pendingReservations',
            'unreadMessages',
            'totalMixes',
            'latestReservations',
            'nextEvents'
        ));
    }
}