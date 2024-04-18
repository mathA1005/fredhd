<?php
use App\Http\Controllers\ChambreController;
use App\Http\Controllers\EquipementController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Correction pour utiliser les méthodes du contrôleur ChambreController
Route::get('/chambre', [ChambreController::class, 'index'])->name('chambre.index');
Route::get('/chambre/create', [ChambreController::class, 'create'])->name('chambre.create');
Route::get('/chambre/{id}', [ChambreController::class, 'show'])->name('chambre.show');
Route::post('/chambre', [ChambreController::class, 'store'])->name('chambre.store');
Route::get('/equipements', [EquipementController::class, 'index'])->name('equipements.index');
Route::get('/equipements/create', [EquipementController::class, 'create'])->name('equipements.create');
Route::post('/equipements', [EquipementController::class, 'store'])->name('equipements.store');
Route::get('/chambres/{chambre}/availability', [ChambreController::class, 'checkAvailability'])->name('chambres.checkAvailability');

Route::middleware(['admin'])->group(function () {
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservation.index');
    // Ajoutez d'autres routes administratives ici
});

// Groupe de routes protégées par authentification pour le ProfileController
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth routes
require __DIR__.'/auth.php';
