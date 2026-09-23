@extends('layouts.app')

@section('title', 'Kuliner Khas Kalimantan Timur - Pesona Kaltim')

@section('content')
<div class="space-y-6 sm:space-y-8">
    <!-- Header Page -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 sm:gap-4 border-b border-slate-200 pb-4 sm:pb-5">
        <div>
            <h1 class="text-xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Kuliner Khas Kalimantan Timur</h1>
            <p class="text-xs sm:text-sm text-slate-700 mt-1">Cicipi kekayaan cita rasa otentik warisan kerajaan Kutai dan pesisir Borneo.</p>
        </div>
        <a href="{{ route('culinaries.create') }}" 
           class="inline-flex items-center justify-center gap-1.5 px-3.5 py-2 sm:px-4 sm:py-2.5 rounded-lg text-xs sm:text-sm font-semibold text-white bg-emerald-700 hover:bg-emerald-800 shadow-xs transition-colors self-start sm:self-auto shrink-0 whitespace-nowrap">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 4v16m8-8H4" />
            </svg>
            <span>Tambah Kuliner</span>
        </a>
    </div>

    <!-- Filter & Search Bar -->
    <div class="bg-white p-4 sm:p-6 rounded-xl border border-slate-200 shadow-xs">
        <form method="GET" action="{{ route('culinaries.index') }}" class="grid grid-cols-1 sm:grid-cols-12 gap-3 sm:gap-4 items-center">
            <!-- Search Input -->
            <div class="sm:col-span-6 relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}" 
                       placeholder="Cari nama kuliner, spot rekomendasi..." 
                       class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm text-slate-800 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
            </div>

            <!-- Filter Kota Asal -->
            <div class="sm:col-span-4">
                <select name="city" 
                        class="w-full py-2.5 px-3 bg-slate-50 border border-slate-300 rounded-lg text-sm text-slate-800 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
                    <option value="">Semua Kota/Kabupaten</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>
                            {{ $city }}
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
                @if(request('search') || request('city'))
                    <a href="{{ route('culinaries.index') }}" 
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

    <!-- Grid Kuliner -->
    @if ($culinaries->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6">
            @foreach ($culinaries as $culinary)
                <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-xs hover:shadow-md transition-shadow flex flex-col group">
                    <!-- Thumbnail Image / Placeholder -->
                    <div class="relative aspect-[16/10] bg-slate-900 overflow-hidden">
                        @if ($culinary->image_url)
                            <img src="{{ $culinary->image_url }}" 
                                 alt="{{ $culinary->name }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent"></div>
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-slate-800 to-slate-900 flex flex-col items-center justify-center text-slate-400 p-4">
                                <div class="w-11 h-11 rounded-xl bg-slate-700/60 flex items-center justify-center text-slate-300 mb-1.5 shadow-inner">
                                    <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <span class="text-xs font-semibold text-slate-300">Belum Ada Foto</span>
                                <span class="text-[10px] text-slate-400">Siap diunggah</span>
                            </div>
                        @endif

                        <div class="absolute top-2.5 left-2.5 sm:top-3 sm:left-3">
                            <span class="px-2 py-0.5 sm:px-2.5 sm:py-1 rounded-md text-[11px] sm:text-xs font-semibold bg-emerald-700/90 backdrop-blur-xs text-white shadow-xs">
                                {{ $culinary->origin_city }}
                            </span>
                        </div>
                    </div>

                    <!-- Body -->
                    <div class="p-4 sm:p-5 flex-1 flex flex-col">
                        <div class="flex items-center justify-between gap-2 mb-2">
                            <h2 class="text-base sm:text-lg font-bold text-slate-900 group-hover:text-emerald-700 transition-colors line-clamp-1">
                                <a href="{{ route('culinaries.show', $culinary) }}">{{ $culinary->name }}</a>
                            </h2>
                            <span class="text-xs font-bold text-emerald-700 shrink-0">
                                {{ $culinary->price_range }}
                            </span>
                        </div>

                        <p class="text-xs sm:text-sm text-slate-700 line-clamp-2 leading-relaxed flex-1">
                            {{ $culinary->description }}
                        </p>

                        <div class="mt-3 sm:mt-4 pt-3 border-t border-slate-100 text-xs text-slate-700">
                            <span class="font-semibold text-slate-800">Spot Rekomendasi:</span>
                            <p class="text-emerald-800 font-medium truncate mt-0.5">{{ $culinary->recommended_spot }}</p>
                        </div>

                        <!-- Card Action Buttons -->
                        <div class="mt-3 sm:mt-4 pt-3 border-t border-slate-100 grid grid-cols-3 gap-1.5 sm:gap-2">
                            <a href="{{ route('culinaries.show', $culinary) }}" 
                               class="px-2 py-1.5 rounded-lg border border-slate-200 text-center text-xs font-semibold text-slate-700 hover:bg-slate-50 transition-colors truncate">
                                Detail
                            </a>
                            <a href="{{ route('culinaries.edit', $culinary) }}" 
                               class="px-2 py-1.5 rounded-lg border border-amber-200 bg-amber-50 text-center text-xs font-semibold text-amber-700 hover:bg-amber-100 transition-colors truncate">
                                Edit
                            </a>
                            <form action="{{ route('culinaries.destroy', $culinary) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus kuliner &quot;{{ $culinary->name }}&quot;?');" 
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

        <div class="pt-4">
            {{ $culinaries->links() }}
        </div>
    @else
        <div class="bg-white rounded-2xl border border-dashed border-slate-300 p-8 sm:p-12 text-center">
            <h3 class="text-base sm:text-lg font-bold text-slate-800">Tidak ada kuliner yang ditemukan</h3>
            <p class="text-xs sm:text-sm text-slate-600 mt-1">Coba sesuaikan kata kunci pencarian atau tambahkan kuliner baru.</p>
            <div class="mt-5 sm:mt-6 flex flex-wrap items-center justify-center gap-2.5 sm:gap-3">
                <a href="{{ route('culinaries.index') }}" class="px-3.5 py-2 text-xs sm:text-sm font-semibold rounded-lg border border-slate-300 text-slate-700 hover:bg-slate-50">
                    Reset Filter
                </a>
                <a href="{{ route('culinaries.create') }}" class="px-3.5 py-2 text-xs sm:text-sm font-semibold rounded-lg bg-emerald-700 text-white hover:bg-emerald-800">
                    + Tambah Kuliner
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
