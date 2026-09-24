<?php

use App\Http\Controllers\CulinaryController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\VisitorReviewController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Sistem Informasi Pariwisata Kalimantan Timur
|--------------------------------------------------------------------------
| Seluruh rute HTTP (GET, POST, PUT, DELETE) didefinisikan secara eksplisit
| untuk mendukung operasi penuh BREAD (Browse, Read, Edit, Add, Delete).
*/

// ==========================================
// 1. BERANDA / REDIRECT ROOT
// ==========================================
Route::get('/', function () {
    return redirect()->route('destinations.index');
});

// ==========================================
// 2. MODUL DESTINASI WISATA (CRUD LENGKAP)
// ==========================================
// [GET] Menampilkan katalog semua destinasi wisata (Browse / Index)
Route::get('/destinations', [DestinationController::class, 'index'])->name('destinations.index');

// [GET] Menampilkan formulir tambah destinasi baru (Add / Create Form)
Route::get('/destinations/create', [DestinationController::class, 'create'])->name('destinations.create');

// [POST] Menyimpan data destinasi baru beserta upload file gambar (Store / Insert)
Route::post('/destinations', [DestinationController::class, 'store'])->name('destinations.store');

// [GET] Menampilkan halaman detail satu destinasi (Read / Show)
Route::get('/destinations/{destination}', [DestinationController::class, 'show'])->name('destinations.show');

// [GET] Menampilkan formulir edit destinasi wisata (Edit Form)
Route::get('/destinations/{destination}/edit', [DestinationController::class, 'edit'])->name('destinations.edit');

// [PUT] Memperbarui data destinasi & mengganti file gambar lama (Update)
Route::put('/destinations/{destination}', [DestinationController::class, 'update'])->name('destinations.update');

// [DELETE] Menghapus data destinasi beserta file gambar fisik dari storage (Destroy / Delete)
Route::delete('/destinations/{destination}', [DestinationController::class, 'destroy'])->name('destinations.destroy');


// ==========================================
// 3. MODUL KULINER KHAS (CRUD LENGKAP)
// ==========================================
// [GET] Menampilkan daftar kuliner khas daerah (Browse / Index)
Route::get('/culinaries', [CulinaryController::class, 'index'])->name('culinaries.index');

// [GET] Menampilkan formulir tambah kuliner baru (Add / Create Form)
Route::get('/culinaries/create', [CulinaryController::class, 'create'])->name('culinaries.create');

// [POST] Menyimpan data kuliner baru ke database (Store / Insert)
Route::post('/culinaries', [CulinaryController::class, 'store'])->name('culinaries.store');

// [GET] Menampilkan detail lengkap kuliner khas (Read / Show)
Route::get('/culinaries/{culinary}', [CulinaryController::class, 'show'])->name('culinaries.show');

// [GET] Menampilkan formulir edit data kuliner (Edit Form)
Route::get('/culinaries/{culinary}/edit', [CulinaryController::class, 'edit'])->name('culinaries.edit');

// [PUT] Memperbarui data kuliner (Update)
Route::put('/culinaries/{culinary}', [CulinaryController::class, 'update'])->name('culinaries.update');

// [DELETE] Menghapus data kuliner dari database (Destroy / Delete)
Route::delete('/culinaries/{culinary}', [CulinaryController::class, 'destroy'])->name('culinaries.destroy');


// ==========================================
// 4. MODUL EVENT & BUDAYA (CRUD LENGKAP)
// ==========================================
// [GET] Menampilkan kalender agenda festival & budaya (Browse / Index)
Route::get('/events', [EventController::class, 'index'])->name('events.index');

// [GET] Menampilkan formulir pendaftaran event baru (Add / Create Form)
Route::get('/events/create', [EventController::class, 'create'])->name('events.create');

// [POST] Menyimpan agenda event baru ke database (Store / Insert)
Route::post('/events', [EventController::class, 'store'])->name('events.store');

// [GET] Menampilkan detail acara & agenda festival (Read / Show)
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

// [GET] Menampilkan formulir edit jadwal/lokasi event (Edit Form)
Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');

// [PUT] Memperbarui data agenda event (Update)
Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');

// [DELETE] Menghapus data event dari sistem (Destroy / Delete)
Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');


// ==========================================
// 5. MODUL ULASAN PENGUNJUNG (CRUD LENGKAP)
// ==========================================
// [GET] Menampilkan daftar testimoni & ulasan wisatawan (Browse / Index)
Route::get('/reviews', [VisitorReviewController::class, 'index'])->name('reviews.index');

// [GET] Menampilkan formulir tulis ulasan baru (Add / Create Form)
Route::get('/reviews/create', [VisitorReviewController::class, 'create'])->name('reviews.create');

// [POST] Menyimpan ulasan & rating bintang pengunjung (Store / Insert)
Route::post('/reviews', [VisitorReviewController::class, 'store'])->name('reviews.store');

// [GET] Menampilkan formulir edit ulasan pengunjung (Edit Form)
Route::get('/reviews/{review}/edit', [VisitorReviewController::class, 'edit'])->name('reviews.edit');

// [PUT] Memperbarui isi ulasan atau penilaian rating (Update)
Route::put('/reviews/{review}', [VisitorReviewController::class, 'update'])->name('reviews.update');

// [DELETE] Menghapus ulasan pengunjung dari database (Destroy / Delete)
Route::delete('/reviews/{review}', [VisitorReviewController::class, 'destroy'])->name('reviews.destroy');
