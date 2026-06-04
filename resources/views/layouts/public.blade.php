<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Yehiizon GarroCh — DJ')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .font-bebas { font-family: 'Bebas Neue', sans-serif; }
    </style>
</head>
<body class="bg-[#0a0a0a] text-white">

    {{-- Navbar --}}
    <nav class="fixed top-0 left-0 right-0 z-50 bg-[#0a0a0a]/80 backdrop-blur-md border-b border-white/5">
        <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="{{ route('home') }}" class="font-bebas text-2xl tracking-widest text-cyan-400">
                Yehiizon GarroCh
            </a>

            <div class="hidden md:flex items-center gap-8">
                <a href="{{ route('home') }}"
                   class="text-sm font-medium {{ request()->routeIs('home') ? 'text-cyan-400' : 'text-gray-400 hover:text-white' }} transition-colors">
                    Home
                </a>
                <a href="{{ route('events') }}"
                   class="text-sm font-medium {{ request()->routeIs('events') ? 'text-cyan-400' : 'text-gray-400 hover:text-white' }} transition-colors">
                    Eventos
                </a>
                <a href="{{ route('gallery') }}"
                    class="text-sm font-medium {{ request()->routeIs('gallery') ? 'text-cyan-400' : 'text-gray-400 hover:text-white' }} transition-colors">
                    Galería
                </a>
                <a href="{{ route('mixes') }}"
                   class="text-sm font-medium {{ request()->routeIs('mixes') ? 'text-cyan-400' : 'text-gray-400 hover:text-white' }} transition-colors">
                    Mixes
                </a>
                <a href="{{ route('contact') }}"
                   class="text-sm font-medium {{ request()->routeIs('contact') ? 'text-cyan-400' : 'text-gray-400 hover:text-white' }} transition-colors">
                    Contacto
                </a>
                <a href="{{ route('booking') }}"
                   class="px-4 py-2 bg-cyan-400 text-black text-sm font-semibold rounded hover:bg-cyan-300 transition-colors">
                    Reservar
                </a>
            </div>
        </div>
    </nav>

    {{-- Contenido --}}
    <main class="pt-16">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="border-t border-white/5 py-12 mt-20">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <p class="font-bebas text-2xl tracking-widest text-cyan-400 mb-4">Yehiizon GarroCh</p>
            <div class="flex justify-center gap-6 mb-6">
                <a href="{{ route('home') }}" class="text-xs text-gray-500 hover:text-white transition-colors">Home</a>
                <a href="{{ route('events') }}" class="text-xs text-gray-500 hover:text-white transition-colors">Eventos</a>
                <a href="{{ route('mixes') }}" class="text-xs text-gray-500 hover:text-white transition-colors">Mixes</a>
                <a href="{{ route('contact') }}" class="text-xs text-gray-500 hover:text-white transition-colors">Contacto</a>
                <a href="{{ route('booking') }}" class="text-xs text-gray-500 hover:text-white transition-colors">Reservar</a>
            </div>
            <p class="text-xs text-gray-600">© {{ date('Y') }} Yehiizon GarroCh. Todos los derechos reservados.</p>
        </div>
    </footer>

</body>
</html>