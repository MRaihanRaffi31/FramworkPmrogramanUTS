<?php

use App\Http\Controllers\CulinaryController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\VisitorReviewController;
use Illuminate\Support\Facades\Route;

// Redirect root ke halaman destinasi wisata
Route::redirect('/', '/destinations');

// Resource Routes CRUD Destinasi Wisata
Route::resource('destinations', DestinationController::class);

// Resource Routes CRUD Kuliner Khas Kaltim
Route::resource('culinaries', CulinaryController::class);

// Resource Routes CRUD Event & Budaya Kaltim
Route::resource('events', EventController::class);

// Resource Routes CRUD Ulasan Pengunjung
Route::resource('reviews', VisitorReviewController::class);
