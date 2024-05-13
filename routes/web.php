<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomOptionsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservationController;

Route::get('/dashboard', function () {
    return view('dashboard');})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    Route::get('/', [ReservationController::class, 'index'])->name('admin.index');

    // Ajoutez d'autres routes administratives ici
    Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');

});

// Groupe de routes protégées par authentification pour le ProfileController
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('/about', [AboutController::class, 'index'])->name('about.index');

// Correction pour utiliser les méthodes du contrôleur ChambreController
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
Route::get('/rooms/create', [RoomController::class, 'create'])->name('rooms.create');
Route::get('/rooms/{id}', [RoomController::class, 'show'])->name('rooms.show');
Route::get('/chambres/{rooms}/availability', [RoomController::class, 'checkAvailability'])->name('chambres.checkAvailability');

Route::get('/options', [RoomOptionsController::class, 'index'])->name('options.index');
Route::get('/options/create', [RoomOptionsController::class, 'create'])->name('options.create');
Route::post('/options', [RoomOptionsController::class, 'store'])->name('options.store');

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'submitForm'])->name('contact.submit');

// Auth routes
require __DIR__.'/auth.php';
