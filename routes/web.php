<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ImageController::class, 'index'])->name('images.index');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', [ImageController::class, 'manage'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/upload', [ImageController::class, 'create'])->middleware(['auth', 'verified'])->name('upload');
Route::post('/upload', [ImageController::class, 'store'])->middleware(['auth', 'verified'])->name('images.store');
Route::delete('/images/{id}', [ImageController::class, 'destroy'])->middleware(['auth', 'verified'])->name('images.destroy');
Route::get('/login', [ImageController::class, 'login'])->name('images.index');

require __DIR__.'/auth.php';