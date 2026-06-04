@extends('layouts.public')

@section('title', 'Eventos — Yehiizon GarroCh')

@section('content')

    {{-- Header --}}
    <section class="py-20 border-b border-white/5">
        <div class="max-w-6xl mx-auto px-6">
            <p class="text-xs font-bold text-cyan-400 uppercase tracking-widest mb-4">Black Music</p>
            <h1 class="font-bebas text-6xl lg:text-8xl text-white leading-none mb-4">Eventos</h1>
            <p class="text-gray-500 max-w-xl">Desde eventos privados hasta festivales. Aquí encontrarás dónde estaré tocando.</p>
        </div>
    </section>

    {{-- Upcoming Events --}}
    <section class="py-20">
        <div class="max-w-6xl mx-auto px-6">
            <div class="flex items-center gap-3 mb-10">
                <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <h2 class="text-2xl font-bold text-white">Próximos Eventos</h2>
            </div>

            @if($upcomingEvents->isEmpty())
                <div class="bg-white/5 rounded-xl border border-white/5 px-6 py-16 text-center">
                    <p class="text-gray-500">No hay eventos próximos por ahora. Vuelve pronto.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($upcomingEvents as $event)
                        <div class="bg-white/5 rounded-xl border border-white/5 overflow-hidden hover:border-cyan-400/20 transition-colors group">
                            @if($event->flyer_image)
                                <div class="relative overflow-hidden">
                                    <img src="{{ Storage::url($event->flyer_image) }}"
                                         class="w-full h-52 object-cover group-hover:scale-105 transition-transform duration-500">
                                    <div class="absolute top-3 left-3">
                                        <span @class([
                                            'text-xs font-bold px-2 py-1 rounded uppercase tracking-widest',
                                            'bg-cyan-400/90 text-black' => $event->status === 'confirmed',
                                            'bg-yellow-400/90 text-black' => $event->status === 'pending',
                                            'bg-red-400/90 text-black' => $event->status === 'cancelled',
                                        ])>
                                            {{ $event->status }}
                                        </span>
                                    </div>
                                </div>
                            @else
                                <div class="w-full h-52 bg-gradient-to-br from-cyan-400/10 to-transparent flex items-center justify-center relative">
                                    <span class="font-bebas text-4xl text-cyan-400/30">{{ $event->city }}</span>
                                    <div class="absolute top-3 left-3">
                                        <span @class([
                                            'text-xs font-bold px-2 py-1 rounded uppercase tracking-widest',
                                            'bg-cyan-400/90 text-black' => $event->status === 'confirmed',
                                            'bg-yellow-400/90 text-black' => $event->status === 'pending',
                                            'bg-red-400/90 text-black' => $event->status === 'cancelled',
                                        ])>
                                            {{ $event->status }}
                                        </span>
                                    </div>
                                </div>
                            @endif

                            <div class="p-5">
                                <p class="text-xs font-bold text-cyan-400 uppercase tracking-widest mb-1">
                                    {{ $event->date->format('M d, Y') }}
                                </p>
                                <h3 class="text-lg font-bold text-white mb-1">{{ $event->title }}</h3>
                                <p class="text-sm text-gray-500 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    </svg>
                                    {{ $event->venue }}, {{ $event->city }}
                                </p>
                                @if($event->start_time)
                                    <p class="text-xs text-gray-600 mt-1">
                                        {{ $event->start_time }} — {{ $event->end_time }}
                                    </p>
                                @endif
                                @if($event->description)
                                    <p class="text-sm text-gray-500 mt-3 leading-relaxed">{{ $event->description }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- Recent Gigs --}}
    <section class="py-20 border-t border-white/5">
        <div class="max-w-6xl mx-auto px-6">
            <div class="flex items-center gap-3 mb-10">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h2 class="text-2xl font-bold text-white">Eventos Recientes</h2>
            </div>

            @if($pastEvents->isEmpty())
                <div class="bg-white/5 rounded-xl border border-white/5 px-6 py-12 text-center">
                    <p class="text-gray-500">No hay eventos pasados aún.</p>
                </div>
            @else
                <div class="space-y-3">
                    @foreach($pastEvents as $event)
                        <div class="bg-white/5 rounded-xl border border-white/5 px-6 py-4 flex items-center gap-4 hover:bg-white/[0.07] transition-colors">
                            @if($event->flyer_image)
                                <img src="{{ Storage::url($event->flyer_image) }}"
                                     class="w-14 h-14 rounded-lg object-cover shrink-0">
                            @else
                                <div class="w-14 h-14 rounded-lg bg-white/10 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                            <div class="flex-1 min-w-0">
                                <h3 class="text-sm font-bold text-white">{{ $event->title }}</h3>
                                <p class="text-xs text-gray-500 mt-0.5">
                                    {{ $event->venue }}, {{ $event->city }} — {{ $event->date->format('M d, Y') }}
                                </p>
                            </div>
                            @if($event->gallery->count())
                                <span class="text-xs font-bold px-2 py-1 rounded uppercase tracking-widest bg-white/10 text-gray-400 shrink-0">
                                    {{ $event->gallery->count() }} fotos
                                </span>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

@endsection