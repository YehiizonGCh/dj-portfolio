<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mix;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MixController extends Controller
{
    public function index()
    {
        $mixes = Mix::orderBy('recorded_at', 'desc')->get();
        return view('admin.mixes.index', compact('mixes'));
    }

    public function create()
    {
        return view('admin.mixes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'genre'       => 'nullable|string|max:100',
            'platform'    => 'required|in:soundcloud,mixcloud,youtube',
            'embed_url'   => 'required|string',
            'cover_image' => 'nullable|image|max:2048',
            'recorded_at' => 'nullable|date',
            'is_featured' => 'boolean',
        ]);

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')
                ->store('mixes', 'public');
        }

        $validated['is_featured'] = $request->boolean('is_featured');
        if ($validated['platform'] === 'youtube') {
            $validated['embed_url'] = $this->parseYoutubeId($validated['embed_url']);
        }

        Mix::create($validated);

        return redirect()->route('admin.mixes.index')
            ->with('success', 'Mix creado correctamente.');
    }

    public function edit(Mix $mix)
    {
        return view('admin.mixes.edit', compact('mix'));
    }

    public function update(Request $request, Mix $mix)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'genre'       => 'nullable|string|max:100',
            'platform'    => 'required|in:soundcloud,mixcloud,youtube',
            'embed_url'   => 'required|string',
            'cover_image' => 'nullable|image|max:2048',
            'recorded_at' => 'nullable|date',
            'is_featured' => 'boolean',
        ]);

        if ($request->hasFile('cover_image')) {
            if ($mix->cover_image) {
                Storage::disk('public')->delete($mix->cover_image);
            }
            $validated['cover_image'] = $request->file('cover_image')
                ->store('mixes', 'public');
        }

        $validated['is_featured'] = $request->boolean('is_featured');

        if ($validated['platform'] === 'youtube') {
            $validated['embed_url'] = $this->parseYoutubeId($validated['embed_url']);
        }
        $mix->update($validated);

        return redirect()->route('admin.mixes.index')
            ->with('success', 'Mix actualizado correctamente.');
    }

    public function destroy(Mix $mix)
    {
        if ($mix->cover_image) {
            Storage::disk('public')->delete($mix->cover_image);
        }

        $mix->delete();

        return redirect()->route('admin.mixes.index')
            ->with('success', 'Mix eliminado correctamente.');
    }
    private function parseYoutubeId(string $url): string
    {
        preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $matches);
        return $matches[1] ?? $url;
    }
}