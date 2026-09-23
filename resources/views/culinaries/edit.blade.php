@extends('layouts.app')

@section('title', 'Edit Kuliner: ' . $culinary->name . ' - Pesona Kaltim')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <nav class="flex items-center text-xs sm:text-sm text-slate-700 gap-2">
        <a href="{{ route('culinaries.index') }}" class="hover:text-emerald-700 transition-colors">Kuliner Khas</a>
        <span>/</span>
        <span class="text-slate-900 font-semibold truncate max-w-xs">{{ $culinary->name }}</span>
        <span>/</span>
        <span class="text-slate-900 font-semibold">Edit Data</span>
    </nav>

    <div class="bg-white rounded-xl border border-slate-200 shadow-xs overflow-hidden">
        <div class="p-6 sm:p-8 border-b border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-xl sm:text-2xl font-bold text-slate-900">Perbarui Data Kuliner</h1>
                <p class="text-xs sm:text-sm text-slate-700 mt-1">Mengedit informasi untuk <span class="font-semibold text-emerald-800">{{ $culinary->name }}</span>.</p>
            </div>
            <a href="{{ route('culinaries.index') }}" class="inline-flex items-center text-xs font-semibold text-slate-700 hover:text-emerald-700">
                &larr; Kembali ke Daftar
            </a>
        </div>

        <form action="{{ route('culinaries.update', $culinary) }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8 space-y-6">
            @csrf
            @method('PUT')

            <!-- Nama Kuliner -->
            <div>
                <label for="name" class="block text-sm font-semibold text-slate-800 mb-1.5">
                    Nama Kuliner <span class="text-rose-500">*</span>
                </label>
                <input type="text" 
                       name="name" 
                       id="name" 
                       value="{{ old('name', $culinary->name) }}" 
                       class="w-full px-3.5 py-2.5 bg-slate-50 border @error('name') border-rose-400 bg-rose-50/30 @else border-slate-300 @enderror rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors"
                       required>
                @error('name')
                    <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Grid 2 Kolom: Kota Asal & Rentang Harga -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="origin_city" class="block text-sm font-semibold text-slate-800 mb-1.5">
                        Kota / Kabupaten Asal <span class="text-rose-500">*</span>
                    </label>
                    <select name="origin_city" 
                            id="origin_city" 
                            class="w-full px-3.5 py-2.5 bg-slate-50 border @error('origin_city') border-rose-400 bg-rose-50/30 @else border-slate-300 @enderror rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors"
                            required>
                        @foreach ($cities as $city)
                            <option value="{{ $city }}" {{ old('origin_city', $culinary->origin_city) == $city ? 'selected' : '' }}>
                                {{ $city }}
                            </option>
                        @endforeach
                    </select>
                    @error('origin_city')
                        <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="price_range" class="block text-sm font-semibold text-slate-800 mb-1.5">
                        Rentang Harga <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" 
                           name="price_range" 
                           id="price_range" 
                           value="{{ old('price_range', $culinary->price_range) }}" 
                           class="w-full px-3.5 py-2.5 bg-slate-50 border @error('price_range') border-rose-400 bg-rose-50/30 @else border-slate-300 @enderror rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors"
                           required>
                    @error('price_range')
                        <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Spot Rekomendasi -->
            <div>
                <label for="recommended_spot" class="block text-sm font-semibold text-slate-800 mb-1.5">
                    Spot / Rumah Makan Rekomendasi <span class="text-rose-500">*</span>
                </label>
                <input type="text" 
                       name="recommended_spot" 
                       id="recommended_spot" 
                       value="{{ old('recommended_spot', $culinary->recommended_spot) }}" 
                       class="w-full px-3.5 py-2.5 bg-slate-50 border @error('recommended_spot') border-rose-400 bg-rose-50/30 @else border-slate-300 @enderror rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors"
                       required>
                @error('recommended_spot')
                    <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div>
                <label for="description" class="block text-sm font-semibold text-slate-800 mb-1.5">
                    Deskripsi Cita Rasa &amp; Bahan <span class="text-rose-500">*</span>
                </label>
                <textarea name="description" 
                          id="description" 
                          rows="4" 
                          class="w-full px-3.5 py-2.5 bg-slate-50 border @error('description') border-rose-400 bg-rose-50/30 @else border-slate-300 @enderror rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors"
                          required>{{ old('description', $culinary->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Bagian Foto Saat Ini & Ganti Foto -->
            <div class="space-y-4 pt-2">
                <label class="block text-sm font-semibold text-slate-800">
                    Foto Kuliner
                </label>

                <!-- Status Foto Saat Ini -->
                <div class="p-4 rounded-xl border border-slate-200 bg-slate-50/70 flex flex-col sm:flex-row items-start sm:items-center gap-4">
                    @if ($culinary->image_url)
                        <div class="w-32 h-20 rounded-lg overflow-hidden border border-slate-300 bg-slate-200 shrink-0">
                            <img src="{{ $culinary->image_url }}" alt="{{ $culinary->name }}" class="w-full h-full object-cover">
                        </div>
                        <div class="space-y-1 text-xs text-slate-700">
                            <p class="font-semibold text-slate-800">Foto Saat Ini (Tersimpan di Storage Lokal):</p>
                            <p class="text-slate-600 font-mono text-[11px] truncate max-w-sm">{{ $culinary->image }}</p>
                            <p class="text-emerald-700">Mengunggah file baru di bawah akan otomatis mengganti dan menghapus file lama ini.</p>
                        </div>
                    @else
                        <div class="w-20 h-16 rounded-lg bg-slate-200 text-slate-500 flex items-center justify-center shrink-0">
                            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <div class="space-y-0.5 text-xs text-slate-600">
                            <p class="font-semibold text-slate-800">Belum ada foto yang diunggah</p>
                            <p class="text-[11px]">Silakan pilih file foto di bawah untuk menambahkan foto kuliner ini.</p>
                        </div>
                    @endif
                </div>

                <!-- Input File Baru -->
                <div class="flex justify-center px-6 pt-5 pb-6 border-2 border-dashed @error('image') border-rose-400 bg-rose-50/20 @else border-slate-300 bg-slate-50 @enderror rounded-xl hover:bg-slate-100/60 transition-colors relative">
                    <div class="space-y-2 text-center">
                        <svg class="mx-auto h-10 w-10 text-slate-600" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-slate-600 justify-center">
                            <label for="image" class="relative cursor-pointer rounded-md font-semibold text-emerald-700 hover:text-emerald-800">
                                <span>Pilih file foto baru</span>
                                <input id="image" 
                                       name="image" 
                                       type="file" 
                                       accept="image/png, image/jpeg, image/jpg, image/webp" 
                                       class="sr-only" 
                                       onchange="previewNewImage(event)">
                            </label>
                            <p class="pl-1">atau seret ke sini</p>
                        </div>
                        <p class="text-xs text-slate-600">Biarkan kosong jika tidak ingin mengubah foto (Maks 2MB)</p>
                    </div>
                </div>

                <div id="newImagePreviewContainer" class="hidden mt-4">
                    <p class="text-xs font-semibold text-emerald-700 mb-2">Pratinjau Foto Baru Pengganti:</p>
                    <div class="relative w-48 h-32 rounded-lg border-2 border-emerald-500 overflow-hidden bg-slate-100 shadow-xs">
                        <img id="newImagePreview" src="" alt="Pratinjau Baru" class="w-full h-full object-cover">
                    </div>
                </div>

                @error('image')
                    <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol Aksi -->
            <div class="pt-6 border-t border-slate-200 flex items-center justify-end gap-3">
                <a href="{{ route('culinaries.index') }}" 
                   class="px-5 py-2.5 rounded-lg border border-slate-300 text-sm font-semibold text-slate-700 hover:bg-slate-100 transition-colors">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2.5 rounded-lg bg-emerald-700 hover:bg-emerald-800 text-sm font-semibold text-white shadow-xs transition-colors">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function previewNewImage(event) {
        const input = event.target;
        const previewContainer = document.getElementById('newImagePreviewContainer');
        const preview = document.getElementById('newImagePreview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                previewContainer.classList.remove('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = '';
            previewContainer.classList.add('hidden');
        }
    }
</script>
@endpush
@endsection

