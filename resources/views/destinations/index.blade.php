@extends('layouts.app')

@section('title', 'Katalog Destinasi Wisata Kalimantan Timur')

@section('content')
<div class="space-y-6 sm:space-y-8">
    <!-- Header & Hero Ringkas -->
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-slate-900 via-emerald-950 to-slate-900 text-white p-6 sm:p-12 shadow-md">
        <div class="relative z-10 max-w-3xl space-y-3 sm:space-y-4">
            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] sm:text-xs font-semibold bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">
                <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Provinsi Kalimantan Timur &bull; Ibu Kota Nusantara
            </span>
            <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight text-white leading-tight">
                Jelajahi Surga Wisata Bumi Etam
            </h1>
            <p class="text-slate-300 text-xs sm:text-base leading-relaxed">
                Mulai dari kemegahan bawah laut Kepulauan Derawan, keasrian hutan tropis Bukit Bangkirai, hingga kekayaan budaya Dayak di pedalaman Mahakam.
            </p>
        </div>
        <!-- Subtle Pattern Decor -->
        <div class="absolute -right-16 -bottom-16 w-64 h-64 bg-emerald-600/10 rounded-full blur-3xl pointer-events-none"></div>
    </div>

    <!-- Filter & Search Bar -->
    <div class="bg-white p-4 sm:p-6 rounded-xl border border-slate-200 shadow-xs">
        <form method="GET" action="{{ route('destinations.index') }}" class="grid grid-cols-1 sm:grid-cols-12 gap-3 sm:gap-4 items-center">
            <!-- Search Input -->
            <div class="sm:col-span-4 relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}" 
                       placeholder="Cari destinasi atau kata kunci..." 
                       class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm text-slate-800 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
            </div>

            <!-- Filter Kategori -->
            <div class="sm:col-span-3">
                <select name="category" 
                        class="w-full py-2.5 px-3 bg-slate-50 border border-slate-300 rounded-lg text-sm text-slate-800 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                            {{ $cat }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Filter Kota / Kabupaten -->
            <div class="sm:col-span-3">
                <select name="city" 
                        class="w-full py-2.5 px-3 bg-slate-50 border border-slate-300 rounded-lg text-sm text-slate-800 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
                    <option value="">Semua Kota/Kabupaten</option>
                    @foreach ($cities as $cty)
                        <option value="{{ $cty }}" {{ request('city') == $cty ? 'selected' : '' }}>
                            {{ $cty }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tombol Filter -->
            <div class="sm:col-span-2 flex items-center gap-2">
                <button type="submit" 
                        class="w-full py-2.5 px-4 rounded-lg bg-emerald-700 hover:bg-emerald-800 text-white text-sm font-semibold transition-colors flex items-center justify-center gap-1.5 shadow-xs">
                    <span>Filter</span>
                </button>
                @if(request('search') || request('category') || request('city'))
                    <a href="{{ route('destinations.index') }}" 
                       title="Reset Filter"
                       class="p-2.5 rounded-lg border border-slate-300 text-slate-700 hover:bg-slate-100 transition-colors flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Total Data & Sorting Status -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between text-xs sm:text-sm text-slate-700 px-1 gap-1">
        <p>
            Menampilkan <span class="font-bold text-slate-900">{{ $destinations->total() }}</span> destinasi wisata terdaftar
        </p>
        <span class="text-slate-600">Urutan Terbaru</span>
    </div>

    <!-- Grid Card Destinasi -->
    @if ($destinations->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6">
            @foreach ($destinations as $item)
                <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-xs hover:shadow-md transition-shadow flex flex-col group">
                    <!-- Thumbnail Image / Placeholder -->
                    <div class="relative aspect-[16/10] bg-slate-900 overflow-hidden">
                        @if ($item->image_url)
                            <img src="{{ $item->image_url }}" 
                                 alt="{{ $item->name }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent"></div>
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-slate-800 to-slate-900 flex flex-col items-center justify-center text-slate-400 p-4">
                                <div class="w-11 h-11 rounded-xl bg-slate-700/60 flex items-center justify-center text-slate-300 mb-1.5 shadow-inner">
                                    <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <span class="text-xs font-semibold text-slate-300">Belum Ada Foto</span>
                                <span class="text-[10px] text-slate-400">Siap diunggah</span>
                            </div>
                        @endif

                        <!-- Badges on Image -->
                        <div class="absolute top-2.5 left-2.5 sm:top-3 sm:left-3 flex flex-wrap gap-1.5">
                            <span class="px-2 py-0.5 sm:px-2.5 sm:py-1 rounded-md text-[11px] sm:text-xs font-semibold bg-emerald-700/90 backdrop-blur-xs text-white shadow-xs">
                                {{ $item->category }}
                            </span>
                            <span class="px-2 py-0.5 sm:px-2.5 sm:py-1 rounded-md text-[11px] sm:text-xs font-semibold bg-slate-900/80 backdrop-blur-xs text-slate-100 shadow-xs">
                                {{ $item->location_city }}
                            </span>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-4 sm:p-5 flex-1 flex flex-col">
                        <h2 class="text-base sm:text-lg font-bold text-slate-900 tracking-tight line-clamp-1 group-hover:text-emerald-700 transition-colors">
                            <a href="{{ route('destinations.show', $item) }}">
                                {{ $item->name }}
                            </a>
                        </h2>

                        <!-- Info Metadata -->
                        <div class="mt-1.5 sm:mt-2 space-y-1 text-xs text-slate-700">
                            <div class="flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-slate-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="truncate">{{ $item->opening_hours }}</span>
                            </div>
                        </div>

                        <!-- Truncated Description -->
                        <p class="mt-2.5 sm:mt-3 text-xs sm:text-sm text-slate-700 line-clamp-2 leading-relaxed">
                            {{ $item->description }}
                        </p>

                        <!-- Price Tag -->
                        <div class="mt-3 sm:mt-4 pt-3 border-t border-slate-100 flex items-center justify-between">
                            <span class="text-xs text-slate-600 font-medium">Tiket Masuk</span>
                            <span class="text-sm sm:text-base font-bold text-emerald-700">
                                {{ $item->ticket_price_display }}
                            </span>
                        </div>

                        <!-- Card Action Buttons (BREAD) -->
                        <div class="mt-3 sm:mt-4 pt-3 border-t border-slate-100 grid grid-cols-3 gap-1.5 sm:gap-2">
                            <a href="{{ route('destinations.show', $item) }}" 
                               class="px-2 py-1.5 rounded-lg border border-slate-200 text-center text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:text-slate-900 transition-colors truncate">
                                Detail
                            </a>
                            <a href="{{ route('destinations.edit', $item) }}" 
                               class="px-2 py-1.5 rounded-lg border border-amber-200 bg-amber-50 text-center text-xs font-semibold text-amber-700 hover:bg-amber-100 transition-colors truncate">
                                Edit
                            </a>
                            <form action="{{ route('destinations.destroy', $item) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus data destinasi &quot;{{ $item->name }}&quot;? File gambar terkait juga akan dihapus permanen.');" 
                                  class="w-full">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="w-full px-2 py-1.5 rounded-lg border border-rose-200 bg-rose-50 text-center text-xs font-semibold text-rose-700 hover:bg-rose-100 transition-colors truncate">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="pt-4">
            {{ $destinations->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-2xl border border-dashed border-slate-300 p-8 sm:p-12 text-center">
            <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-slate-100 text-slate-600 mx-auto flex items-center justify-center mb-4">
                <svg class="w-7 h-7 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>
            <h3 class="text-base sm:text-lg font-bold text-slate-800">Tidak ada destinasi wisata yang ditemukan</h3>
            <p class="text-xs sm:text-sm text-slate-600 mt-1 max-w-md mx-auto">
                Coba sesuaikan kata kunci pencarian atau filter kategori, atau tambahkan data destinasi baru.
            </p>
            <div class="mt-5 sm:mt-6 flex flex-wrap items-center justify-center gap-2.5 sm:gap-3">
                <a href="{{ route('destinations.index') }}" class="px-3.5 py-2 text-xs sm:text-sm font-semibold rounded-lg border border-slate-300 text-slate-700 hover:bg-slate-50">
                    Reset Filter
                </a>
                <a href="{{ route('destinations.create') }}" class="px-3.5 py-2 text-xs sm:text-sm font-semibold rounded-lg bg-emerald-700 text-white hover:bg-emerald-800">
                    + Tambah Destinasi
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
