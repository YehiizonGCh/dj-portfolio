@extends('layouts.public')

@section('title', 'Mixes — Yehiizon GarroCh')

@section('content')

    {{-- Header --}}
    <section class="py-20 border-b border-white/5">
        <div class="max-w-6xl mx-auto px-6">
            <p class="text-xs font-bold text-cyan-400 uppercase tracking-widest mb-4">Sets & Grabaciones</p>
            <h1 class="font-bebas text-6xl lg:text-8xl text-white leading-none mb-4">Mixes</h1>
            <p class="text-gray-500 max-w-xl">Escucha mis sets más recientes en SoundCloud, Mixcloud y YouTube.</p>
        </div>
    </section>

    {{-- Player --}}
    <section class="py-20">
        <div class="max-w-6xl mx-auto px-6">

            @if($mixes->isEmpty())
                <div class="bg-white/5 rounded-xl border border-white/5 px-6 py-16 text-center">
                    <p class="text-gray-500">No hay mixes disponibles aún. Vuelve pronto.</p>
                </div>
            @else
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-bold text-white">Latest Releases</h2>
                    <p class="text-xs text-gray-500">{{ $mixes->count() }} sets</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4" style="height: 520px;">

                    {{-- Player principal --}}
                    <div class="lg:col-span-2 bg-white/5 rounded-xl border border-white/5 overflow-hidden flex flex-col h-full">

                        {{-- Cover --}}
                        <div class="relative flex-1 overflow-hidden" id="player-cover">
                            @if($mixes->first()->cover_image)
                                <img id="cover-img"
                                     src="{{ Storage::url($mixes->first()->cover_image) }}"
                                     class="w-full h-full object-cover">
                            @else
                                <div id="cover-placeholder" class="w-full h-full bg-gradient-to-br from-cyan-400/10 to-transparent flex items-center justify-center">
                                    <svg class="w-16 h-16 text-cyan-400/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2z"/>
                                    </svg>
                                </div>
                            @endif

                            {{-- Overlay info --}}
                            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-5">
                                <span id="player-badge" class="text-xs font-bold px-2 py-0.5 rounded uppercase tracking-widest bg-cyan-400/20 text-cyan-400 mb-2 inline-block">
                                    {{ $mixes->first()->platform }}
                                </span>
                                <h3 id="player-title" class="text-xl font-bold text-white">{{ $mixes->first()->title }}</h3>
                                <p id="player-meta" class="text-xs text-gray-400 mt-0.5">
                                    {{ $mixes->first()->genre }}
                                    @if($mixes->first()->recorded_at) • {{ $mixes->first()->recorded_at->format('M Y') }} @endif
                                </p>
                            </div>
                        </div>

                        {{-- Embed --}}
                        <div id="player-embed" class="shrink-0">
                            @php $first = $mixes->first(); @endphp
                            @if($first->platform === 'soundcloud')
                                <iframe id="embed-frame" width="100%" height="120" scrolling="no" frameborder="no"
                                        src="https://w.soundcloud.com/player/?url={{ urlencode($first->embed_url) }}&color=%2322d3ee&auto_play=false&hide_related=true&show_comments=false&show_user=true&show_reposts=false&visual=false">
                                </iframe>
                            @elseif($first->platform === 'mixcloud')
                                <iframe id="embed-frame" width="100%" height="120" frameborder="0"
                                        src="https://www.mixcloud.com/widget/iframe/?hide_cover=1&mini=1&feed={{ urlencode($first->embed_url) }}">
                                </iframe>
                            @elseif($first->platform === 'youtube')
                                <div class="aspect-video">
                                    <iframe id="embed-frame" width="100%" height="100%" frameborder="0"
                                            src="https://www.youtube.com/embed/{{ $first->embed_url }}"
                                            allowfullscreen>
                                    </iframe>
                                </div>
                            @endif
                        </div>

                    </div>

                    {{-- Lista scrollable --}}
                    <div class="bg-white/5 rounded-xl border border-white/5 overflow-hidden flex flex-col h-full">
                        <div class="px-4 py-3 border-b border-white/5 shrink-0">
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest">Playlist</p>
                        </div>
                        <div class="overflow-y-auto flex-1 divide-y divide-white/5" id="mix-list">
                            @foreach($mixes as $index => $mix)
                                <button onclick="loadMix(this)"
                                        data-title="{{ $mix->title }}"
                                        data-genre="{{ $mix->genre }}"
                                        data-platform="{{ $mix->platform }}"
                                        data-embed="{{ $mix->platform === 'soundcloud' ? 'https://w.soundcloud.com/player/?url=' . urlencode($mix->embed_url) . '&color=%2322d3ee&auto_play=true&hide_related=true&show_comments=false&show_user=true&show_reposts=false&visual=false' : ($mix->platform === 'mixcloud' ? 'https://www.mixcloud.com/widget/iframe/?hide_cover=1&mini=1&feed=' . urlencode($mix->embed_url) : 'https://www.youtube.com/embed/' . $mix->embed_url . '?autoplay=1') }}"
                                        data-cover="{{ $mix->cover_image ? Storage::url($mix->cover_image) : '' }}"
                                        data-date="{{ $mix->recorded_at ? $mix->recorded_at->format('M Y') : '' }}"
                                        class="w-full flex items-center gap-3 px-4 py-3 hover:bg-white/5 transition-colors text-left {{ $index === 0 ? 'bg-white/5' : '' }}">

                                    @if($mix->cover_image)
                                        <img src="{{ Storage::url($mix->cover_image) }}"
                                             class="w-10 h-10 rounded-lg object-cover shrink-0">
                                    @else
                                        <div class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center shrink-0">
                                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13"/>
                                            </svg>
                                        </div>
                                    @endif

                                    <div class="flex-1 min-w-0 text-left">
                                        <p class="text-xs font-semibold text-white truncate">{{ $mix->title }}</p>
                                        <p class="text-xs text-gray-500 truncate mt-0.5">
                                            {{ $mix->genre }}
                                            @if($mix->recorded_at) • {{ $mix->recorded_at->format('M Y') }} @endif
                                        </p>
                                    </div>

                                    <span class="text-xs font-bold px-1.5 py-0.5 rounded uppercase bg-white/10 text-gray-500 shrink-0">
                                        {{ substr($mix->platform, 0, 2) }}
                                    </span>
                                </button>
                            @endforeach
                        </div>
                    </div>

                </div>
            @endif

        </div>
    </section>

    <script>
        function loadMix(btn) {
            // Resaltar seleccionado
            document.querySelectorAll('#mix-list button').forEach(b => b.classList.remove('bg-white/5'));
            btn.classList.add('bg-white/5');

            const title    = btn.dataset.title;
            const genre    = btn.dataset.genre;
            const platform = btn.dataset.platform;
            const embed    = btn.dataset.embed;
            const cover    = btn.dataset.cover;
            const date     = btn.dataset.date;

            // Actualizar info
            document.getElementById('player-title').textContent = title;
            document.getElementById('player-meta').textContent  = genre + (date ? ' • ' + date : '');
            document.getElementById('player-badge').textContent = platform;

            // Actualizar cover
            const coverImg         = document.getElementById('cover-img');
            const coverPlaceholder = document.getElementById('cover-placeholder');

            if (cover) {
                if (!coverImg) {
                    const img = document.createElement('img');
                    img.id = 'cover-img';
                    img.className = 'w-full h-full object-cover';
                    img.src = cover;
                    document.getElementById('player-cover').prepend(img);
                    if (coverPlaceholder) coverPlaceholder.remove();
                } else {
                    coverImg.src = cover;
                }
            }

            // Actualizar embed
            const embedDiv = document.getElementById('player-embed');
            if (platform === 'youtube') {
                embedDiv.innerHTML = `<div class="aspect-video"><iframe width="100%" height="100%" frameborder="0" src="${embed}" allowfullscreen></iframe></div>`;
            } else {
                embedDiv.innerHTML = `<iframe width="100%" height="120" scrolling="no" frameborder="no" src="${embed}"></iframe>`;
            }
        }
    </script>

@endsection