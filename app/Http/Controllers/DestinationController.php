<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class DestinationController extends Controller
{
    /**
     * Menampilkan daftar destinasi wisata (Browse).
     */
    public function index(Request $request): View
    {
        $query = Destination::query();

        // Fitur pencarian nama / kota
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('location_city', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        // Fitur filter kategori
        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        // Fitur filter kota/kabupaten
        if ($request->filled('city')) {
            $query->where('location_city', $request->input('city'));
        }

        $destinations = $query->latest()->paginate(12)->withQueryString();
        $categories = Destination::CATEGORIES;
        $cities = Destination::CITIES;

        return view('destinations.index', compact('destinations', 'categories', 'cities'));
    }

    /**
     * Menampilkan formulir penambahan destinasi baru (Add).
     */
    public function create(): View
    {
        $categories = Destination::CATEGORIES;
        $cities = Destination::CITIES;
        return view('destinations.create', compact('categories', 'cities'));
    }

    /**
     * Menyimpan data destinasi baru ke database (Store/Add).
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'location_city' => 'required|string|max:100',
            'ticket_price' => 'required|integer|min:0',
            'opening_hours' => 'required|string|max:100',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'name.required' => 'Nama destinasi wajib diisi.',
            'category.required' => 'Kategori wajib dipilih atau diisi.',
            'location_city.required' => 'Kota/Kabupaten lokasi wajib diisi.',
            'ticket_price.required' => 'Harga tiket masuk wajib diisi.',
            'ticket_price.min' => 'Harga tiket tidak boleh negatif (isi 0 jika gratis).',
            'opening_hours.required' => 'Jam operasional wajib diisi.',
            'description.required' => 'Deskripsi destinasi wajib diisi.',
            'image.image' => 'File yang diunggah harus berupa gambar.',
            'image.mimes' => 'Format gambar yang diperbolehkan: jpeg, png, jpg, webp.',
            'image.max' => 'Ukuran gambar maksimal adalah 2MB.',
        ]);

        // Generate slug unik
        $baseSlug = Str::slug($validated['name']);
        $slug = $baseSlug;
        $counter = 1;
        while (Destination::where('slug', $slug)->exists()) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }
        $validated['slug'] = $slug;

        // Manajemen upload gambar lokal ke storage/app/public/destinations
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('destinations', 'public');
        }

        Destination::create($validated);

        return redirect()->route('destinations.index')
            ->with('success', 'Destinasi wisata baru berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail lengkap destinasi (Read).
     */
    public function show(Destination $destination): View
    {
        return view('destinations.show', compact('destination'));
    }

    /**
     * Menampilkan formulir edit destinasi (Edit).
     */
    public function edit(Destination $destination): View
    {
        $categories = Destination::CATEGORIES;
        $cities = Destination::CITIES;
        return view('destinations.edit', compact('destination', 'categories', 'cities'));
    }

    /**
     * Memperbarui data destinasi dan mengganti file gambar (Update/Edit).
     */
    public function update(Request $request, Destination $destination): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'location_city' => 'required|string|max:100',
            'ticket_price' => 'required|integer|min:0',
            'opening_hours' => 'required|string|max:100',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'name.required' => 'Nama destinasi wajib diisi.',
            'category.required' => 'Kategori wajib dipilih atau diisi.',
            'location_city.required' => 'Kota/Kabupaten lokasi wajib diisi.',
            'ticket_price.required' => 'Harga tiket masuk wajib diisi.',
            'ticket_price.min' => 'Harga tiket tidak boleh negatif (isi 0 jika gratis).',
            'opening_hours.required' => 'Jam operasional wajib diisi.',
            'description.required' => 'Deskripsi destinasi wajib diisi.',
            'image.image' => 'File yang diunggah harus berupa gambar.',
            'image.mimes' => 'Format gambar yang diperbolehkan: jpeg, png, jpg, webp.',
            'image.max' => 'Ukuran gambar maksimal adalah 2MB.',
        ]);

        // Perbarui slug jika nama berubah
        if ($destination->name !== $validated['name']) {
            $baseSlug = Str::slug($validated['name']);
            $slug = $baseSlug;
            $counter = 1;
            while (Destination::where('slug', $slug)->where('id', '!=', $destination->id)->exists()) {
                $slug = "{$baseSlug}-{$counter}";
                $counter++;
            }
            $validated['slug'] = $slug;
        }

        // Jika ada unggahan gambar baru, hapus gambar lama dari storage lokal
        if ($request->hasFile('image')) {
            if ($destination->image && Storage::disk('public')->exists($destination->image)) {
                Storage::disk('public')->delete($destination->image);
            }
            $validated['image'] = $request->file('image')->store('destinations', 'public');
        }

        $destination->update($validated);

        return redirect()->route('destinations.show', $destination)
            ->with('success', 'Data destinasi wisata berhasil diperbarui!');
    }

    /**
     * Menghapus destinasi dan membersihkan file gambar terkait (Delete).
     */
    public function destroy(Destination $destination): RedirectResponse
    {
        // Hapus file gambar dari storage lokal jika ada
        if ($destination->image && Storage::disk('public')->exists($destination->image)) {
            Storage::disk('public')->delete($destination->image);
        }

        $destination->delete();

        return redirect()->route('destinations.index')
            ->with('success', 'Destinasi wisata beserta gambar berhasil dihapus dari sistem.');
    }
}

