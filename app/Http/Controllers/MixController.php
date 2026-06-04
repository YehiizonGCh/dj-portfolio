<?php

namespace App\Http\Controllers;

use App\Models\Mix;

class MixController extends Controller
{
    public function index()
    {
        $mixes = Mix::orderBy('recorded_at', 'desc')->get();

        return view('public.mixes', compact('mixes'));
    }
}