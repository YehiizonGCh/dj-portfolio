@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('content')

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white">Bienvenido, Yehiizon.</h1>
        <p class="text-gray-500 mt-1">Tu agenda nocturna te espera.</p>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white/5 rounded-xl border border-white/5 p-5">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1">Próximos eventos</p>
            <p class="text-3xl font-bold text-white">{{ $upcomingEvents }}</p>
        </div>
        <div class="bg-white/5 rounded-xl border border-white/5 p-5">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1">Total eventos</p>
            <p class="text-3xl font-bold text-white">{{ $totalEvents }}</p>
        </div>
        <div class="bg-white/5 rounded-xl border border-white/5 p-5">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1">Reservaciones pendientes</p>
            <p class="text-3xl font-bold text-cyan-400">{{ $pendingReservations }}</p>
        </div>
        <div class="bg-white/5 rounded-xl border border-white/5 p-5">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1">Mensajes sin leer</p>
            <p class="text-3xl font-bold text-cyan-400">{{ $unreadMessages }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Próximos eventos --}}
        <div class="bg-white/5 rounded-xl border border-white/5">
            <div class="px-6 py-4 border-b border-white/5 flex items-center justify-between">
                <h3 class="text-sm font-semibold text-white">Próximos eventos</h3>
                <a href="{{ route('admin.events.index') }}" class="text-xs text-cyan-400 hover:underline">Ver Todos los Eventos</a>
            </div>
            <div class="divide-y divide-white/5">
                @forelse($nextEvents as $event)
                    <div class="px-6 py-4 flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-white">{{ $event->title }}</p>
                            <p class="text-xs text-gray-500 mt-0.5">{{ $event->venue }}, {{ $event->city }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs font-semibold text-gray-400">{{ $event->date->format('M d, Y') }}</p>
                            <span @class([
                                'text-xs font-bold px-2 py-0.5 rounded mt-1 inline-block uppercase tracking-widest',
                                'bg-cyan-400/10 text-cyan-400' => $event->status === 'confirmed',
                                'bg-yellow-400/10 text-yellow-400' => $event->status === 'pending',
                                'bg-red-400/10 text-red-400' => $event->status === 'cancelled',
                            ])>
                                {{ $event->status }}
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="px-6 py-4 text-sm text-gray-500">No hay eventos próximos.</p>
                @endforelse
            </div>
        </div>

        {{-- Últimas reservaciones --}}
        <div class="bg-white/5 rounded-xl border border-white/5">
            <div class="px-6 py-4 border-b border-white/5 flex items-center justify-between">
                <h3 class="text-sm font-semibold text-white">Solicitudes de reserva recientes</h3>
                <a href="{{ route('admin.reservations.index') }}" class="text-xs text-cyan-400 hover:underline">
                    Bandeja de Mensajes @if($pendingReservations > 0) ({{ $pendingReservations }} New) @endif
                </a>
            </div>
            <div class="divide-y divide-white/5">
                @forelse($latestReservations as $reservation)
                    <div class="px-6 py-4 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-xs font-bold text-white">
                                {{ strtoupper(substr($reservation->client_name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="text-sm font-medium text-white">{{ $reservation->client_name }}</p>
                                <p class="text-xs text-gray-500">{{ $reservation->event_date->format('M d, Y') }} — {{ $reservation->event_type }}</p>
                            </div>
                        </div>
                        <span @class([
                            'text-xs font-bold px-2 py-0.5 rounded uppercase tracking-widest',
                            'bg-yellow-400/10 text-yellow-400' => $reservation->status === 'pending',
                            'bg-cyan-400/10 text-cyan-400' => $reservation->status === 'confirmed',
                            'bg-red-400/10 text-red-400' => $reservation->status === 'rejected',
                        ])>
                            {{ $reservation->status }}
                        </span>
                    </div>
                @empty
                    <p class="px-6 py-4 text-sm text-gray-500">No hay reservaciones aún.</p>
                @endforelse
            </div>
        </div>

    </div>

@endsection