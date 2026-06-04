<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('date', 'desc')->get();
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'venue'       => 'required|string|max:255',
            'city'        => 'required|string|max:255',
            'date'        => 'required|date',
            'start_time'  => 'nullable|date_format:H:i',
            'end_time'    => 'nullable|date_format:H:i',
            'status'      => 'required|in:confirmed,pending,cancelled',
            'is_featured' => 'boolean',
            'description' => 'nullable|string',
            'flyer_image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('flyer_image')) {
            $validated['flyer_image'] = $request->file('flyer_image')
                ->store('events', 'public');
        }

        $validated['is_featured'] = $request->boolean('is_featured');

        Event::create($validated);

        return redirect()->route('admin.events.index')
            ->with('success', 'Evento creado correctamente.');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'venue'       => 'required|string|max:255',
            'city'        => 'required|string|max:255',
            'date'        => 'required|date',
            'start_time'  => 'nullable|date_format:H:i',
            'end_time'    => 'nullable|date_format:H:i',
            'status'      => 'required|in:confirmed,pending,cancelled',
            'is_featured' => 'boolean',
            'description' => 'nullable|string',
            'flyer_image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('flyer_image')) {
            if ($event->flyer_image) {
                Storage::disk('public')->delete($event->flyer_image);
            }
            $validated['flyer_image'] = $request->file('flyer_image')
                ->store('events', 'public');
        }

        $validated['is_featured'] = $request->boolean('is_featured');

        $event->update($validated);

        return redirect()->route('admin.events.index')
            ->with('success', 'Evento actualizado correctamente.');
    }

    public function destroy(Event $event)
    {
        if ($event->flyer_image) {
            Storage::disk('public')->delete($event->flyer_image);
        }

        $event->delete();

        return redirect()->route('admin.events.index')
            ->with('success', 'Evento eliminado correctamente.');
    }
}