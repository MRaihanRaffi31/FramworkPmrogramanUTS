@extends('layouts.app')

@section('title', $event->event_name . ' - Event & Budaya Kaltim')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center justify-between text-xs sm:text-sm text-slate-700">
        <nav class="flex items-center gap-2">
            <a href="{{ route('events.index') }}" class="hover:text-emerald-700 transition-colors">Event &amp; Budaya</a>
            <span>/</span>
            <span class="text-slate-900 font-semibold truncate max-w-xs">{{ $event->event_name }}</span>
        </nav>
        <a href="{{ route('events.index') }}" class="inline-flex items-center gap-1 font-semibold text-slate-700 hover:text-emerald-700">
            &larr; <span>Kembali ke Kalender</span>
        </a>
    </div>

    <article class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-xs p-6 sm:p-8 space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-6 border-b border-slate-100">
            <div>
                <span class="px-2.5 py-1 rounded-md text-xs font-semibold bg-emerald-50 text-emerald-800 border border-emerald-200 mb-2 inline-block">
                    {{ $event->location }}
                </span>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                    {{ $event->event_name }}
                </h1>
                <p class="text-xs text-slate-700 mt-1">Penyelenggara: <span class="font-semibold text-slate-900">{{ $event->organizer }}</span></p>
            </div>
            <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4 text-center shrink-0">
                <span class="text-xs uppercase tracking-wider font-bold text-emerald-800 block">Jadwal Agenda</span>
                <span class="text-sm font-bold text-slate-900 mt-1 block">{{ $event->start_date->format('d M Y') }}</span>
                <span class="text-xs text-slate-700 block">s.d.</span>
                <span class="text-sm font-bold text-slate-900 block">{{ $event->end_date->format('d M Y') }}</span>
            </div>
        </div>

        <div class="space-y-3">
            <h2 class="text-base font-bold text-slate-900 tracking-tight flex items-center gap-2">
                <span class="w-1.5 h-4 rounded-full bg-emerald-600"></span>
                Tentang &amp; Rangkaian Acara
            </h2>
            <div class="prose prose-slate max-w-none text-slate-700 leading-relaxed text-sm sm:text-base whitespace-pre-line">
                {{ $event->description }}
            </div>
        </div>

        <div class="pt-6 border-t border-slate-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <a href="{{ route('events.index') }}" 
               class="w-full sm:w-auto text-center px-4 py-2 rounded-lg border border-slate-300 text-xs sm:text-sm font-semibold text-slate-700 hover:bg-slate-100 transition-colors">
                &larr; Kembali
            </a>

            <div class="flex items-center gap-2.5 w-full sm:w-auto">
                <a href="{{ route('events.edit', $event) }}" 
                   class="flex-1 sm:flex-none justify-center px-4 py-2 rounded-lg bg-amber-600 hover:bg-amber-700 text-white text-xs sm:text-sm font-semibold shadow-xs transition-colors flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    <span>Edit Event</span>
                </a>

                <form action="{{ route('events.destroy', $event) }}" 
                      method="POST" 
                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus event ini?');"
                      class="flex-1 sm:flex-none">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="w-full justify-center px-4 py-2 rounded-lg bg-rose-600 hover:bg-rose-700 text-white text-xs sm:text-sm font-semibold shadow-xs transition-colors flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        <span>Hapus Event</span>
                    </button>
                </form>
            </div>
        </div>
    </article>
</div>
@endsection

