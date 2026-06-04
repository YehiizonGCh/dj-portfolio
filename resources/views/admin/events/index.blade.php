@extends('layouts.admin')

@section('page-title', 'Eventos')

@section('content')

    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-white">Eventos</h1>
            <p class="text-sm text-gray-500 mt-0.5">Gestiona tus próximos y pasados eventos</p>
        </div>
        <a href="{{ route('admin.events.create') }}"
           class="px-4 py-2 bg-cyan-400 text-black text-sm font-bold rounded-lg hover:bg-cyan-300 transition-colors">
            + Nuevo evento
        </a>
    </div>

    <div class="bg-white/5 rounded-xl border border-white/5 overflow-hidden">
        <table class="w-full">
            <thead>
                <tr class="border-b border-white/5">
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-widest">Evento</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-widest">Lugar</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-widest">Fecha</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-widest">Status</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-widest">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($events as $event)
                    <tr class="hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @if($event->flyer_image)
                                    <img src="{{ Storage::url($event->flyer_image) }}"
                                         class="w-10 h-10 rounded-lg object-cover">
                                @else
                                    <div class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                                <div>
                                    <p class="text-sm font-medium text-white">{{ $event->title }}</p>
                                    @if($event->is_featured)
                                        <span class="text-xs text-cyan-400 font-medium">Destacado</span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-300">{{ $event->venue }}</p>
                            <p class="text-xs text-gray-500">{{ $event->city }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-300">{{ $event->date->format('d M Y') }}</p>
                            @if($event->start_time)
                                <p class="text-xs text-gray-500">{{ $event->start_time }} — {{ $event->end_time }}</p>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span @class([
                                'text-xs font-bold px-2 py-1 rounded uppercase tracking-widest',
                                'bg-cyan-400/10 text-cyan-400' => $event->status === 'confirmed',
                                'bg-yellow-400/10 text-yellow-400' => $event->status === 'pending',
                                'bg-red-400/10 text-red-400' => $event->status === 'cancelled',
                            ])>
                                {{ $event->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.events.edit', $event) }}"
                                   class="text-xs text-cyan-400 hover:underline font-medium">Editar</a>
                                <form method="POST" action="{{ route('admin.events.destroy', $event) }}"
                                      onsubmit="return confirm('¿Eliminar este evento?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs text-red-400 hover:underline font-medium">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-sm text-gray-500">
                            No hay eventos aún.
                            <a href="{{ route('admin.events.create') }}" class="text-cyan-400 hover:underline">Crear el primero</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection