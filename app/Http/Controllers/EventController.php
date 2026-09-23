<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EventController extends Controller
{
    /**
     * Menampilkan daftar event & budaya (Browse).
     */
    public function index(Request $request): View
    {
        $query = Event::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('event_name', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('organizer', 'like', "%{$search}%");
            });
        }

        $events = $query->orderBy('start_date', 'asc')->paginate(10)->withQueryString();

        return view('events.index', compact('events'));
    }

    /**
     * Menampilkan form tambah event baru (Add/Create).
     */
    public function create(): View
    {
        return view('events.create');
    }

    /**
     * Menyimpan event baru ke database (Store).
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'event_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'organizer' => 'required|string|max:255',
            'description' => 'required|string',
        ], [
            'event_name.required' => 'Nama event wajib diisi.',
            'location.required' => 'Lokasi penyelenggaraan wajib diisi.',
            'start_date.required' => 'Tanggal mulai wajib diisi.',
            'end_date.required' => 'Tanggal selesai wajib diisi.',
            'end_date.after_or_equal' => 'Tanggal selesai harus sama atau setelah tanggal mulai.',
            'organizer.required' => 'Pihak penyelenggara wajib diisi.',
            'description.required' => 'Deskripsi event wajib diisi.',
        ]);

        Event::create($validated);

        return redirect()->route('events.index')
            ->with('success', 'Event & Budaya baru berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail event (Read/Show).
     */
    public function show(Event $event): View
    {
        return view('events.show', compact('event'));
    }

    /**
     * Menampilkan form edit event (Edit).
     */
    public function edit(Event $event): View
    {
        return view('events.edit', compact('event'));
    }

    /**
     * Memperbarui data event (Update).
     */
    public function update(Request $request, Event $event): RedirectResponse
    {
        $validated = $request->validate([
            'event_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'organizer' => 'required|string|max:255',
            'description' => 'required|string',
        ], [
            'event_name.required' => 'Nama event wajib diisi.',
            'location.required' => 'Lokasi penyelenggaraan wajib diisi.',
            'start_date.required' => 'Tanggal mulai wajib diisi.',
            'end_date.required' => 'Tanggal selesai wajib diisi.',
            'end_date.after_or_equal' => 'Tanggal selesai harus sama atau setelah tanggal mulai.',
            'organizer.required' => 'Pihak penyelenggara wajib diisi.',
            'description.required' => 'Deskripsi event wajib diisi.',
        ]);

        $event->update($validated);

        return redirect()->route('events.index')
            ->with('success', 'Data event berhasil diperbarui!');
    }

    /**
     * Menghapus event (Delete).
     */
    public function destroy(Event $event): RedirectResponse
    {
        $event->delete();

        return redirect()->route('events.index')
            ->with('success', 'Event berhasil dihapus dari kalender pariwisata!');
    }
}

