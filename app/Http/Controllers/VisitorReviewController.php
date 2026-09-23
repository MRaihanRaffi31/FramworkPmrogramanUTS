<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\VisitorReview;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VisitorReviewController extends Controller
{
    /**
     * Menampilkan daftar ulasan pengunjung (Browse).
     */
    public function index(Request $request): View
    {
        $query = VisitorReview::query();

        if ($request->filled('rating')) {
            $query->where('rating', $request->input('rating'));
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('visitor_name', 'like', "%{$search}%")
                  ->orWhere('destination_visited', 'like', "%{$search}%")
                  ->orWhere('review_text', 'like', "%{$search}%");
            });
        }

        $reviews = $query->latest()->paginate(8)->withQueryString();

        return view('reviews.index', compact('reviews'));
    }

    /**
     * Menampilkan form tulis ulasan baru (Add/Create).
     */
    public function create(): View
    {
        $destinations = Destination::orderBy('name')->pluck('name');
        return view('reviews.create', compact('destinations'));
    }

    /**
     * Menyimpan ulasan pengunjung ke database (Store).
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'visitor_name' => 'required|string|max:255',
            'destination_visited' => 'required|string|max:255',
            'rating' => 'required|integer|between:1,5',
            'visit_date' => 'required|date|before_or_equal:today',
            'review_text' => 'required|string',
        ], [
            'visitor_name.required' => 'Nama lengkap pengunjung wajib diisi.',
            'destination_visited.required' => 'Destinasi yang dikunjungi wajib diisi atau dipilih.',
            'rating.required' => 'Rating bintang wajib dipilih (1 - 5).',
            'rating.between' => 'Rating harus antara 1 sampai 5 bintang.',
            'visit_date.required' => 'Tanggal kunjungan wajib diisi.',
            'visit_date.before_or_equal' => 'Tanggal kunjungan tidak boleh di masa mendatang.',
            'review_text.required' => 'Ulasan dan cerita pengalaman wajib diisi.',
        ]);

        VisitorReview::create($validated);

        return redirect()->route('reviews.index')
            ->with('success', 'Terima kasih! Ulasan Anda berhasil diterbitkan.');
    }

    /**
     * Menampilkan form edit ulasan (Edit).
     */
    public function edit(VisitorReview $review): View
    {
        $destinations = Destination::orderBy('name')->pluck('name');
        return view('reviews.edit', compact('review', 'destinations'));
    }

    /**
     * Memperbarui ulasan pengunjung (Update).
     */
    public function update(Request $request, VisitorReview $review): RedirectResponse
    {
        $validated = $request->validate([
            'visitor_name' => 'required|string|max:255',
            'destination_visited' => 'required|string|max:255',
            'rating' => 'required|integer|between:1,5',
            'visit_date' => 'required|date|before_or_equal:today',
            'review_text' => 'required|string',
        ], [
            'visitor_name.required' => 'Nama lengkap pengunjung wajib diisi.',
            'destination_visited.required' => 'Destinasi yang dikunjungi wajib diisi atau dipilih.',
            'rating.required' => 'Rating bintang wajib dipilih (1 - 5).',
            'rating.between' => 'Rating harus antara 1 sampai 5 bintang.',
            'visit_date.required' => 'Tanggal kunjungan wajib diisi.',
            'visit_date.before_or_equal' => 'Tanggal kunjungan tidak boleh di masa mendatang.',
            'review_text.required' => 'Ulasan dan cerita pengalaman wajib diisi.',
        ]);

        $review->update($validated);

        return redirect()->route('reviews.index')
            ->with('success', 'Ulasan pengunjung berhasil diperbarui!');
    }

    /**
     * Menghapus ulasan pengunjung (Delete).
     */
    public function destroy(VisitorReview $review): RedirectResponse
    {
        $review->delete();

        return redirect()->route('reviews.index')
            ->with('success', 'Ulasan berhasil dihapus.');
    }
}

