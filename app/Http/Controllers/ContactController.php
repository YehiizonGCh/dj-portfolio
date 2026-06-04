<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
{
    $profile = \App\Models\Profile::first();
    return view('public.contact', compact('profile'));
}
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'body'    => 'required|string',
        ]);

        Message::create($validated);

        return redirect()->route('contact')
            ->with('success', '¡Mensaje enviado! Te responderé a la brevedad.');
    }
}