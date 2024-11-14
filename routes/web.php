<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/new-car', [CarController::class, 'create'])->name('cars.create.index');
Route::post('/new-car', [CarController::class, 'store'])->name('cars.create.store');

Route::get('/cars', [CarController::class, 'index'])->name('cars.index.index');
Route::get('/cars/{id}', [CarController::class, 'show'])->name('cars.index.show');
Route::post('/cars', [RentController::class, 'store'])->name('cars.index.store');

Route::get('/rents', [RentController::class, 'index'])->name('rents.index');
Route::get('/rents/{id}', [RentController::class, 'show'])->name('rents.show');
Route::put('/rents/{id}', [RentController:: class, 'update'])->name('rents.update');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
