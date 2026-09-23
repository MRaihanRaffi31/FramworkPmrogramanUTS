@extends('layouts.app')

@section('title', 'Tambah Event Pariwisata Kaltim - Pesona Kaltim')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <nav class="flex items-center text-xs sm:text-sm text-slate-700 gap-2">
        <a href="{{ route('events.index') }}" class="hover:text-emerald-700 transition-colors">Event &amp; Budaya</a>
        <span>/</span>
        <span class="text-slate-900 font-semibold">Tambah Event</span>
    </nav>

    <div class="bg-white rounded-xl border border-slate-200 shadow-xs overflow-hidden">
        <div class="p-6 sm:p-8 border-b border-slate-100 bg-slate-50/50">
            <h1 class="text-xl sm:text-2xl font-bold text-slate-900">Tambah Event &amp; Festival Budaya Baru</h1>
            <p class="text-xs sm:text-sm text-slate-700 mt-1">Daftarkan agenda perayaan adat, pagelaran seni, atau festival tahunan di Kaltim.</p>
        </div>

        <form action="{{ route('events.store') }}" method="POST" class="p-6 sm:p-8 space-y-6">
            @csrf

            <!-- Nama Event -->
            <div>
                <label for="event_name" class="block text-sm font-semibold text-slate-800 mb-1.5">
                    Nama Event / Festival <span class="text-rose-500">*</span>
                </label>
                <input type="text" 
                       name="event_name" 
                       id="event_name" 
                       value="{{ old('event_name') }}" 
                       placeholder="Contoh: Festival Adat Erau Pelas Benua" 
                       class="w-full px-3.5 py-2.5 bg-slate-50 border @error('event_name') border-rose-400 bg-rose-50/30 @else border-slate-300 @enderror rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors"
                       required>
                @error('event_name')
                    <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Grid: Lokasi & Penyelenggara -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="location" class="block text-sm font-semibold text-slate-800 mb-1.5">
                        Lokasi Penyelenggaraan <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" 
                           name="location" 
                           id="location" 
                           value="{{ old('location') }}" 
                           placeholder="Contoh: Stadion Rondong Demang, Tenggarong" 
                           class="w-full px-3.5 py-2.5 bg-slate-50 border @error('location') border-rose-400 bg-rose-50/30 @else border-slate-300 @enderror rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors"
                           required>
                    @error('location')
                        <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="organizer" class="block text-sm font-semibold text-slate-800 mb-1.5">
                        Pihak Penyelenggara <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" 
                           name="organizer" 
                           id="organizer" 
                           value="{{ old('organizer') }}" 
                           placeholder="Contoh: Dinas Pariwisata Kukar" 
                           class="w-full px-3.5 py-2.5 bg-slate-50 border @error('organizer') border-rose-400 bg-rose-50/30 @else border-slate-300 @enderror rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors"
                           required>
                    @error('organizer')
                        <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Grid: Tanggal Mulai & Selesai -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="start_date" class="block text-sm font-semibold text-slate-800 mb-1.5">
                        Tanggal Mulai <span class="text-rose-500">*</span>
                    </label>
                    <input type="date" 
                           name="start_date" 
                           id="start_date" 
                           value="{{ old('start_date') }}" 
                           class="w-full px-3.5 py-2.5 bg-slate-50 border @error('start_date') border-rose-400 bg-rose-50/30 @else border-slate-300 @enderror rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors"
                           required>
                    @error('start_date')
                        <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="end_date" class="block text-sm font-semibold text-slate-800 mb-1.5">
                        Tanggal Selesai <span class="text-rose-500">*</span>
                    </label>
                    <input type="date" 
                           name="end_date" 
                           id="end_date" 
                           value="{{ old('end_date') }}" 
                           class="w-full px-3.5 py-2.5 bg-slate-50 border @error('end_date') border-rose-400 bg-rose-50/30 @else border-slate-300 @enderror rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors"
                           required>
                    @error('end_date')
                        <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Deskripsi -->
            <div>
                <label for="description" class="block text-sm font-semibold text-slate-800 mb-1.5">
                    Deskripsi &amp; Rangkaian Acara <span class="text-rose-500">*</span>
                </label>
                <textarea name="description" 
                          id="description" 
                          rows="4" 
                          placeholder="Jelaskan makna adat, prosesi sakral, agenda konser musik, parade perahu, atau pameran..." 
                          class="w-full px-3.5 py-2.5 bg-slate-50 border @error('description') border-rose-400 bg-rose-50/30 @else border-slate-300 @enderror rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors"
                          required>{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol Aksi -->
            <div class="pt-6 border-t border-slate-200 flex items-center justify-end gap-3">
                <a href="{{ route('events.index') }}" 
                   class="px-5 py-2.5 rounded-lg border border-slate-300 text-sm font-semibold text-slate-700 hover:bg-slate-100 transition-colors">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2.5 rounded-lg bg-emerald-700 hover:bg-emerald-800 text-sm font-semibold text-white shadow-xs transition-colors">
                    Simpan Event
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

