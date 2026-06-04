@extends('layouts.admin')

@section('page-title', 'Mensajes')

@section('content')

    <div class="mb-8">
        <h1 class="text-2xl font-bold text-white">Mensajes</h1>
        <p class="text-sm text-gray-500 mt-0.5">Mensajes recibidos desde el sitio</p>
    </div>

    <div class="bg-white/5 rounded-xl border border-white/5 overflow-hidden">
        <div class="divide-y divide-white/5">
            @forelse($messages as $message)
                <a href="{{ route('admin.messages.show', $message) }}"
                   class="flex items-center gap-4 px-6 py-4 hover:bg-white/5 transition-colors {{ !$message->is_read ? 'bg-cyan-400/5' : '' }}">
                    <div class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center text-sm font-bold text-white shrink-0">
                        {{ strtoupper(substr($message->name, 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2">
                            <p class="text-sm font-medium text-white {{ !$message->is_read ? 'font-semibold' : '' }}">
                                {{ $message->name }}
                            </p>
                            @if(!$message->is_read)
                                <span class="w-2 h-2 rounded-full bg-cyan-400 shrink-0"></span>
                            @endif
                        </div>
                        <p class="text-xs text-gray-500 truncate mt-0.5">
                            {{ $message->subject ?? $message->body }}
                        </p>
                    </div>
                    <p class="text-xs text-gray-600 shrink-0">{{ $message->created_at->format('d M') }}</p>
                </a>
            @empty
                <div class="px-6 py-12 text-center text-sm text-gray-500">
                    No hay mensajes aún.
                </div>
            @endforelse
        </div>
    </div>

@endsection