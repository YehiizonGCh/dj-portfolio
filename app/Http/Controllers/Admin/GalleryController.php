<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $gallery = Gallery::with('event')->orderBy('order')->get();
        return view('admin.gallery.index', compact('gallery'));
    }

    public function create()
    {
        $events = Event::orderBy('date', 'desc')->get();
        return view('admin.gallery.create', compact('events'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'     => 'nullable|string|max:255',
            'type'      => 'required|in:photo,video',
            'file_path' => 'required|file|mimes:jpg,jpeg,png,webp,mp4,mov|max:51200',
            'thumbnail' => 'nullable|image|max:2048',
            'caption'   => 'nullable|string',
            'event_id'  => 'nullable|exists:events,id',
            'order'     => 'integer|min:0',
        ]);

        $validated['file_path'] = $request->file('file_path')
            ->store('gallery', 'public');

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')
                ->store('gallery/thumbnails', 'public');
        }

        Gallery::create($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Archivo subido correctamente.');
    }

    public function edit(Gallery $gallery)
    {
        $events = Event::orderBy('date', 'desc')->get();
        return view('admin.gallery.edit', compact('gallery', 'events'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'title'     => 'nullable|string|max:255',
            'type'      => 'required|in:photo,video',
            'file_path' => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,mov|max:51200',
            'thumbnail' => 'nullable|image|max:2048',
            'caption'   => 'nullable|string',
            'event_id'  => 'nullable|exists:events,id',
            'order'     => 'integer|min:0',
        ]);

        if ($request->hasFile('file_path')) {
            Storage::disk('public')->delete($gallery->file_path);
            $validated['file_path'] = $request->file('file_path')
                ->store('gallery', 'public');
        }

        if ($request->hasFile('thumbnail')) {
            if ($gallery->thumbnail) {
                Storage::disk('public')->delete($gallery->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')
                ->store('gallery/thumbnails', 'public');
        }

        $gallery->update($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Archivo actualizado correctamente.');
    }

    public function destroy(Gallery $gallery)
    {
        Storage::disk('public')->delete($gallery->file_path);

        if ($gallery->thumbnail) {
            Storage::disk('public')->delete($gallery->thumbnail);
        }

        $gallery->delete();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Archivo eliminado correctamente.');
    }
}