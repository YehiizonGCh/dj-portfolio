@extends('layouts.admin')

@section('page-title', 'Perfil')

@section('content')

    <div class="mb-8">
        <h1 class="text-2xl font-bold text-white">Perfil</h1>
        <p class="text-sm text-gray-500 mt-0.5">Información pública de tu sitio</p>
    </div>

    <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Foto de perfil --}}
            <div class="bg-white/5 rounded-xl border border-white/5 p-6 h-fit">
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-4">Foto de perfil</p>

                <div class="flex flex-col items-center gap-4">
                    @if($profile->photo)
                        <img src="{{ Storage::url($profile->photo) }}"
                             class="w-32 h-32 rounded-full object-cover border-2 border-cyan-400/30">
                    @else
                        <div class="w-32 h-32 rounded-full bg-white/10 flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                    @endif
                    <input type="file" name="photo" accept="image/*"
                           class="w-full text-xs text-gray-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-cyan-400/10 file:text-cyan-400 hover:file:bg-cyan-400/20">
                </div>
            </div>

            {{-- Info principal --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Identidad --}}
                <div class="bg-white/5 rounded-xl border border-white/5 p-6">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-4">Identidad</p>

                    @if($errors->any())
                        <div class="mb-4 p-4 bg-red-400/10 border border-red-400/20 rounded-lg">
                            <ul class="text-sm text-red-400 space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Nombre DJ</label>
                            <input type="text" name="dj_name" value="{{ old('dj_name', $profile->dj_name) }}"
                                   class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-cyan-400">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Nombre real</label>
                            <input type="text" name="real_name" value="{{ old('real_name', $profile->real_name) }}"
                                   class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-cyan-400">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Email público</label>
                            <input type="email" name="email" value="{{ old('email', $profile->email) }}"
                                   class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-cyan-400">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Teléfono</label>
                            <input type="text" name="phone" value="{{ old('phone', $profile->phone) }}"
                                   class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-cyan-400">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Ubicación</label>
                            <input type="text" name="location" value="{{ old('location', $profile->location) }}"
                                   placeholder="Lima, Perú"
                                   class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-cyan-400">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Bio corta (hero)</label>
                            <input type="text" name="bio_short" value="{{ old('bio_short', $profile->bio_short) }}"
                                   placeholder="Una línea que describe tu sonido..."
                                   class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-cyan-400">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Bio completa</label>
                            <textarea name="bio" rows="4"
                                      class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-cyan-400">{{ old('bio', $profile->bio) }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Stats --}}
                <div class="bg-white/5 rounded-xl border border-white/5 p-6">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-4">Stats públicos</p>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Gigs tocados</label>
                            <input type="number" name="gigs_played" value="{{ old('gigs_played', $profile->gigs_played) }}" min="0"
                                   class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-cyan-400">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Países</label>
                            <input type="number" name="countries" value="{{ old('countries', $profile->countries) }}" min="0"
                                   class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-cyan-400">
                        </div>
                    </div>
                </div>

                {{-- Redes sociales --}}
                <div class="bg-white/5 rounded-xl border border-white/5 p-6">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-4">Redes sociales</p>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        @foreach(['instagram' => 'Instagram', 'soundcloud' => 'SoundCloud', 'mixcloud' => 'Mixcloud', 'youtube' => 'YouTube', 'spotify' => 'Spotify', 'facebook' => 'Facebook', 'tiktok' => 'TikTok'] as $field => $label)
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">{{ $label }}</label>
                                <input type="text" name="{{ $field }}" value="{{ old($field, $profile->$field) }}"
                                       placeholder="https://..."
                                       class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-cyan-400">
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex gap-3">
                    <button type="submit"
                            class="px-5 py-2 bg-cyan-400 text-black text-sm font-bold rounded-lg hover:bg-cyan-300 transition-colors">
                        Guardar cambios
                    </button>
                </div>

            </div>
        </div>
    </form>

@endsection