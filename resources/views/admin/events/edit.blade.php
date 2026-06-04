@extends('layouts.admin')

@section('page-title', 'Editar Evento')

@section('content')

    <div class="flex items-center gap-3 mb-8">
        <a href="{{ route('admin.events.index') }}" class="text-sm text-gray-500 hover:text-white transition-colors">← Volver</a>
        <h1 class="text-2xl font-bold text-white">Editar Evento</h1>
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

        <form method="POST" action="{{ route('admin.events.update', $event) }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Título del evento</label>
                    <input type="text" name="title" value="{{ old('title', $event->title) }}"
                           class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-cyan-400">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Venue / Local</label>
                    <input type="text" name="venue" value="{{ old('venue', $event->venue) }}"
                           class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-cyan-400">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Ciudad</label>
                    <input type="text" name="city" value="{{ old('city', $event->city) }}"
                           class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-cyan-400">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Fecha</label>
                    <input type="date" name="date" value="{{ old('date', $event->date->format('Y-m-d')) }}"
                           class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-cyan-400">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Status</label>
                    <select name="status" class="w-full bg-[#1a1a1a] border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-cyan-400">
                        <option value="confirmed" {{ old('status', $event->status) === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="pending" {{ old('status', $event->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="cancelled" {{ old('status', $event->status) === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Hora inicio</label>
                    <input type="time" name="start_time" value="{{ old('start_time', $event->start_time) }}"
                           class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-cyan-400">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Hora fin</label>
                    <input type="time" name="end_time" value="{{ old('end_time', $event->end_time) }}"
                           class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-cyan-400">
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Descripción</label>
                    <textarea name="description" rows="3"
                              class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-cyan-400">{{ old('description', $event->description) }}</textarea>
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Flyer / Imagen</label>
                    @if($event->flyer_image)
                        <div class="mb-3">
                            <img src="{{ Storage::url($event->flyer_image) }}"
                                 class="w-24 h-24 rounded-lg object-cover border border-white/10">
                            <p class="text-xs text-gray-500 mt-1">Imagen actual — sube una nueva para reemplazarla</p>
                        </div>
                    @endif
                    <input type="file" name="flyer_image" accept="image/*"
                           class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-cyan-400/10 file:text-cyan-400 hover:file:bg-cyan-400/20">
                </div>

                <div class="sm:col-span-2">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_featured" value="1"
                               {{ old('is_featured', $event->is_featured) ? 'checked' : '' }}
                               class="rounded border-white/10 bg-white/5 text-cyan-400">
                        <span class="text-sm text-gray-400">Destacar en el home</span>
                    </label>
                </div>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                        class="px-5 py-2 bg-cyan-400 text-black text-sm font-bold rounded-lg hover:bg-cyan-300 transition-colors">
                    Guardar cambios
                </button>
                <a href="{{ route('admin.events.index') }}"
                   class="px-5 py-2 bg-white/5 text-gray-400 text-sm font-semibold rounded-lg hover:bg-white/10 transition-colors">
                    Cancelar
                </a>
            </div>

        </form>
    </div>

@endsection