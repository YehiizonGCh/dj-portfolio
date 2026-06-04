<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dj — Yehiizon GarroCh</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#0a0a0a] text-white">

    <div class="flex h-screen overflow-hidden">

        {{-- Sidebar --}}
        <aside class="w-56 bg-[#111111] border-r border-white/5 flex flex-col fixed h-full z-10">
            <div class="p-6 border-b border-white/5">
                <p class="text-xs font-bold text-cyan-400 uppercase tracking-widest">Admin Panel</p>
                <h1 class="text-base font-bold text-white mt-1">GarroCh</h1>
            </div>

            <nav class="flex-1 p-3 space-y-0.5">
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-colors
                   {{ request()->routeIs('admin.dashboard') ? 'bg-cyan-400/10 text-cyan-400' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('admin.events.index') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-colors
                   {{ request()->routeIs('admin.events*') ? 'bg-cyan-400/10 text-cyan-400' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Eventos
                </a>

                <a href="{{ route('admin.mixes.index') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-colors
                   {{ request()->routeIs('admin.mixes*') ? 'bg-cyan-400/10 text-cyan-400' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/>
                    </svg>
                    Mixes
                </a>

                <a href="{{ route('admin.gallery.index') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-colors
                   {{ request()->routeIs('admin.gallery*') ? 'bg-cyan-400/10 text-cyan-400' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Galería
                </a>

                <a href="{{ route('admin.reservations.index') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-colors
                   {{ request()->routeIs('admin.reservations*') ? 'bg-cyan-400/10 text-cyan-400' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    Reservaciones
                </a>

                <a href="{{ route('admin.messages.index') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-colors
                   {{ request()->routeIs('admin.messages*') ? 'bg-cyan-400/10 text-cyan-400' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Mensajes
                </a>

                <a href="{{ route('admin.profile.edit') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-colors
                   {{ request()->routeIs('admin.profile*') ? 'bg-cyan-400/10 text-cyan-400' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Perfil
                </a>
            </nav>

            <div class="p-3 border-t border-white/5 space-y-0.5">
                <a href="{{ route('admin.events.create') }}"
                   class="flex items-center justify-center gap-2 w-full px-3 py-2 bg-cyan-400 text-black text-sm font-bold rounded-lg hover:bg-cyan-300 transition-colors mb-3">
                    + Nuevo Evento
                </a>

                <a href="{{ route('home') }}" target="_blank"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium text-gray-400 hover:text-white hover:bg-white/5 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    Ver sitio
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium text-gray-400 hover:text-white hover:bg-white/5 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </aside>

        {{-- Contenido principal --}}
        <main class="flex-1 ml-56 overflow-y-auto">
            {{-- Header --}}
            <header class="bg-[#111111] border-b border-white/5 px-8 py-4 flex items-center justify-between sticky top-0 z-10">
                <h2 class="text-xs font-bold text-gray-500 uppercase tracking-widest">
                    @yield('page-title', 'Dashboard')
                </h2>
                @if(session('success'))
                    <span class="text-sm text-cyan-400 font-medium">✓ {{ session('success') }}</span>
                @endif
            </header>

            {{-- Página --}}
            <div class="p-8">
                @yield('content')
            </div>
        </main>

    </div>

</body>
</html>