@extends('layouts.app')

@section('title', 'Tulis Ulasan Pengunjung - Pesona Kaltim')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <nav class="flex items-center text-xs sm:text-sm text-slate-700 gap-2">
        <a href="{{ route('reviews.index') }}" class="hover:text-emerald-700 transition-colors">Ulasan Pengunjung</a>
        <span>/</span>
        <span class="text-slate-900 font-semibold">Tulis Ulasan</span>
    </nav>

    <div class="bg-white rounded-xl border border-slate-200 shadow-xs overflow-hidden">
        <div class="p-6 sm:p-8 border-b border-slate-100 bg-slate-50/50">
            <h1 class="text-xl sm:text-2xl font-bold text-slate-900">Bagikan Cerita Perjalanan Anda</h1>
            <p class="text-xs sm:text-sm text-slate-700 mt-1">Ulasan Anda sangat berharga untuk membantu wisatawan lain menjelajahi Kalimantan Timur.</p>
        </div>

        <form action="{{ route('reviews.store') }}" method="POST" class="p-6 sm:p-8 space-y-6">
            @csrf

            <!-- Nama Pengunjung -->
            <div>
                <label for="visitor_name" class="block text-sm font-semibold text-slate-800 mb-1.5">
                    Nama Lengkap Anda <span class="text-rose-500">*</span>
                </label>
                <input type="text" 
                       name="visitor_name" 
                       id="visitor_name" 
                       value="{{ old('visitor_name') }}" 
                       placeholder="Contoh: Raihan Fadhil" 
                       class="w-full px-3.5 py-2.5 bg-slate-50 border @error('visitor_name') border-rose-400 bg-rose-50/30 @else border-slate-300 @enderror rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors"
                       required>
                @error('visitor_name')
                    <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Destinasi yang Dikunjungi & Tanggal -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="destination_visited" class="block text-sm font-semibold text-slate-800 mb-1.5">
                        Destinasi yang Dikunjungi <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" 
                           name="destination_visited" 
                           id="destination_visited" 
                           list="destinationList"
                           value="{{ old('destination_visited') }}" 
                           placeholder="Pilih atau ketik destinasi..." 
                           class="w-full px-3.5 py-2.5 bg-slate-50 border @error('destination_visited') border-rose-400 bg-rose-50/30 @else border-slate-300 @enderror rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors"
                           required>
                    <datalist id="destinationList">
                        @foreach ($destinations as $dest)
                            <option value="{{ $dest }}">
                        @endforeach
                    </datalist>
                    @error('destination_visited')
                        <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="visit_date" class="block text-sm font-semibold text-slate-800 mb-1.5">
                        Tanggal Berkunjung <span class="text-rose-500">*</span>
                    </label>
                    <input type="date" 
                           name="visit_date" 
                           id="visit_date" 
                           max="{{ date('Y-m-d') }}"
                           value="{{ old('visit_date', date('Y-m-d')) }}" 
                           class="w-full px-3.5 py-2.5 bg-slate-50 border @error('visit_date') border-rose-400 bg-rose-50/30 @else border-slate-300 @enderror rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors"
                           required>
                    @error('visit_date')
                        <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Rating Bintang -->
            <div>
                <label class="block text-sm font-semibold text-slate-800 mb-2">
                    Penilaian / Rating <span class="text-rose-500">*</span>
                </label>
                <div class="flex flex-wrap items-center gap-3">
                    @for ($r = 5; $r >= 1; $r--)
                        <label class="cursor-pointer flex items-center gap-1.5 px-3 py-2 rounded-lg border border-slate-200 bg-slate-50 hover:bg-emerald-50 hover:border-emerald-300 transition-colors">
                            <input type="radio" 
                                   name="rating" 
                                   value="{{ $r }}" 
                                   class="text-emerald-600 focus:ring-emerald-500" 
                                   {{ old('rating', '5') == $r ? 'checked' : '' }}>
                            <span class="text-sm font-bold text-slate-800 flex items-center gap-1">
                                {{ $r }} <span class="text-amber-500">★</span>
                            </span>
                        </label>
                    @endfor
                </div>
                @error('rating')
                    <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Teks Ulasan -->
            <div>
                <label for="review_text" class="block text-sm font-semibold text-slate-800 mb-1.5">
                    Ulasan &amp; Kesan Pengalaman <span class="text-rose-500">*</span>
                </label>
                <textarea name="review_text" 
                          id="review_text" 
                          rows="4" 
                          placeholder="Ceritakan apa yang paling berkesan, tips untuk pengunjung lain, kondisi fasilitas, dll..." 
                          class="w-full px-3.5 py-2.5 bg-slate-50 border @error('review_text') border-rose-400 bg-rose-50/30 @else border-slate-300 @enderror rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors"
                          required>{{ old('review_text') }}</textarea>
                @error('review_text')
                    <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol Aksi -->
            <div class="pt-6 border-t border-slate-200 flex items-center justify-end gap-3">
                <a href="{{ route('reviews.index') }}" 
                   class="px-5 py-2.5 rounded-lg border border-slate-300 text-sm font-semibold text-slate-700 hover:bg-slate-100 transition-colors">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2.5 rounded-lg bg-emerald-700 hover:bg-emerald-800 text-sm font-semibold text-white shadow-xs transition-colors">
                    Terbitkan Ulasan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

