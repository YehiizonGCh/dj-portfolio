@extends('layouts.admin')

@section('page-title', 'Mensaje')

@section('content')

    <div class="flex items-center gap-3 mb-8">
        <a href="{{ route('admin.messages.index') }}" class="text-sm text-gray-500 hover:text-white transition-colors">← Volver</a>
        <h1 class="text-2xl font-bold text-white">Mensaje</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Contenido del mensaje --}}
        <div class="lg:col-span-2 bg-white/5 rounded-xl border border-white/5 p-6 space-y-5">

            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center text-lg font-bold text-white">
                    {{ strtoupper(substr($message->name, 0, 1)) }}
                </div>
                <div>
                    <h2 class="text-lg font-bold text-white">{{ $message->name }}</h2>
                    <p class="text-sm text-gray-500">{{ $message->email }}</p>
                </div>
            </div>

            @if($message->subject)
                <div class="border-t border-white/5 pt-5">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1">Asunto</p>
                    <p class="text-sm text-white">{{ $message->subject }}</p>
                </div>
            @endif

            <div class="border-t border-white/5 pt-5">
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Mensaje</p>
                <p class="text-sm text-gray-300 leading-relaxed">{{ $message->body }}</p>
            </div>

            <div class="border-t border-white/5 pt-4">
                <p class="text-xs text-gray-600">Recibido el {{ $message->created_at->format('d M Y, H:i') }}</p>
            </div>
        </div>

        {{-- Acciones --}}
        <div class="bg-white/5 rounded-xl border border-white/5 p-6 h-fit space-y-3">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-4">Acciones</p>

            <a href="mailto:{{ $message->email }}"
               class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-cyan-400 text-black text-sm font-bold rounded-lg hover:bg-cyan-300 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                Responder por email
            </a>

            <form method="POST" action="{{ route('admin.messages.destroy', $message) }}"
                  onsubmit="return confirm('¿Eliminar este mensaje?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-white/5 text-red-400 text-sm font-semibold rounded-lg hover:bg-red-400/10 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Eliminar mensaje
                </button>
            </form>
        </div>

    </div>

@endsection