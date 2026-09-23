<?php

namespace App\Http\Controllers;

use App\Models\Culinary;
use App\Models\Destination;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CulinaryController extends Controller
{
    /**
     * Menampilkan daftar kuliner khas (Browse).
     */
    public function index(Request $request): View
    {
        $query = Culinary::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('origin_city', 'like', "%{$search}%")
                  ->orWhere('recommended_spot', 'like', "%{$search}%");
            });
        }

        if ($request->filled('city')) {
            $query->where('origin_city', $request->input('city'));
        }

        $culinaries = $query->latest()->paginate(9)->withQueryString();
        $cities = Destination::CITIES;

        return view('culinaries.index', compact('culinaries', 'cities'));
    }

    /**
     * Menampilkan form tambah kuliner baru (Add/Create).
     */
    public function create(): View
    {
        $cities = Destination::CITIES;
        return view('culinaries.create', compact('cities'));
    }

    /**
     * Menyimpan kuliner baru ke database (Store).
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'origin_city' => 'required|string|max:100',
            'price_range' => 'required|string|max:100',
            'recommended_spot' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'name.required' => 'Nama kuliner wajib diisi.',
            'origin_city.required' => 'Kota/Kabupaten asal wajib dipilih.',
            'price_range.required' => 'Rentang harga wajib diisi (contoh: Rp 20.000 - Rp 35.000).',
            'recommended_spot.required' => 'Spot rekomendasi wajib diisi.',
            'description.required' => 'Deskripsi kuliner wajib diisi.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar yang diperbolehkan: jpeg, png, jpg, webp.',
            'image.max' => 'Ukuran gambar maksimal adalah 2MB.',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('culinaries', 'public');
        }

        Culinary::create($validated);

        return redirect()->route('culinaries.index')
            ->with('success', 'Kuliner khas berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail kuliner khas (Read/Show).
     */
    public function show(Culinary $culinary): View
    {
        return view('culinaries.show', compact('culinary'));
    }

    /**
     * Menampilkan form edit kuliner (Edit).
     */
    public function edit(Culinary $culinary): View
    {
        $cities = Destination::CITIES;
        return view('culinaries.edit', compact('culinary', 'cities'));
    }

    /**
     * Memperbarui data kuliner dan mengganti file foto jika ada (Update).
     */
    public function update(Request $request, Culinary $culinary): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'origin_city' => 'required|string|max:100',
            'price_range' => 'required|string|max:100',
            'recommended_spot' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'name.required' => 'Nama kuliner wajib diisi.',
            'origin_city.required' => 'Kota/Kabupaten asal wajib dipilih.',
            'price_range.required' => 'Rentang harga wajib diisi.',
            'recommended_spot.required' => 'Spot rekomendasi wajib diisi.',
            'description.required' => 'Deskripsi kuliner wajib diisi.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar yang diperbolehkan: jpeg, png, jpg, webp.',
            'image.max' => 'Ukuran gambar maksimal adalah 2MB.',
        ]);

        if ($request->hasFile('image')) {
            if ($culinary->image && Storage::disk('public')->exists($culinary->image)) {
                Storage::disk('public')->delete($culinary->image);
            }
            $validated['image'] = $request->file('image')->store('culinaries', 'public');
        }

        $culinary->update($validated);

        return redirect()->route('culinaries.index')
            ->with('success', 'Data kuliner berhasil diperbarui!');
    }

    /**
     * Menghapus kuliner dan membersihkan file foto (Delete).
     */
    public function destroy(Culinary $culinary): RedirectResponse
    {
        if ($culinary->image && Storage::disk('public')->exists($culinary->image)) {
            Storage::disk('public')->delete($culinary->image);
        }

        $culinary->delete();

        return redirect()->route('culinaries.index')
            ->with('success', 'Kuliner khas beserta foto berhasil dihapus!');
    }
}

