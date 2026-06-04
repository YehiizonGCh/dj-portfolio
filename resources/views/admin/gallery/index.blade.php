@extends('layouts.admin')

@section('page-title', 'Galería')

@section('content')

    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-white">Galería</h1>
            <p class="text-sm text-gray-500 mt-0.5">Fotos y videos de tus eventos</p>
        </div>
        <a href="{{ route('admin.gallery.create') }}"
           class="px-4 py-2 bg-cyan-400 text-black text-sm font-bold rounded-lg hover:bg-cyan-300 transition-colors">
            + Subir archivo
        </a>
    </div>

    @if($gallery->isEmpty())
        <div class="bg-white/5 rounded-xl border border-white/5 px-6 py-16 text-center">
            <p class="text-gray-500 text-sm">No hay archivos aún.
                <a href="{{ route('admin.gallery.create') }}" class="text-cyan-400 hover:underline">Subir el primero</a>
            </p>
        </div>
    @else
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($gallery as $item)
                <div class="bg-white/5 rounded-xl border border-white/5 overflow-hidden group">
                    <div class="aspect-square relative">
                        @if($item->type === 'photo')
                            <img src="{{ Storage::url($item->file_path) }}"
                                 class="w-full h-full object-cover">
                        @else
                            @if($item->thumbnail)
                                <img src="{{ Storage::url($item->thumbnail) }}"
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-white/10 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.069A1 1 0 0121 8.82v6.36a1 1 0 01-1.447.894L15 14M3 8a2 2 0 012-2h8a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z"/>
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="w-10 h-10 rounded-full bg-black/50 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                </div>
                            </div>
                        @endif

                        <div class="absolute top-2 left-2">
                            <span class="text-xs font-bold px-2 py-0.5 rounded uppercase tracking-widest
                                {{ $item->type === 'photo' ? 'bg-cyan-400/20 text-cyan-400' : 'bg-purple-400/20 text-purple-400' }}">
                                {{ $item->type }}
                            </span>
                        </div>
                    </div>

                    <div class="p-3">
                        <p class="text-xs font-medium text-white truncate">{{ $item->title ?? 'Sin título' }}</p>
                        @if($item->event)
                            <p class="text-xs text-gray-500 mt-0.5 truncate">{{ $item->event->title }}</p>
                        @endif
                        <div class="flex items-center gap-2 mt-2">
                            <a href="{{ route('admin.gallery.edit', $item) }}"
                               class="text-xs text-cyan-400 hover:underline font-medium">Editar</a>
                            <form method="POST" action="{{ route('admin.gallery.destroy', $item) }}"
                                  onsubmit="return confirm('¿Eliminar este archivo?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs text-red-400 hover:underline font-medium">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

@endsection