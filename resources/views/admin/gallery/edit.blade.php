@extends('layouts.admin')

@section('page-title', 'Editar Archivo')

@section('content')

    <div class="flex items-center gap-3 mb-8">
        <a href="{{ route('admin.gallery.index') }}" class="text-sm text-gray-500 hover:text-white transition-colors">← Volver</a>
        <h1 class="text-2xl font-bold text-white">Editar Archivo</h1>
    </div>

    <div class="bg-white/5 rounded-xl border border-white/5 p-6 max-w-2xl">

        @if($errors->any())
            <div class="mb-4 p-4 bg-red-400/10 border border-red-400/20 rounded-lg">
                <ul class="text-sm text-red-400 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.gallery.update', $gallery) }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Título</label>
                    <input type="text" name="title" value="{{ old('title', $gallery->title) }}"
                           class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-cyan-400">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Tipo</label>
                    <select name="type" class="w-full bg-[#1a1a1a] border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-cyan-400">
                        <option value="photo" {{ old('type', $gallery->type) === 'photo' ? 'selected' : '' }}>Foto</option>
                        <option value="video" {{ old('type', $gallery->type) === 'video' ? 'selected' : '' }}>Video</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Evento relacionado</label>
                    <select name="event_id" class="w-full bg-[#1a1a1a] border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-cyan-400">
                        <option value="">— Ninguno —</option>
                        @foreach($events as $event)
                            <option value="{{ $event->id }}" {{ old('event_id', $gallery->event_id) == $event->id ? 'selected' : '' }}>
                                {{ $event->title }} ({{ $event->date->format('d M Y') }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Archivo actual</label>
                    @if($gallery->type === 'photo')
                        <img src="{{ Storage::url($gallery->file_path) }}"
                             class="w-32 h-32 rounded-lg object-cover border border-white/10 mb-2">
                    @else
                        <div class="w-32 h-32 rounded-lg bg-white/10 flex items-center justify-center border border-white/10 mb-2">
                            <svg class="w-8 h-8 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                        </div>
                    @endif
                    <input type="file" name="file_path" accept="image/*,video/*"
                           class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-cyan-400/10 file:text-cyan-400 hover:file:bg-cyan-400/20">
                    <p class="text-xs text-gray-600 mt-1">Deja vacío para mantener el archivo actual.</p>
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Thumbnail (solo videos)</label>
                    @if($gallery->thumbnail)
                        <img src="{{ Storage::url($gallery->thumbnail) }}"
                             class="w-24 h-24 rounded-lg object-cover border border-white/10 mb-2">
                    @endif
                    <input type="file" name="thumbnail" accept="image/*"
                           class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-cyan-400/10 file:text-cyan-400 hover:file:bg-cyan-400/20">
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Caption</label>
                    <textarea name="caption" rows="2"
                              class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-cyan-400">{{ old('caption', $gallery->caption) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Orden</label>
                    <input type="number" name="order" value="{{ old('order', $gallery->order) }}" min="0"
                           class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-cyan-400">
                </div>

            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                        class="px-5 py-2 bg-cyan-400 text-black text-sm font-bold rounded-lg hover:bg-cyan-300 transition-colors">
                    Guardar cambios
                </button>
                <a href="{{ route('admin.gallery.index') }}"
                   class="px-5 py-2 bg-white/5 text-gray-400 text-sm font-semibold rounded-lg hover:bg-white/10 transition-colors">
                    Cancelar
                </a>
            </div>

        </form>
    </div>

@endsection