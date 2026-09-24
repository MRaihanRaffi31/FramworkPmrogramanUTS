<?php

use App\Http\Controllers\CulinaryController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\VisitorReviewController;
use Illuminate\Support\Facades\Route;

// BREAD

// beranda
Route::get('/', function () {
    return redirect()->route('destinations.index');
});

// destinasi wisata
Route::get('/destinations', [DestinationController::class, 'index'])->name('destinations.index');
Route::get('/destinations/create', [DestinationController::class, 'create'])->name('destinations.create');
Route::post('/destinations', [DestinationController::class, 'store'])->name('destinations.store');
Route::get('/destinations/{destination}', [DestinationController::class, 'show'])->name('destinations.show');
Route::get('/destinations/{destination}/edit', [DestinationController::class, 'edit'])->name('destinations.edit');
Route::put('/destinations/{destination}', [DestinationController::class, 'update'])->name('destinations.update');
Route::delete('/destinations/{destination}', [DestinationController::class, 'destroy'])->name('destinations.destroy');



// kuliner 
Route::get('/culinaries', [CulinaryController::class, 'index'])->name('culinaries.index');
Route::get('/culinaries/create', [CulinaryController::class, 'create'])->name('culinaries.create');
Route::post('/culinaries', [CulinaryController::class, 'store'])->name('culinaries.store');
Route::get('/culinaries/{culinary}', [CulinaryController::class, 'show'])->name('culinaries.show');
Route::get('/culinaries/{culinary}/edit', [CulinaryController::class, 'edit'])->name('culinaries.edit');
Route::put('/culinaries/{culinary}', [CulinaryController::class, 'update'])->name('culinaries.update');
Route::delete('/culinaries/{culinary}', [CulinaryController::class, 'destroy'])->name('culinaries.destroy');


// event dan budaya
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
Route::post('/events', [EventController::class, 'store'])->name('events.store');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');


// ulasan pengunjung
Route::get('/reviews', [VisitorReviewController::class, 'index'])->name('reviews.index');
Route::get('/reviews/create', [VisitorReviewController::class, 'create'])->name('reviews.create');

Route::post('/reviews', [VisitorReviewController::class, 'store'])->name('reviews.store');
Route::get('/reviews/{review}/edit', [VisitorReviewController::class, 'edit'])->name('reviews.edit');
Route::put('/reviews/{review}', [VisitorReviewController::class, 'update'])->name('reviews.update');
Route::delete('/reviews/{review}', [VisitorReviewController::class, 'destroy'])->name('reviews.destroy');
