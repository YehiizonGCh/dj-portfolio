<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
{
    $profile = Profile::firstOrCreate([], [
        'dj_name' => 'Yehiizon GarroCh',
        'bio' => '',
    ]);

    return view('admin.profile.edit', compact('profile'));
}

    public function update(Request $request)
    {
        $profile = Profile::first();

        $validated = $request->validate([
            'dj_name'     => 'required|string|max:255',
            'real_name'   => 'nullable|string|max:255',
            'bio'         => 'nullable|string',
            'bio_short'   => 'nullable|string|max:500',
            'email'       => 'nullable|email|max:255',
            'phone'       => 'nullable|string|max:20',
            'location'    => 'nullable|string|max:255',
            'instagram'   => 'nullable|string|max:255',
            'soundcloud'  => 'nullable|string|max:255',
            'mixcloud'    => 'nullable|string|max:255',
            'youtube'     => 'nullable|string|max:255',
            'spotify'     => 'nullable|string|max:255',
            'facebook'    => 'nullable|string|max:255',
            'tiktok'      => 'nullable|string|max:255',
            'gigs_played' => 'nullable|integer|min:0',
            'countries'   => 'nullable|integer|min:0',
            'photo'       => 'nullable|image|max:2048',
        ]);

        $validated['bio']         = $validated['bio'] ?? '';
        $validated['gigs_played'] = $validated['gigs_played'] ?? 0;
        $validated['countries']   = $validated['countries'] ?? 0;

        if ($request->hasFile('photo')) {
            if ($profile->photo) {
                Storage::disk('public')->delete($profile->photo);
            }
            $validated['photo'] = $request->file('photo')
                ->store('profile', 'public');
        }

        $profile->update($validated);

        return redirect()->route('admin.profile.edit')
            ->with('success', 'Perfil actualizado correctamente.');
    }
}