@extends('layouts.app')

@section('title', $destination->name . ' - Pesona Kaltim')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Top Back Navigation -->
    <div class="flex items-center justify-between text-xs sm:text-sm">
        <a href="{{ route('destinations.index') }}" 
           class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white border border-slate-200 text-slate-700 hover:text-emerald-700 hover:border-emerald-300 font-semibold shadow-2xs transition-all">
            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            <span>Semua Destinasi</span>
        </a>

        <div class="flex items-center gap-1.5 text-xs text-slate-700 font-medium">
            <span class="inline-block w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            <span>Destinasi Terverifikasi</span>
        </div>
    </div>

    <!-- Main Editorial Article Card -->
    <article class="bg-white rounded-3xl border border-slate-200/80 overflow-hidden shadow-xs">
        <!-- Hero Image Banner with Gradient Overlay -->
        <div class="relative w-full aspect-[16/10] sm:aspect-[21/9] bg-slate-900 overflow-hidden group">
            @if ($destination->image_url)
                <img src="{{ $destination->image_url }}" 
                     alt="{{ $destination->name }}" 
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/20 to-transparent"></div>
            @else
                <div class="w-full h-full bg-gradient-to-br from-slate-800 via-slate-900 to-emerald-950 flex flex-col items-center justify-center text-slate-300 p-6 pb-20">
                    <div class="w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-md flex items-center justify-center text-white mb-2 shadow-inner">
                        <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <p class="text-sm sm:text-base font-semibold text-white">Belum Ada Foto</p>
                    <p class="text-xs text-slate-400 mt-0.5 text-center">Gunakan tombol "Edit Informasi" di bawah untuk mengunggah foto destinasi ini.</p>
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent pointer-events-none"></div>
            @endif

            <!-- Badges Floating Over Image -->
            <div class="absolute bottom-4 left-4 sm:bottom-6 sm:left-6 right-4 flex flex-wrap items-center justify-between gap-2">
                <div class="flex flex-wrap items-center gap-2">
                    <span class="px-3 py-1 rounded-full text-xs font-bold tracking-wide uppercase bg-emerald-600/90 backdrop-blur-md text-white shadow-sm border border-emerald-400/30">
                        {{ $destination->category }}
                    </span>
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-slate-900/80 backdrop-blur-md text-slate-100 shadow-sm border border-white/10 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Kab/Kota {{ $destination->location_city }}
                    </span>
                </div>

                <div class="hidden sm:block">
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-white/90 backdrop-blur-md text-slate-900 shadow-sm">
                        Kalimantan Timur
                    </span>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="p-6 sm:p-8 md:p-10 space-y-8">
            <!-- Header Title & Price Widget -->
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 pb-6 border-b border-slate-100">
                <div class="space-y-1.5">
                    <div class="flex items-center gap-2 text-xs font-bold tracking-wider text-emerald-800 uppercase">
                        <span>Wisata Unggulan Kaltim</span>
                        <span>&bull;</span>
                        <span>Bumi Etam</span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">
                        {{ $destination->name }}
                    </h1>
                </div>

                <!-- Price Highlight Box -->
                <div class="bg-emerald-50/80 border border-emerald-200/80 rounded-2xl p-3.5 sm:p-4 text-left sm:text-right shrink-0">
                    <span class="text-xs text-emerald-800 font-semibold block uppercase tracking-wider">Tiket Masuk</span>
                    <span class="text-xl sm:text-2xl font-black text-emerald-900 tracking-tight">
                        {{ $destination->ticket_price_display }}
                        @if ($destination->ticket_price > 0)
                            <span class="text-xs font-normal text-emerald-700">/ orang</span>
                        @endif
                    </span>
                </div>
            </div>

            <!-- Key Info Stat Cards (Clean Modern Grid) -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3.5">
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/60 flex items-center gap-3.5">
                    <div class="w-11 h-11 rounded-xl bg-emerald-100/80 text-emerald-800 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[11px] font-semibold text-slate-600 uppercase tracking-wider">Jam Operasional</p>
                        <p class="text-sm font-bold text-slate-900 truncate mt-0.5">{{ $destination->opening_hours }}</p>
                    </div>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/60 flex items-center gap-3.5">
                    <div class="w-11 h-11 rounded-xl bg-blue-100/80 text-blue-800 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[11px] font-semibold text-slate-600 uppercase tracking-wider">Lokasi Wilayah</p>
                        <p class="text-sm font-bold text-slate-900 truncate mt-0.5">{{ $destination->location_city }}</p>
                    </div>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/60 flex items-center gap-3.5">
                    <div class="w-11 h-11 rounded-xl bg-amber-100/80 text-amber-800 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[11px] font-semibold text-slate-600 uppercase tracking-wider">Kategori Wisata</p>
                        <p class="text-sm font-bold text-slate-900 truncate mt-0.5">{{ $destination->category }}</p>
                    </div>
                </div>
            </div>

            <!-- Full Description Body -->
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-6 rounded-full bg-emerald-600"></span>
                    <h2 class="text-lg sm:text-xl font-bold text-slate-900 tracking-tight">
                        Tentang &amp; Daya Tarik Wisata
                    </h2>
                </div>
                <div class="prose prose-slate max-w-none text-slate-700 leading-relaxed text-sm sm:text-base whitespace-pre-line bg-slate-50/50 p-5 sm:p-6 rounded-2xl border border-slate-100">
                    {{ $destination->description }}
                </div>
            </div>

            <!-- Action Bar (BREAD Operations) -->
            <div class="pt-6 border-t border-slate-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <a href="{{ route('destinations.index') }}" 
                   class="w-full sm:w-auto text-center px-5 py-2.5 rounded-xl border border-slate-300 text-xs sm:text-sm font-semibold text-slate-700 hover:bg-slate-100 transition-colors">
                    &larr; Kembali ke Daftar
                </a>

                <div class="flex items-center gap-2.5 w-full sm:w-auto">
                    <a href="{{ route('destinations.edit', $destination) }}" 
                       class="flex-1 sm:flex-none justify-center px-5 py-2.5 rounded-xl bg-amber-600 hover:bg-amber-700 text-white text-xs sm:text-sm font-semibold shadow-xs transition-colors flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        <span>Edit Informasi</span>
                    </a>

                    <form action="{{ route('destinations.destroy', $destination) }}" 
                          method="POST" 
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus data destinasi &quot;{{ $destination->name }}&quot;?');"
                          class="flex-1 sm:flex-none">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full justify-center px-5 py-2.5 rounded-xl bg-rose-600 hover:bg-rose-700 text-white text-xs sm:text-sm font-semibold shadow-xs transition-colors flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            <span>Hapus</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </article>
</div>
@endsection
