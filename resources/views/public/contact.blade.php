@extends('layouts.public')

@section('title', 'Contacto — Yehiizon GarroCh')

@section('content')

    {{-- Header --}}
    <section class="py-20 border-b border-white/5">
        <div class="max-w-6xl mx-auto px-6">
            <p class="text-xs font-bold text-cyan-400 uppercase tracking-widest mb-4">Contacto</p>
            <h1 class="font-bebas text-6xl lg:text-8xl text-white leading-none mb-4">Hablemos</h1>
            <p class="text-gray-500 max-w-xl">¿Tienes alguna pregunta? Escríbeme y te responderé a la brevedad.</p>
        </div>
    </section>

    <section class="py-20">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

                {{-- Formulario --}}
                <div class="lg:col-span-2">
                    <h2 class="text-xl font-bold text-white mb-6">Envíame un mensaje</h2>

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

                    <form method="POST" action="{{ route('contact.store') }}" class="space-y-5">
                        @csrf

                        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Nombre</label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                       placeholder="Tu nombre"
                                       class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-cyan-400 transition-colors">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}"
                                       placeholder="email@ejemplo.com"
                                       class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-cyan-400 transition-colors">
                            </div>

                            <div class="sm:col-span-2">
                                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Asunto</label>
                                <input type="text" name="subject" value="{{ old('subject') }}"
                                       placeholder="¿De qué se trata?"
                                       class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-cyan-400 transition-colors">
                            </div>

                            <div class="sm:col-span-2">
                                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Mensaje</label>
                                <textarea name="body" rows="5"
                                          placeholder="Escribe tu mensaje aquí..."
                                          class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-cyan-400 transition-colors">{{ old('body') }}</textarea>
                            </div>
                        </div>

                        <button type="submit"
                                class="px-8 py-3 bg-cyan-400 text-black text-sm font-bold rounded-lg hover:bg-cyan-300 transition-colors uppercase tracking-widest">
                            Enviar mensaje
                        </button>
                    </form>
                </div>

                {{-- Sidebar --}}
                <div class="space-y-6">

                    @if($profile ?? false)
                        @if($profile->email)
                            <div class="bg-white/5 rounded-xl border border-white/5 p-6">
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-3">Email</p>
                                <a href="mailto:{{ $profile->email }}"
                                   class="text-sm text-cyan-400 hover:underline">{{ $profile->email }}</a>
                            </div>
                        @endif

                        @if($profile->phone)
                            <div class="bg-white/5 rounded-xl border border-white/5 p-6">
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-3">Teléfono</p>
                                <a href="tel:{{ $profile->phone }}"
                                   class="text-sm text-cyan-400 hover:underline">{{ $profile->phone }}</a>
                            </div>
                        @endif

                        @if($profile->location)
                            <div class="bg-white/5 rounded-xl border border-white/5 p-6">
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-3">Ubicación</p>
                                <p class="text-sm text-gray-400 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-cyan-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    </svg>
                                    {{ $profile->location }}
                                </p>
                            </div>
                        @endif

                        <div class="bg-white/5 rounded-xl border border-white/5 p-6">
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-4">Redes sociales</p>
                            <div class="space-y-2">
                                @if($profile->instagram)
                                    <a href="{{ $profile->instagram }}" target="_blank"
                                       class="flex items-center justify-between px-3 py-2 bg-white/5 rounded-lg text-xs font-semibold text-gray-400 hover:text-white hover:bg-white/10 transition-colors">
                                        Instagram <span class="text-cyan-400">→</span>
                                    </a>
                                @endif
                                @if($profile->soundcloud)
                                    <a href="{{ $profile->soundcloud }}" target="_blank"
                                       class="flex items-center justify-between px-3 py-2 bg-white/5 rounded-lg text-xs font-semibold text-gray-400 hover:text-white hover:bg-white/10 transition-colors">
                                        SoundCloud <span class="text-cyan-400">→</span>
                                    </a>
                                @endif
                                @if($profile->mixcloud)
                                    <a href="{{ $profile->mixcloud }}" target="_blank"
                                       class="flex items-center justify-between px-3 py-2 bg-white/5 rounded-lg text-xs font-semibold text-gray-400 hover:text-white hover:bg-white/10 transition-colors">
                                        Mixcloud <span class="text-cyan-400">→</span>
                                    </a>
                                @endif
                                @if($profile->tiktok)
                                    <a href="{{ $profile->tiktok }}" target="_blank"
                                       class="flex items-center justify-between px-3 py-2 bg-white/5 rounded-lg text-xs font-semibold text-gray-400 hover:text-white hover:bg-white/10 transition-colors">
                                        TikTok <span class="text-cyan-400">→</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>

@endsection