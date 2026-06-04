@extends('layouts.public')

@section('title', 'Galería — Yehiizon GarroCh')

@section('content')

    {{-- Header --}}
    <section class="py-20 border-b border-white/5">
        <div class="max-w-6xl mx-auto px-6">
            <p class="text-xs font-bold text-cyan-400 uppercase tracking-widest mb-4">Galería</p>
            <h1 class="font-bebas text-6xl lg:text-8xl text-white leading-none mb-4">Fotos & Videos</h1>
            <p class="text-gray-500 max-w-xl">Momentos capturados en cada evento.</p>
        </div>
    </section>

    {{-- Filtros --}}
    <section class="py-8 border-b border-white/5 sticky top-16 z-40 bg-[#0a0a0a]/90 backdrop-blur-md">
        <div class="max-w-6xl mx-auto px-6 flex items-center gap-3 flex-wrap">
            <button onclick="filterGallery('all')" id="filter-all"
                    class="filter-btn px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest bg-cyan-400 text-black transition-colors">
                Todos
            </button>
            <button onclick="filterGallery('photo')" id="filter-photo"
                    class="filter-btn px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest bg-white/5 text-gray-400 hover:text-white transition-colors">
                Fotos
            </button>
            <button onclick="filterGallery('video')" id="filter-video"
                    class="filter-btn px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest bg-white/5 text-gray-400 hover:text-white transition-colors">
                Videos
            </button>
            @foreach($events as $event)
                <button onclick="filterGallery('event-{{ $event->id }}')" id="filter-event-{{ $event->id }}"
                        class="filter-btn px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest bg-white/5 text-gray-400 hover:text-white transition-colors">
                    {{ $event->title }}
                </button>
            @endforeach
        </div>
    </section>

    {{-- Galería --}}
    <section class="py-20">
        <div class="max-w-6xl mx-auto px-6">

            @if($photos->isEmpty() && $videos->isEmpty())
                <div class="bg-white/5 rounded-xl border border-white/5 px-6 py-16 text-center">
                    <p class="text-gray-500">No hay contenido en la galería aún.</p>
                </div>
            @else
                <div class="columns-2 md:columns-3 lg:columns-4 gap-3 space-y-3" id="gallery-grid">

                    {{-- Fotos --}}
                    @foreach($photos as $photo)
                        <div class="gallery-item break-inside-avoid"
                             data-type="photo"
                             data-event="{{ $photo->event_id ?? '' }}">
                            <div class="relative group cursor-pointer overflow-hidden rounded-xl"
                                 onclick="openLightbox('{{ Storage::url($photo->file_path) }}', '{{ $photo->title }}', '{{ $photo->caption }}', 'photo')">
                                <img src="{{ Storage::url($photo->file_path) }}"
                                     class="w-full object-cover rounded-xl group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-colors rounded-xl flex items-center justify-center">
                                    <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                    </svg>
                                </div>
                                @if($photo->event)
                                    <div class="absolute top-2 left-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <span class="text-xs font-bold px-2 py-0.5 rounded bg-black/60 text-cyan-400">
                                            {{ $photo->event->title }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    {{-- Videos --}}
                    @foreach($videos as $video)
                        <div class="gallery-item break-inside-avoid"
                             data-type="video"
                             data-event="{{ $video->event_id ?? '' }}">
                            <div class="relative group cursor-pointer overflow-hidden rounded-xl"
                                 onclick="openLightbox('{{ Storage::url($video->file_path) }}', '{{ $video->title }}', '{{ $video->caption }}', 'video')">
                                @if($video->thumbnail)
                                    <img src="{{ Storage::url($video->thumbnail) }}"
                                         class="w-full object-cover rounded-xl group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-48 bg-white/10 rounded-xl flex items-center justify-center">
                                        <svg class="w-10 h-10 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.069A1 1 0 0121 8.82v6.36a1 1 0 01-1.447.894L15 14M3 8a2 2 0 012-2h8a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z"/>
                                        </svg>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-black/30 group-hover:bg-black/50 transition-colors rounded-xl flex items-center justify-center">
                                    <div class="w-12 h-12 rounded-full bg-white/20 backdrop-blur flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white ml-0.5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M8 5v14l11-7z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="absolute top-2 left-2">
                                    <span class="text-xs font-bold px-2 py-0.5 rounded bg-purple-400/80 text-white">Video</span>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            @endif
        </div>
    </section>

    {{-- Lightbox --}}
    <div id="lightbox" class="fixed inset-0 z-50 bg-black/95 hidden items-center justify-center p-4"
         onclick="closeLightbox()">
        <button class="absolute top-4 right-4 text-white/60 hover:text-white transition-colors z-10">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
        <div class="max-w-5xl w-full" onclick="event.stopPropagation()">
            <img id="lightbox-img" src="" class="w-full max-h-[80vh] object-contain rounded-xl hidden">
            <video id="lightbox-video" controls class="w-full max-h-[80vh] rounded-xl hidden">
                <source id="lightbox-video-src" src="" type="video/mp4">
            </video>
            <div class="mt-4 text-center">
                <p id="lightbox-title" class="text-white font-bold"></p>
                <p id="lightbox-caption" class="text-gray-500 text-sm mt-1"></p>
            </div>
        </div>
    </div>

    <script>
        function filterGallery(type) {
            // Actualizar botones
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('bg-cyan-400', 'text-black');
                btn.classList.add('bg-white/5', 'text-gray-400');
            });
            const activeBtn = document.getElementById('filter-' + type);
            if (activeBtn) {
                activeBtn.classList.add('bg-cyan-400', 'text-black');
                activeBtn.classList.remove('bg-white/5', 'text-gray-400');
            }

            // Filtrar items
            document.querySelectorAll('.gallery-item').forEach(item => {
                if (type === 'all') {
                    item.style.display = '';
                } else if (type === 'photo' || type === 'video') {
                    item.style.display = item.dataset.type === type ? '' : 'none';
                } else {
                    const eventId = type.replace('event-', '');
                    item.style.display = item.dataset.event === eventId ? '' : 'none';
                }
            });
        }

        function openLightbox(src, title, caption, type) {
            const lightbox = document.getElementById('lightbox');
            const img      = document.getElementById('lightbox-img');
            const video    = document.getElementById('lightbox-video');
            const videoSrc = document.getElementById('lightbox-video-src');

            document.getElementById('lightbox-title').textContent   = title || '';
            document.getElementById('lightbox-caption').textContent = caption || '';

            if (type === 'video') {
                img.classList.add('hidden');
                videoSrc.src = src;
                video.load();
                video.classList.remove('hidden');
            } else {
                video.classList.add('hidden');
                img.src = src;
                img.classList.remove('hidden');
            }

            lightbox.classList.remove('hidden');
            lightbox.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            const lightbox = document.getElementById('lightbox');
            lightbox.classList.add('hidden');
            lightbox.classList.remove('flex');
            document.getElementById('lightbox-video').pause();
            document.body.style.overflow = '';
        }

        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') closeLightbox();
        });
    </script>

@endsection