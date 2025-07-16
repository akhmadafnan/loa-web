<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\LoaRequestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::resource('journals', JournalController::class);
    Route::resource('templates', TemplateController::class);
});

Route::get('permintaan-loa', [LoaRequestController::class, 'create']);
Route::post('permintaan-loa', [LoaRequestController::class, 'store']);

require __DIR__ . '/auth.php';
