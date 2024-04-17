<?php
use App\Http\Controllers\ChambreController;
use App\Http\Controllers\EquipementController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

// Groupe de routes protégées par authentification pour le ProfileController
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth routes
require __DIR__.'/auth.php';
