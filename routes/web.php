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
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    Route::get('/reservations', [ReservationController::class, 'index'])->name('admin.index');
    // Ajoutez d'autres routes administratives ici
    Route::post('/chambre', [RoomController::class, 'store'])->name('chambre.store');

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
Route::get('/chambre', [RoomController::class, 'index'])->name('chambre.index');
Route::get('/chambre/create', [RoomController::class, 'create'])->name('chambre.create');
Route::get('/chambre/{id}', [RoomController::class, 'show'])->name('chambre.show');
Route::get('/chambres/{chambre}/availability', [RoomController::class, 'checkAvailability'])->name('chambres.checkAvailability');

Route::get('/equipements', [RoomOptionsController::class, 'index'])->name('equipements.index');
Route::get('/equipements/create', [RoomOptionsController::class, 'create'])->name('equipements.create');
Route::post('/equipements', [RoomOptionsController::class, 'store'])->name('equipements.store');

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');

// Auth routes
require __DIR__.'/auth.php';
