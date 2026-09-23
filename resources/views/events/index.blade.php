@extends('layouts.app')

@section('title', 'Event & Festival Pariwisata - Pesona Kaltim')

@section('content')
<div class="space-y-6 sm:space-y-8">
    <!-- Header Page -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 sm:gap-4 border-b border-slate-200 pb-4 sm:pb-5">
        <div>
            <h1 class="text-xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Kalender Event &amp; Budaya Kalimantan Timur</h1>
            <p class="text-xs sm:text-sm text-slate-700 mt-1">Jadwal festival adat tahunan, perayaan budaya etnik, dan karnaval seni di Kalimantan Timur.</p>
        </div>
        <a href="{{ route('events.create') }}" 
           class="inline-flex items-center justify-center gap-1.5 px-3.5 py-2 sm:px-4 sm:py-2.5 rounded-lg text-xs sm:text-sm font-semibold text-white bg-emerald-700 hover:bg-emerald-800 shadow-xs transition-colors self-start sm:self-auto shrink-0 whitespace-nowrap">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 4v16m8-8H4" />
            </svg>
            <span>Tambah Event</span>
        </a>
    </div>

    <!-- Search Bar -->
    <div class="bg-white p-4 sm:p-6 rounded-xl border border-slate-200 shadow-xs">
        <form method="GET" action="{{ route('events.index') }}" class="flex items-center gap-2 sm:gap-3">
            <div class="relative flex-1">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}" 
                       placeholder="Cari nama event, lokasi, penyelenggara..." 
                       class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm text-slate-800 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
            </div>

            <button type="submit" 
                    class="py-2.5 px-4 sm:px-5 rounded-lg bg-emerald-700 hover:bg-emerald-800 text-white text-xs sm:text-sm font-semibold transition-colors shrink-0 shadow-xs">
                Cari
            </button>
            @if(request('search'))
                <a href="{{ route('events.index') }}" 
                   title="Reset"
                   class="p-2.5 rounded-lg border border-slate-300 text-slate-700 hover:bg-slate-100 transition-colors shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
            @endif
        </form>
    </div>

    <!-- List of Events -->
    @if ($events->count() > 0)
        <div class="space-y-4">
            @foreach ($events as $event)
                <div class="bg-white rounded-xl border border-slate-200 p-4 sm:p-6 shadow-xs hover:shadow-md transition-shadow flex flex-col md:flex-row items-start md:items-center justify-between gap-4 sm:gap-6">
                    <div class="space-y-2 flex-1 w-full">
                        <div class="flex flex-wrap items-center gap-1.5 sm:gap-2">
                            <span class="px-2 py-0.5 sm:px-2.5 sm:py-1 rounded-md text-[11px] sm:text-xs font-semibold bg-emerald-50 text-emerald-800 border border-emerald-200">
                                {{ $event->location }}
                            </span>
                            <span class="text-[11px] sm:text-xs text-slate-700 font-medium">Penyelenggara: {{ $event->organizer }}</span>
                        </div>

                        <h2 class="text-base sm:text-xl font-bold text-slate-900 hover:text-emerald-700 transition-colors">
                            <a href="{{ route('events.show', $event) }}">{{ $event->event_name }}</a>
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-700 leading-relaxed line-clamp-2">{{ $event->description }}</p>

                        <!-- Action Buttons -->
                        <div class="flex flex-wrap items-center gap-2.5 sm:gap-3 pt-2">
                            <a href="{{ route('events.show', $event) }}" class="text-xs font-semibold text-emerald-700 hover:text-emerald-800">
                                Detail Lengkap &rarr;
                            </a>
                            <span class="text-slate-300">&bull;</span>
                            <a href="{{ route('events.edit', $event) }}" class="text-xs font-semibold text-amber-700 hover:text-amber-800">
                                Edit
                            </a>
                            <span class="text-slate-300">&bull;</span>
                            <form action="{{ route('events.destroy', $event) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus event &quot;{{ $event->event_name }}&quot;?');" 
                                  class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs font-semibold text-rose-600 hover:text-rose-800">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Date Badge -->
                    <div class="shrink-0 bg-slate-50 border border-slate-200 rounded-xl p-3 sm:p-4 text-center w-full md:w-auto min-w-[150px] flex flex-row md:flex-col items-center md:items-center justify-between md:justify-center">
                        <span class="text-[11px] sm:text-xs uppercase tracking-wider font-bold text-emerald-800 block">Jadwal</span>
                        <div class="text-right md:text-center">
                            <span class="text-xs sm:text-sm font-bold text-slate-900 block">
                                {{ $event->start_date->format('d M Y') }}
                            </span>
                            <span class="text-[11px] sm:text-xs text-slate-700 block md:inline">s.d.</span>
                            <span class="text-xs sm:text-sm font-bold text-slate-900 block md:inline">
                                {{ $event->end_date->format('d M Y') }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pt-4">
            {{ $events->links() }}
        </div>
    @else
        <div class="bg-white rounded-2xl border border-dashed border-slate-300 p-8 sm:p-12 text-center">
            <h3 class="text-base sm:text-lg font-bold text-slate-800">Tidak ada event pariwisata yang ditemukan</h3>
            <p class="text-xs sm:text-sm text-slate-600 mt-1">Coba sesuaikan kata kunci pencarian atau daftarkan event baru.</p>
            <div class="mt-5 sm:mt-6 flex flex-wrap items-center justify-center gap-2.5 sm:gap-3">
                <a href="{{ route('events.index') }}" class="px-3.5 py-2 text-xs sm:text-sm font-semibold rounded-lg border border-slate-300 text-slate-700 hover:bg-slate-50">
                    Reset Filter
                </a>
                <a href="{{ route('events.create') }}" class="px-3.5 py-2 text-xs sm:text-sm font-semibold rounded-lg bg-emerald-700 text-white hover:bg-emerald-800">
                    + Tambah Event
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
