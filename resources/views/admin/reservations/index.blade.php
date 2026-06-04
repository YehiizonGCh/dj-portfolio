@extends('layouts.admin')

@section('page-title', 'Reservaciones')

@section('content')

    <div class="mb-8">
        <h1 class="text-2xl font-bold text-white">Reservaciones</h1>
        <p class="text-sm text-gray-500 mt-0.5">Solicitudes de booking recibidas</p>
    </div>

    <div class="bg-white/5 rounded-xl border border-white/5 overflow-hidden">
        <table class="w-full">
            <thead>
                <tr class="border-b border-white/5">
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-widest">Cliente</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-widest">Evento</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-widest">Fecha</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-widest">Presupuesto</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-widest">Status</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-widest">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($reservations as $reservation)
                    <tr class="hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-xs font-bold text-white">
                                    {{ strtoupper(substr($reservation->client_name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-white">{{ $reservation->client_name }}</p>
                                    <p class="text-xs text-gray-500">{{ $reservation->client_email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-300">{{ $reservation->event_type }}</p>
                            <p class="text-xs text-gray-500">{{ $reservation->event_location }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-300">{{ $reservation->event_date->format('d M Y') }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-cyan-400 font-medium">{{ $reservation->budget_range ?? '—' }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <span @class([
                                'text-xs font-bold px-2 py-1 rounded uppercase tracking-widest',
                                'bg-yellow-400/10 text-yellow-400' => $reservation->status === 'pending',
                                'bg-cyan-400/10 text-cyan-400' => $reservation->status === 'confirmed',
                                'bg-red-400/10 text-red-400' => $reservation->status === 'rejected',
                            ])>
                                {{ $reservation->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.reservations.show', $reservation) }}"
                                   class="text-xs text-cyan-400 hover:underline font-medium">Ver</a>
                                <form method="POST" action="{{ route('admin.reservations.destroy', $reservation) }}"
                                      onsubmit="return confirm('¿Eliminar esta reservación?')">
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
                        <td colspan="6" class="px-6 py-12 text-center text-sm text-gray-500">
                            No hay reservaciones aún.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection