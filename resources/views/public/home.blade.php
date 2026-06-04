@extends('layouts.public')

@section('title', ($profile->dj_name ?? 'Yehiizon GarroCh') . ' — DJ')

@section('content')

    {{-- Hero --}}
    <section class="py-24 border-b border-white/5">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

                {{-- Foto izquierda --}}
                @if($profile->photo)
                    <div class="flex justify-center lg:justify-start">
                        <div class="relative">
                            <div class="absolute inset-0 bg-cyan-400/10 rounded-2xl blur-2xl"></div>
                            <img src="{{ Storage::url($profile->photo) }}"
                                 class="relative w-full max-w-sm h-auto object-cover rounded-2xl border border-white/10 grayscale rotate-2">
                        </div>
                    </div>
                @endif

                {{-- Texto derecha --}}
                <div>
                    <p class="text-xs font-bold text-cyan-400 uppercase tracking-widest mb-3">Deejay</p>
                    <h1 class="font-bebas text-6xl lg:text-7xl text-white leading-none mb-4">
                        {{ $profile->dj_name ?? 'Yehiizon GarroCh' }}
                    </h1>
                    @if($profile->bio_short)
                        <p class="text-gray-400 leading-relaxed mb-3">{{ $profile->bio_short }}</p>
                    @endif
                    @if($profile->bio)
                        <p class="text-gray-500 text-sm leading-relaxed mb-4">{{ $profile->bio }}</p>
                    @endif
                    @if($profile->location)
                        <p class="text-sm text-gray-600 mb-6 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            </svg>
                            {{ $profile->location }}
                        </p>
                    @endif
                    <div class="flex gap-4">
                        <a href="{{ route('booking') }}"
                           class="px-6 py-3 bg-cyan-400 text-black text-sm font-bold rounded hover:bg-cyan-300 transition-colors uppercase tracking-widest">
                            Reservar
                        </a>
                        <a href="{{ route('mixes') }}"
                           class="px-6 py-3 border border-white/20 text-white text-sm font-bold rounded hover:bg-white/5 transition-colors uppercase tracking-widest">
                            Ver Mixes
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>
    {{-- Stats --}}
    @if($profile->gigs_played || $profile->countries)
    <section class="border-t border-b border-white/5 py-12">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center">
                <div>
                    <p class="font-bebas text-5xl text-white">{{ $profile->gigs_played }}+</p>
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest mt-1">Gigs Played</p>
                </div>
                <div>
                    <p class="font-bebas text-5xl text-white">{{ $profile->countries }}+</p>
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest mt-1">Países</p>
                </div>
                @if($featuredMix)
                <div class="col-span-2">
                    <p class="font-bebas text-5xl text-cyan-400">{{ $featuredMix->platform }}</p>
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest mt-1">Latest Mix Platform</p>
                </div>
                @endif
            </div>
        </div>
    </section>
    @endif

    {{-- Próximos eventos --}}
    @if($upcomingEvents->count())
    <section class="py-20">
        <div class="max-w-6xl mx-auto px-6">
            <div class="flex items-center justify-between mb-10">
                <div>
                    <p class="text-xs font-bold text-cyan-400 uppercase tracking-widest mb-2">Black Music</p>
                    <h2 class="font-bebas text-4xl text-white">Próximos Eventos</h2>
                </div>
                <a href="{{ route('events') }}" class="text-sm text-gray-400 hover:text-white transition-colors">
                    Ver todos →
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($upcomingEvents as $event)
                    <div class="bg-white/5 rounded-xl border border-white/5 overflow-hidden hover:border-cyan-400/20 transition-colors">
                        @if($event->flyer_image)
                            <img src="{{ Storage::url($event->flyer_image) }}"
                                 class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-cyan-400/10 to-transparent flex items-center justify-center">
                                <span class="font-bebas text-2xl text-cyan-400/50">{{ $event->city }}</span>
                            </div>
                        @endif
                        <div class="p-5">
                            <p class="text-xs font-bold text-cyan-400 uppercase tracking-widest mb-1">
                                {{ $event->date->format('M d, Y') }}
                            </p>
                            <h3 class="text-lg font-bold text-white mb-1">{{ $event->title }}</h3>
                            <p class="text-sm text-gray-500">{{ $event->venue }}, {{ $event->city }}</p>
                            @if($event->start_time)
                                <p class="text-xs text-gray-600 mt-1">{{ $event->start_time }} — {{ $event->end_time }}</p>
                            @endif
                            <span @class([
                                'inline-block mt-3 text-xs font-bold px-2 py-0.5 rounded uppercase tracking-widest',
                                'bg-cyan-400/10 text-cyan-400' => $event->status === 'confirmed',
                                'bg-yellow-400/10 text-yellow-400' => $event->status === 'pending',
                                'bg-red-400/10 text-red-400' => $event->status === 'cancelled',
                            ])>
                                {{ $event->status }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Mix destacado --}}
    @if($featuredMix)
    <section class="py-20 border-t border-white/5">
        <div class="max-w-6xl mx-auto px-6">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <p class="text-xs font-bold text-cyan-400 uppercase tracking-widest mb-2">Latest Mix</p>
                    <h2 class="font-bebas text-4xl text-white">{{ $featuredMix->title }}</h2>
                    @if($featuredMix->genre)
                        <p class="text-gray-500 text-sm mt-1">{{ $featuredMix->genre }}</p>
                    @endif
                </div>
                <a href="{{ route('mixes') }}" class="text-sm text-gray-400 hover:text-white transition-colors">
                    Ver todos los mixes →
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-5 gap-4 items-stretch">

                {{-- Player --}}
                <div class="lg:col-span-3 bg-white/5 rounded-xl border border-white/5 overflow-hidden">
                    @if($featuredMix->platform === 'youtube')
                        <div class="aspect-video">
                            <iframe width="100%" height="100%" frameborder="0"
                                    src="https://www.youtube.com/embed/{{ $featuredMix->embed_url }}"
                                    allowfullscreen class="rounded-xl">
                            </iframe>
                        </div>
                    @elseif($featuredMix->platform === 'soundcloud')
                        <div class="p-4">
                            <iframe width="100%" height="166" scrolling="no" frameborder="no"
                                    src="https://w.soundcloud.com/player/?url={{ urlencode($featuredMix->embed_url) }}&color=%2322d3ee&auto_play=false&hide_related=true&show_comments=false&show_user=true&show_reposts=false&visual=false">
                            </iframe>
                        </div>
                    @elseif($featuredMix->platform === 'mixcloud')
                        <div class="p-4">
                            <iframe width="100%" height="180" frameborder="0"
                                    src="https://www.mixcloud.com/widget/iframe/?hide_cover=1&mini=1&feed={{ urlencode($featuredMix->embed_url) }}">
                            </iframe>
                        </div>
                    @endif
                </div>

                {{-- Info lateral --}}
                <div class="lg:col-span-2 bg-white/5 rounded-xl border border-white/5 p-6 flex flex-col justify-between">
                    <div>
                        <span class="text-xs font-bold px-2 py-1 rounded uppercase tracking-widest bg-cyan-400/10 text-cyan-400">
                            {{ $featuredMix->platform }}
                        </span>
                        <h3 class="text-xl font-bold text-white mt-3 leading-snug">{{ $featuredMix->title }}</h3>
                        @if($featuredMix->genre)
                            <p class="text-sm text-gray-500 mt-1">{{ $featuredMix->genre }}</p>
                        @endif
                        @if($featuredMix->recorded_at)
                            <p class="text-xs text-gray-600 mt-1">{{ $featuredMix->recorded_at->format('M Y') }}</p>
                        @endif
                    </div>

                    <a href="{{ route('mixes') }}"
                       class="mt-6 flex items-center justify-center gap-2 px-4 py-2.5 bg-cyan-400 text-black text-sm font-bold rounded-lg hover:bg-cyan-300 transition-colors">
                        Ver todos los mixes
                    </a>
                </div>

            </div>
        </div>
    </section>
    @endif

    {{-- Redes sociales --}}
    @if($profile)
    <section class="py-16 border-t border-white/5">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-6">Sígueme en</p>
            <div class="flex justify-center gap-6 flex-wrap">
                @if($profile->instagram)
                    <a href="{{ $profile->instagram }}" target="_blank"
                       class="text-sm text-gray-400 hover:text-cyan-400 transition-colors font-medium">Instagram</a>
                @endif
                @if($profile->soundcloud)
                    <a href="{{ $profile->soundcloud }}" target="_blank"
                       class="text-sm text-gray-400 hover:text-cyan-400 transition-colors font-medium">SoundCloud</a>
                @endif
                @if($profile->mixcloud)
                    <a href="{{ $profile->mixcloud }}" target="_blank"
                       class="text-sm text-gray-400 hover:text-cyan-400 transition-colors font-medium">Mixcloud</a>
                @endif
                @if($profile->youtube)
                    <a href="{{ $profile->youtube }}" target="_blank"
                       class="text-sm text-gray-400 hover:text-cyan-400 transition-colors font-medium">YouTube</a>
                @endif
                @if($profile->spotify)
                    <a href="{{ $profile->spotify }}" target="_blank"
                       class="text-sm text-gray-400 hover:text-cyan-400 transition-colors font-medium">Spotify</a>
                @endif
                @if($profile->tiktok)
                    <a href="{{ $profile->tiktok }}" target="_blank"
                       class="text-sm text-gray-400 hover:text-cyan-400 transition-colors font-medium">TikTok</a>
                @endif
                @if($profile->facebook)
                    <a href="{{ $profile->facebook }}" target="_blank"
                       class="text-sm text-gray-400 hover:text-cyan-400 transition-colors font-medium">Facebook</a>
                @endif
            </div>
        </div>
    </section>
    @endif

@endsection