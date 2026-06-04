<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MixController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\MixController as AdminMixController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\ReservationController as AdminReservationController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;

// Sitio público
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/events', [EventController::class, 'index'])->name('events');
Route::get('/mixes', [MixController::class, 'index'])->name('mixes');
Route::get('/booking', [BookingController::class, 'index'])->name('booking');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/gallery', [App\Http\Controllers\GalleryController::class, 'index'])->name('gallery');

// Panel admin (protegido)
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('events', AdminEventController::class);
    Route::resource('mixes', AdminMixController::class);
    Route::resource('gallery', AdminGalleryController::class);
    Route::resource('reservations', AdminReservationController::class);
    Route::resource('messages', AdminMessageController::class);
    Route::get('profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [AdminProfileController::class, 'update'])->name('profile.update');
});

require __DIR__.'/auth.php';