<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomOptionsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;

// Dashboard route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin routes
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    Route::get('/', [ReservationController::class, 'index'])->name('admin.index');

    // Room routes
    Route::prefix('rooms')->name('admin.rooms.')->group(function () {
        Route::get('/', [RoomController::class, 'adminIndex'])->name('index');
        Route::get('/create', [RoomController::class, 'create'])->name('create');
        Route::post('/', [RoomController::class, 'store'])->name('store');
        Route::get('/{room}/edit', [RoomController::class, 'edit'])->name('edit');
        Route::put('/{room}', [RoomController::class, 'update'])->name('update');
    });

    // Room options routes
    Route::prefix('options')->name('admin.options.')->group(function () {
        Route::get('/', [RoomOptionsController::class, 'adminIndex'])->name('index');
        Route::get('/create', [RoomOptionsController::class, 'create'])->name('create');
        Route::post('/', [RoomOptionsController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [RoomOptionsController::class, 'edit'])->name('edit');
        Route::put('/{id}', [RoomOptionsController::class, 'update'])->name('update');
    });

    // FAQ routes
    Route::prefix('faqs')->name('admin.faqs.')->group(function () {
        Route::get('/', [FAQController::class, 'index'])->name('index');
        Route::get('/create', [FAQController::class, 'create'])->name('create');
        Route::post('/', [FAQController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [FAQController::class, 'edit'])->name('edit');
        Route::put('/{id}', [FAQController::class, 'update'])->name('update');
        Route::delete('/{id}', [FAQController::class, 'destroy'])->name('destroy');
    });

    // Contact routes
    Route::get('contacts', [ContactController::class, 'adminIndex'])->name('admin.contacts.index');
    Route::put('/contacts/{id}/status', [ContactController::class, 'updateStatus'])->name('admin.contacts.updateStatus');

    // Reservation routes
    Route::get('/reservation', [ReservationController::class, 'createFromAdmin'])->name('admin.reservation.createFromAdmin');
    Route::post('/reservation', [ReservationController::class, 'storeFromAdmin'])->name('admin.reservation.storeFromAdmin');


    // Review routes
    // Review routes
    Route::prefix('reviews')->name('admin.reviews.')->group(function () {
        Route::get('/', [ReviewController::class, 'adminIndex'])->name('index');
        Route::delete('/{id}', [ReviewController::class, 'destroy'])->name('destroy');
    });




});

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Public routes
Route::get('faqs', [FAQController::class, 'showForUsers'])->name('faqs.index');
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/about', [AboutController::class, 'index'])->name('about.index');

// Reservation routes
Route::get('/reservation/{id}', [ReservationController::class, 'show'])
    ->where('id', '[0-9]+')
    ->name('reservation.show');
Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.store');
Route::post('/reservation/calculate-total-price', [ReservationController::class, 'calculateTotalPrice'])->name('reservation.calculateTotalPrice');
Route::get('/reservation/merci', function () {
    return view('reservation.merci');
})->name('reservation.merci');


// Room routes
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
Route::get('/rooms/{id}', [RoomController::class, 'show'])->name('rooms.show');
Route::get('/rooms/{rooms}/availability', [RoomController::class, 'checkAvailability'])->name('rooms.checkAvailability');

// Room options routes
Route::get('/options', [RoomOptionsController::class, 'index'])->name('options.index');
Route::get('/options/create', [RoomOptionsController::class, 'create'])->name('options.create');
Route::post('/options', [RoomOptionsController::class, 'store'])->name('options.store');

// Contact routes
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'submitForm'])->name('contact.submit');

Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

// Auth routes
require __DIR__ . '/auth.php';
