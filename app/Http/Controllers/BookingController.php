<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Profile;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $profile = Profile::first();

        return view('public.booking', compact('profile'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name'    => 'required|string|max:255',
            'client_email'   => 'required|email|max:255',
            'client_phone'   => 'nullable|string|max:20',
            'event_type'     => 'required|string|max:255',
            'event_date'     => 'required|date|after:today',
            'event_location' => 'required|string|max:255',
            'budget_range'   => 'nullable|string|max:100',
            'message'        => 'nullable|string',
        ]);

        Reservation::create($validated);

        return redirect()->route('booking')
            ->with('success', '¡Tu solicitud fue enviada! Me pondré en contacto contigo pronto.');
    }
}