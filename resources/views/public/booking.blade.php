@extends('layouts.public')

@section('title', 'Reservar — Yehiizon GarroCh')

@section('content')

    {{-- Header --}}
    <section class="py-20 border-b border-white/5">
        <div class="max-w-6xl mx-auto px-6">
            <p class="text-xs font-bold text-cyan-400 uppercase tracking-widest mb-4">Booking</p>
            <h1 class="font-bebas text-6xl lg:text-8xl text-white leading-none mb-4">Reservar</h1>
            <p class="text-gray-500 max-w-xl">¿Quieres que toque en tu evento? Completa el formulario y me pondré en contacto contigo.</p>
        </div>
    </section>

    <section class="py-20">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

                {{-- Formulario --}}
                <div class="lg:col-span-2">
                    <h2 class="text-xl font-bold text-white mb-6">DATOS DEL EVENTO</h2>

                    @if(session('success'))
                        <div class="mb-6 p-4 bg-cyan-400/10 border border-cyan-400/20 rounded-xl">
                            <p class="text-sm text-cyan-400 font-medium">✓ {{ session('success') }}</p>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-6 p-4 bg-red-400/10 border border-red-400/20 rounded-xl">
                            <ul class="text-sm text-red-400 space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('booking.store') }}" class="space-y-5">
                        @csrf

                        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Nombre</label>
                                <input type="text" name="client_name" value="{{ old('client_name') }}"
                                       placeholder="Tu nombre completo"
                                       class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-cyan-400 transition-colors">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Email</label>
                                <input type="email" name="client_email" value="{{ old('client_email') }}"
                                       placeholder="email@ejemplo.com"
                                       class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-cyan-400 transition-colors">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Teléfono</label>
                                <input type="text" name="client_phone" value="{{ old('client_phone') }}"
                                       placeholder="+51 999 999 999"
                                       class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-cyan-400 transition-colors">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Tipo de evento</label>
                                <select name="event_type"
                                        class="w-full bg-[#1a1a1a] border border-white/10 rounded-lg px-4 py-3 text-sm text-white focus:outline-none focus:border-cyan-400 transition-colors">
                                    <option value="">— Selecciona —</option>
                                    <option value="Discoteca" {{ old('event_type') === 'Discoteca' ? 'selected' : '' }}>Discoteca</option>
                                    <option value="Evento Privado" {{ old('event_type') === 'Evento Privado' ? 'selected' : '' }}>Evento Privado</option>
                                    <option value="Corporativo" {{ old('event_type') === 'Corporativo' ? 'selected' : '' }}>Corporativo</option>
                                    <option value="Boda" {{ old('event_type') === 'Boda' ? 'selected' : '' }}>Boda</option>
                                    <option value="Otro" {{ old('event_type') === 'Otro' ? 'selected' : '' }}>Otro</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Fecha del evento</label>
                                <input type="date" name="event_date" value="{{ old('event_date') }}"
                                       class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-sm text-white focus:outline-none focus:border-cyan-400 transition-colors">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Lugar del evento</label>
                                <input type="text" name="event_location" value="{{ old('event_location') }}"
                                       placeholder="Ciudad o dirección"
                                       class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-cyan-400 transition-colors">
                            </div>

                            <div class="sm:col-span-2">
                                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Rango de presupuesto</label>
                                <select name="budget_range"
                                        class="w-full bg-[#1a1a1a] border border-white/10 rounded-lg px-4 py-3 text-sm text-white focus:outline-none focus:border-cyan-400 transition-colors">
                                    <option value="">— Selecciona —</option>
                                    <option value="Menos de $150" {{ old('budget_range') === 'Menos de $150' ? 'selected' : '' }}>Menos de $150</option>
                                    <option value="Más de $150" {{ old('budget_range') === 'Más de $150' ? 'selected' : '' }}>Más de $150</option>
                                </select>
                            </div>

                            <div class="sm:col-span-2">
                                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Cuentame sobre tu evento</label>
                                <textarea name="message" rows="4"
                                          placeholder="Tipo de evento, capacidad esperada, duración..."
                                          class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-cyan-400 transition-colors">{{ old('message') }}</textarea>
                            </div>
                        </div>

                        <button type="submit"
                                class="px-8 py-3 bg-cyan-400 text-black text-sm font-bold rounded-lg hover:bg-cyan-300 transition-colors uppercase tracking-widest">
                            Reservar Evento
                        </button>
                    </form>
                </div>

                {{-- Sidebar --}}
                <div class="space-y-6">

                    {{-- Redes --}}
                    <div class="bg-white/5 rounded-xl border border-white/5 p-6">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-4">Encuéntrame en</p>
                        <div class="grid grid-cols-2 gap-3">
                            @if($profile && $profile->instagram)
                                <a href="{{ $profile->instagram }}" target="_blank"
                                   class="flex items-center justify-center gap-2 px-3 py-2 bg-white/5 rounded-lg text-xs font-semibold text-gray-400 hover:text-white hover:bg-white/10 transition-colors">
                                    Instagram
                                </a>
                            @endif
                            @if($profile && $profile->soundcloud)
                                <a href="{{ $profile->soundcloud }}" target="_blank"
                                   class="flex items-center justify-center gap-2 px-3 py-2 bg-white/5 rounded-lg text-xs font-semibold text-gray-400 hover:text-white hover:bg-white/10 transition-colors">
                                    SoundCloud
                                </a>
                            @endif
                            @if($profile && $profile->facebook)
                                <a href="{{ $profile->facebook }}" target="_blank"
                                   class="flex items-center justify-center gap-2 px-3 py-2 bg-white/5 rounded-lg text-xs font-semibold text-gray-400 hover:text-white hover:bg-white/10 transition-colors">
                                    Facebook
                                </a>
                            @endif
                            @if($profile && $profile->youtube)
                                <a href="{{ $profile->youtube }}" target="_blank"
                                   class="flex items-center justify-center gap-2 px-3 py-2 bg-white/5 rounded-lg text-xs font-semibold text-gray-400 hover:text-white hover:bg-white/10 transition-colors">
                                    YouTube
                                </a>
                            @endif
                        </div>
                    </div>

                    {{-- Contacto directo --}}
                    @if($profile && $profile->email)
                        <div class="bg-white/5 rounded-xl border border-white/5 p-6">
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-3">Contacto directo</p>
                            <a href="mailto:{{ $profile->email }}"
                               class="text-sm text-cyan-400 hover:underline">{{ $profile->email }}</a>
                        </div>
                    @endif

                    {{-- Ubicación --}}
                    @if($profile && $profile->location)
                        <div class="bg-white/5 rounded-xl border border-white/5 p-6">
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-3">Ubicación</p>
                            <p class="text-sm text-gray-400 flex items-center gap-2">
                                <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                </svg>
                                {{ $profile->location }}
                            </p>
                            <p class="text-xs text-gray-600 mt-1">Disponible para bookings a nivel nacional.</p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>

@endsection