@extends('layouts.app')

@section('title', 'Tambah Kuliner Khas Kaltim - Pesona Kaltim')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <nav class="flex items-center text-xs sm:text-sm text-slate-700 gap-2">
        <a href="{{ route('culinaries.index') }}" class="hover:text-emerald-700 transition-colors">Kuliner Khas</a>
        <span>/</span>
        <span class="text-slate-900 font-semibold">Tambah Baru</span>
    </nav>

    <div class="bg-white rounded-xl border border-slate-200 shadow-xs overflow-hidden">
        <div class="p-6 sm:p-8 border-b border-slate-100 bg-slate-50/50">
            <h1 class="text-xl sm:text-2xl font-bold text-slate-900">Tambah Kuliner Khas Kalimantan Timur</h1>
            <p class="text-xs sm:text-sm text-slate-700 mt-1">Dokumentasikan makanan atau minuman tradisional khas daerah Kaltim.</p>
        </div>

        <form action="{{ route('culinaries.store') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8 space-y-6">
            @csrf

            <!-- Nama Kuliner -->
            <div>
                <label for="name" class="block text-sm font-semibold text-slate-800 mb-1.5">
                    Nama Kuliner <span class="text-rose-500">*</span>
                </label>
                <input type="text" 
                       name="name" 
                       id="name" 
                       value="{{ old('name') }}" 
                       placeholder="Contoh: Nasi Bekepor, Amplang Kuku Macan" 
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
                        <option value="">-- Pilih Kota/Kabupaten --</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city }}" {{ old('origin_city') == $city ? 'selected' : '' }}>
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
                           value="{{ old('price_range') }}" 
                           placeholder="Contoh: Rp 25.000 - Rp 50.000" 
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
                       value="{{ old('recommended_spot') }}" 
                       placeholder="Contoh: Depot Torani Samarinda, Pusat Oleh-Oleh Citra Niaga" 
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
                          placeholder="Jelaskan sejarah masakan, bumbu rempah khas, serta kelezatannya..." 
                          class="w-full px-3.5 py-2.5 bg-slate-50 border @error('description') border-rose-400 bg-rose-50/30 @else border-slate-300 @enderror rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors"
                          required>{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Upload Foto -->
            <div>
                <label class="block text-sm font-semibold text-slate-800 mb-1.5">
                    Foto Kuliner (Penyimpanan Storage Lokal)
                </label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-dashed @error('image') border-rose-400 bg-rose-50/20 @else border-slate-300 bg-slate-50 @enderror rounded-xl hover:bg-slate-100/60 transition-colors relative">
                    <div class="space-y-2 text-center">
                        <svg class="mx-auto h-10 w-10 text-slate-600" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-slate-600 justify-center">
                            <label for="image" class="relative cursor-pointer rounded-md font-semibold text-emerald-700 hover:text-emerald-800">
                                <span>Pilih file gambar</span>
                                <input id="image" 
                                       name="image" 
                                       type="file" 
                                       accept="image/png, image/jpeg, image/jpg, image/webp" 
                                       class="sr-only" 
                                       onchange="previewImage(event)">
                            </label>
                            <p class="pl-1">atau seret ke sini</p>
                        </div>
                        <p class="text-xs text-slate-600">Format PNG, JPG, JPEG, atau WEBP (Maksimal 2MB)</p>
                    </div>
                </div>

                <div id="imagePreviewContainer" class="hidden mt-4">
                    <p class="text-xs font-semibold text-slate-700 mb-2">Pratinjau Foto yang Dipilih:</p>
                    <div class="relative w-48 h-32 rounded-lg border border-slate-300 overflow-hidden bg-slate-100 shadow-xs">
                        <img id="imagePreview" src="" alt="Pratinjau" class="w-full h-full object-cover">
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
                    Simpan Kuliner
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function previewImage(event) {
        const input = event.target;
        const previewContainer = document.getElementById('imagePreviewContainer');
        const preview = document.getElementById('imagePreview');

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

