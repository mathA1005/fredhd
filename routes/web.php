<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FAQController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomOptionsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservationController;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    Route::get('/', [ReservationController::class, 'index'])->name('admin.index');

    Route::get('rooms', [RoomController::class, 'adminIndex'])->name('admin.rooms.index');
    Route::get('rooms/create', [RoomController::class, 'create'])->name('admin.rooms.create');
    Route::post('rooms', [RoomController::class, 'store'])->name('admin.rooms.store');
    Route::get('rooms/{room}/edit', [RoomController::class, 'edit'])->name('admin.rooms.edit');
    Route::put('rooms/{room}', [RoomController::class, 'update'])->name('admin.rooms.update');

    Route::get('options', [RoomOptionsController::class, 'adminIndex'])->name('admin.options.index');
    Route::get('options/create', [RoomOptionsController::class, 'create'])->name('admin.options.create');
    Route::post('options', [RoomOptionsController::class, 'store'])->name('admin.options.store');
    Route::get('options/{id}/edit', [RoomOptionsController::class, 'edit'])->name('admin.options.edit');
    Route::put('options/{id}', [RoomOptionsController::class, 'update'])->name('admin.options.update');

    Route::get('faqs', [FAQController::class, 'index'])->name('admin.faqs.index');
    Route::get('faqs/create', [FAQController::class, 'create'])->name('admin.faqs.create');
    Route::post('faqs', [FAQController::class, 'store'])->name('admin.faqs.store');
    Route::get('faqs/{id}/edit', [FAQController::class, 'edit'])->name('admin.faqs.edit');
    Route::put('faqs/{id}', [FAQController::class, 'update'])->name('admin.faqs.update');
    Route::delete('faqs/{id}', [FAQController::class, 'destroy'])->name('admin.faqs.destroy');

});

// Groupe de routes protégées par authentification pour le ProfileController
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //route pour la réservation


});

Route::get('faqs', [FAQController::class, 'showForUsers'])->name('faqs.index');

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('/about', [AboutController::class, 'index'])->name('about.index');

// Correction pour utiliser les méthodes du contrôleur ChambreController
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
Route::get('/rooms/{id}', [RoomController::class, 'show'])->name('rooms.show');
Route::get('/rooms/{rooms}/availability', [RoomController::class, 'checkAvailability'])->name('rooms.checkAvailability');

Route::get('/options', [RoomOptionsController::class, 'index'])->name('options.index');
Route::get('/options/create', [RoomOptionsController::class, 'create'])->name('options.create');
Route::post('/options', [RoomOptionsController::class, 'store'])->name('options.store');

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'submitForm'])->name('contact.submit');

// Auth routes
require __DIR__ . '/auth.php';
