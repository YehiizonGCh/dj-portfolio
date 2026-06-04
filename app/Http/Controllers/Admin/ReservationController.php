<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::orderBy('created_at', 'desc')->get();
        return view('admin.reservations.index', compact('reservations'));
    }

    public function show(Reservation $reservation)
    {
        return view('admin.reservations.show', compact('reservation'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,rejected',
        ]);

        $reservation->update(['status' => $request->status]);

        return redirect()->route('admin.reservations.index')
            ->with('success', 'Reservación actualizada correctamente.');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->route('admin.reservations.index')
            ->with('success', 'Reservación eliminada correctamente.');
    }
}