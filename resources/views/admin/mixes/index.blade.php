@extends('layouts.admin')

@section('page-title', 'Mixes')

@section('content')

    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-white">Mixes</h1>
            <p class="text-sm text-gray-500 mt-0.5">Gestiona tus sets y grabaciones</p>
        </div>
        <a href="{{ route('admin.mixes.create') }}"
           class="px-4 py-2 bg-cyan-400 text-black text-sm font-bold rounded-lg hover:bg-cyan-300 transition-colors">
            + Nuevo mix
        </a>
    </div>

    <div class="bg-white/5 rounded-xl border border-white/5 overflow-hidden">
        <table class="w-full">
            <thead>
                <tr class="border-b border-white/5">
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-widest">Mix</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-widest">Plataforma</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-widest">Género</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-widest">Fecha</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-widest">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($mixes as $mix)
                    <tr class="hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @if($mix->cover_image)
                                    <img src="{{ Storage::url($mix->cover_image) }}"
                                         class="w-10 h-10 rounded-lg object-cover">
                                @else
                                    <div class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2z"/>
                                        </svg>
                                    </div>
                                @endif
                                <div>
                                    <p class="text-sm font-medium text-white">{{ $mix->title }}</p>
                                    @if($mix->is_featured)
                                        <span class="text-xs text-cyan-400 font-medium">Destacado</span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-xs font-bold px-2 py-1 rounded uppercase tracking-widest bg-white/10 text-gray-300">
                                {{ $mix->platform }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-400">{{ $mix->genre ?? '—' }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-400">
                                {{ $mix->recorded_at ? $mix->recorded_at->format('d M Y') : '—' }}
                            </p>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.mixes.edit', $mix) }}"
                                   class="text-xs text-cyan-400 hover:underline font-medium">Editar</a>
                                <form method="POST" action="{{ route('admin.mixes.destroy', $mix) }}"
                                      onsubmit="return confirm('¿Eliminar este mix?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs text-red-400 hover:underline font-medium">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-sm text-gray-500">
                            No hay mixes aún.
                            <a href="{{ route('admin.mixes.create') }}" class="text-cyan-400 hover:underline">Subir el primero</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection