@extends('layouts.admin')

@section('page-title', 'Detalle Reservación')

@section('content')

    <div class="flex items-center gap-3 mb-8">
        <a href="{{ route('admin.reservations.index') }}" class="text-sm text-gray-500 hover:text-white transition-colors">← Volver</a>
        <h1 class="text-2xl font-bold text-white">Detalle Reservación</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Info principal --}}
        <div class="lg:col-span-2 bg-white/5 rounded-xl border border-white/5 p-6 space-y-5">

            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center text-lg font-bold text-white">
                    {{ strtoupper(substr($reservation->client_name, 0, 1)) }}
                </div>
                <div>
                    <h2 class="text-lg font-bold text-white">{{ $reservation->client_name }}</h2>
                    <p class="text-sm text-gray-500">Solicitud recibida el {{ $reservation->created_at->format('d M Y, H:i') }}</p>
                </div>
            </div>

            <div class="border-t border-white/5 pt-5 grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1">Email</p>
                    <p class="text-sm text-white">{{ $reservation->client_email }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1">Teléfono</p>
                    <p class="text-sm text-white">{{ $reservation->client_phone ?? '—' }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1">Tipo de evento</p>
                    <p class="text-sm text-white">{{ $reservation->event_type }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1">Fecha del evento</p>
                    <p class="text-sm text-white">{{ $reservation->event_date->format('d M Y') }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1">Ubicación</p>
                    <p class="text-sm text-white">{{ $reservation->event_location }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1">Presupuesto</p>
                    <p class="text-sm text-cyan-400 font-medium">{{ $reservation->budget_range ?? '—' }}</p>
                </div>
            </div>

            @if($reservation->message)
                <div class="border-t border-white/5 pt-5">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Mensaje</p>
                    <p class="text-sm text-gray-300 leading-relaxed">{{ $reservation->message }}</p>
                </div>
            @endif
        </div>

        {{-- Panel de status --}}
        <div class="bg-white/5 rounded-xl border border-white/5 p-6 h-fit">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-4">Gestionar status</p>

            <div class="mb-4">
                <span @class([
                    'text-xs font-bold px-3 py-1.5 rounded uppercase tracking-widest',
                    'bg-yellow-400/10 text-yellow-400' => $reservation->status === 'pending',
                    'bg-cyan-400/10 text-cyan-400' => $reservation->status === 'confirmed',
                    'bg-red-400/10 text-red-400' => $reservation->status === 'rejected',
                ])>
                    {{ $reservation->status }}
                </span>
            </div>

            <form method="POST" action="{{ route('admin.reservations.update', $reservation) }}" class="space-y-3">
                @csrf
                @method('PUT')

                <select name="status" class="w-full bg-[#1a1a1a] border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-cyan-400">
                    <option value="pending" {{ $reservation->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ $reservation->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="rejected" {{ $reservation->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>

                <button type="submit"
                        class="w-full px-4 py-2 bg-cyan-400 text-black text-sm font-bold rounded-lg hover:bg-cyan-300 transition-colors">
                    Actualizar status
                </button>
            </form>

            <div class="border-t border-white/5 mt-5 pt-5">
                <a href="mailto:{{ $reservation->client_email }}"
                   class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-white/5 text-gray-400 text-sm font-semibold rounded-lg hover:bg-white/10 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Responder por email
                </a>
            </div>
        </div>

    </div>

@endsection