@extends('layouts.app')

@section('title', $culinary->name . ' - Kuliner Khas Kaltim')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center justify-between text-xs sm:text-sm text-slate-700">
        <nav class="flex items-center gap-2">
            <a href="{{ route('culinaries.index') }}" class="hover:text-emerald-700 transition-colors">Kuliner Khas</a>
            <span>/</span>
            <span class="text-slate-900 font-semibold truncate max-w-xs">{{ $culinary->name }}</span>
        </nav>
        <a href="{{ route('culinaries.index') }}" class="inline-flex items-center gap-1 font-semibold text-slate-700 hover:text-emerald-700">
            &larr; <span>Kembali ke Daftar</span>
        </a>
    </div>

    <article class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-xs">
        <div class="relative w-full aspect-[21/9] sm:aspect-[16/8] bg-slate-900 overflow-hidden">
            @if ($culinary->image_url)
                <img src="{{ $culinary->image_url }}" alt="{{ $culinary->name }}" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
            @else
                <div class="w-full h-full bg-gradient-to-br from-slate-800 via-slate-900 to-amber-950 flex flex-col items-center justify-center text-slate-300 p-6 pb-16">
                    <div class="w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-md flex items-center justify-center text-white mb-2 shadow-inner">
                        <svg class="w-8 h-8 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <p class="text-sm sm:text-base font-semibold text-white">Foto Kuliner Belum Diunggah</p>
                    <p class="text-xs text-slate-400 mt-0.5 text-center">Gunakan tombol "Edit Data" di bawah untuk mengunggah foto kuliner ini.</p>
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent pointer-events-none"></div>
            @endif

            <div class="absolute bottom-4 left-4 sm:left-6 flex flex-wrap gap-2">
                <span class="px-3 py-1 rounded-lg text-xs sm:text-sm font-semibold bg-emerald-700/90 backdrop-blur-md text-white shadow-sm">
                    Asal {{ $culinary->origin_city }}
                </span>
            </div>
        </div>

        <div class="p-6 sm:p-8 space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-6 border-b border-slate-100">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                        {{ $culinary->name }}
                    </h1>
                    <p class="text-xs text-slate-700 mt-1">Kuliner Tradisional &bull; Kabupaten/Kota {{ $culinary->origin_city }}</p>
                </div>
                <div class="sm:text-right shrink-0">
                    <span class="text-xs text-slate-600 block font-medium">Rentang Harga</span>
                    <span class="text-xl sm:text-2xl font-black text-emerald-700">
                        {{ $culinary->price_range }}
                    </span>
                </div>
            </div>

            <!-- Card Rekomendasi Spot -->
            <div class="p-4 rounded-xl bg-emerald-50/60 border border-emerald-200">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-emerald-700 text-white flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-emerald-800 font-semibold uppercase tracking-wider">Spot Rekomendasi Menikmati</p>
                        <p class="text-sm font-bold text-slate-900">{{ $culinary->recommended_spot }}</p>
                    </div>
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="space-y-3 pt-2">
                <h2 class="text-base font-bold text-slate-900 tracking-tight flex items-center gap-2">
                    <span class="w-1.5 h-4 rounded-full bg-emerald-600"></span>
                    Cita Rasa &amp; Keunikan Kuliner
                </h2>
                <div class="prose prose-slate max-w-none text-slate-700 leading-relaxed text-sm sm:text-base whitespace-pre-line">
                    {{ $culinary->description }}
                </div>
            </div>

            <!-- Action Bar -->
            <div class="pt-6 border-t border-slate-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <a href="{{ route('culinaries.index') }}" 
                   class="w-full sm:w-auto text-center px-4 py-2 rounded-lg border border-slate-300 text-xs sm:text-sm font-semibold text-slate-700 hover:bg-slate-100 transition-colors">
                    &larr; Kembali
                </a>

                <div class="flex items-center gap-2.5 w-full sm:w-auto">
                    <a href="{{ route('culinaries.edit', $culinary) }}" 
                       class="flex-1 sm:flex-none justify-center px-4 py-2 rounded-lg bg-amber-600 hover:bg-amber-700 text-white text-xs sm:text-sm font-semibold shadow-xs transition-colors flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        <span>Edit Data</span>
                    </a>

                    <form action="{{ route('culinaries.destroy', $culinary) }}" 
                          method="POST" 
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus &quot;{{ $culinary->name }}&quot;?');"
                          class="flex-1 sm:flex-none">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full justify-center px-4 py-2 rounded-lg bg-rose-600 hover:bg-rose-700 text-white text-xs sm:text-sm font-semibold shadow-xs transition-colors flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            <span>Hapus Kuliner</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </article>
</div>
@endsection

