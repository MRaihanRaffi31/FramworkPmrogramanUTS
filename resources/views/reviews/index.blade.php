@extends('layouts.app')

@section('title', 'Ulasan Pengunjung - Pesona Kaltim')

@section('content')
<div class="space-y-6 sm:space-y-8">
    <!-- Header Page -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 sm:gap-4 border-b border-slate-200 pb-4 sm:pb-5">
        <div>
            <h1 class="text-xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Ulasan &amp; Pengalaman Wisatawan</h1>
            <p class="text-xs sm:text-sm text-slate-700 mt-1">Cerita dan pengalaman otentik pengunjung saat menjelajahi keelokan alam Borneo.</p>
        </div>
        <a href="{{ route('reviews.create') }}" 
           class="inline-flex items-center justify-center gap-1.5 px-3.5 py-2 sm:px-4 sm:py-2.5 rounded-lg text-xs sm:text-sm font-semibold text-white bg-emerald-700 hover:bg-emerald-800 shadow-xs transition-colors self-start sm:self-auto shrink-0 whitespace-nowrap">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
            <span>Tulis Ulasan</span>
        </a>
    </div>

    <!-- Filter & Search Bar -->
    <div class="bg-white p-4 sm:p-6 rounded-xl border border-slate-200 shadow-xs">
        <form method="GET" action="{{ route('reviews.index') }}" class="grid grid-cols-1 sm:grid-cols-12 gap-3 sm:gap-4 items-center">
            <div class="sm:col-span-7 relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}" 
                       placeholder="Cari nama pengunjung, destinasi..." 
                       class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm text-slate-800 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
            </div>

            <div class="sm:col-span-3">
                <select name="rating" 
                        class="w-full py-2.5 px-3 bg-slate-50 border border-slate-300 rounded-lg text-sm text-slate-800 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
                    <option value="">Semua Bintang</option>
                    @for ($r = 5; $r >= 1; $r--)
                        <option value="{{ $r }}" {{ request('rating') == $r ? 'selected' : '' }}>
                            ⭐ {{ $r }} Bintang
                        </option>
                    @endfor
                </select>
            </div>

            <div class="sm:col-span-2 flex items-center gap-2">
                <button type="submit" 
                        class="w-full py-2.5 px-4 rounded-lg bg-emerald-700 hover:bg-emerald-800 text-white text-sm font-semibold transition-colors flex items-center justify-center gap-1.5 shadow-xs">
                    <span>Filter</span>
                </button>
                @if(request('search') || request('rating'))
                    <a href="{{ route('reviews.index') }}" 
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

    <!-- Grid Ulasan -->
    @if ($reviews->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-6">
            @foreach ($reviews as $rev)
                <div class="bg-white rounded-xl border border-slate-200 p-4 sm:p-6 shadow-xs hover:shadow-md transition-shadow flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1 sm:gap-2">
                            <div class="flex items-center gap-1 text-amber-500">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-4 h-4 {{ $i <= $rev->rating ? 'fill-current' : 'text-slate-200' }}" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                            </div>
                            <span class="text-[11px] sm:text-xs text-slate-700">Kunjungan: {{ $rev->visit_date->format('d M Y') }}</span>
                        </div>

                        <p class="text-xs sm:text-sm text-slate-700 italic leading-relaxed">
                            &ldquo;{{ $rev->review_text }}&rdquo;
                        </p>
                    </div>

                    <div class="mt-3 sm:mt-4 pt-3 sm:pt-4 border-t border-slate-100 flex items-center justify-between gap-2">
                        <div class="min-w-0 flex-1">
                            <p class="text-xs sm:text-sm font-bold text-slate-900 truncate">{{ $rev->visitor_name }}</p>
                            <p class="text-[11px] sm:text-xs text-emerald-800 font-medium truncate">Destinasi: {{ $rev->destination_visited }}</p>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center gap-1.5 sm:gap-2 shrink-0">
                            <a href="{{ route('reviews.edit', $rev) }}" 
                               class="px-2.5 py-1 text-xs font-semibold rounded-md border border-amber-200 bg-amber-50 text-amber-700 hover:bg-amber-100 transition-colors">
                                Edit
                            </a>
                            <form action="{{ route('reviews.destroy', $rev) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus ulasan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="px-2.5 py-1 text-xs font-semibold rounded-md border border-rose-200 bg-rose-50 text-rose-700 hover:bg-rose-100 transition-colors">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pt-4">
            {{ $reviews->links() }}
        </div>
    @else
        <div class="bg-white rounded-2xl border border-dashed border-slate-300 p-8 sm:p-12 text-center">
            <h3 class="text-base sm:text-lg font-bold text-slate-800">Belum ada ulasan yang sesuai filter</h3>
            <p class="text-xs sm:text-sm text-slate-600 mt-1">Jadilah yang pertama menuliskan ulasan tentang keindahan Kalimantan Timur.</p>
            <div class="mt-5 sm:mt-6 flex flex-wrap items-center justify-center gap-2.5 sm:gap-3">
                <a href="{{ route('reviews.index') }}" class="px-3.5 py-2 text-xs sm:text-sm font-semibold rounded-lg border border-slate-300 text-slate-700 hover:bg-slate-50">
                    Reset Filter
                </a>
                <a href="{{ route('reviews.create') }}" class="px-3.5 py-2 text-xs sm:text-sm font-semibold rounded-lg bg-emerald-700 text-white hover:bg-emerald-800">
                    + Tulis Ulasan
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
