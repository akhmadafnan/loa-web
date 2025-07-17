<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\LoaController;
use App\Http\Controllers\LoaVerificationController;
use App\Http\Controllers\LoaRequestController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// =======================
// FRONTEND (Tanpa Login)
// =======================
Route::get('/', fn() => view('home'));

Route::get('/loa', [LoaController::class, 'frontend'])->name('loa.frontend');
Route::get('/req-loa', [LoaRequestController::class, 'create'])->name('loa.form');
Route::post('/req-loa', [LoaRequestController::class, 'store'])->name('loa.store');

Route::get('/sukses', function () {
    $regNumber = session('regNumber');
    return view('loa.sukses', compact('regNumber'));
})->name('loa.sukses');

Route::get('/verifikasi-loa', [LoaVerificationController::class, 'form'])->name('loa.verifikasi.form');
Route::post('/verifikasi-loa/check', [LoaVerificationController::class, 'check'])->name('loa.verifikasi.check');
Route::get('/loa/scan/{no_reg}', [LoaVerificationController::class, 'scan'])->name('loa.scan');

// Cetak LOA publik tanpa login
Route::get('/loa/cetak/{id}/{lang}', [LoaController::class, 'printPublic'])->name('loa.print.public');




// =======================
// AUTH & DASHBOARD
// =======================
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile: arahkan ke tampilan kustom
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit/{name}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update/{name}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Logout
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    })->name('logout');
});


// =======================
// BACKEND ADMIN ROUTES
// =======================
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // Jurnal
    Route::resource('journals', JournalController::class);

    // LOA Requests (PENDING)
    Route::prefix('loarequests')->name('loarequests.')->group(function () {
        Route::get('/', [LoaRequestController::class, 'index'])->name('index');
        Route::post('/{id}/approve', [LoaRequestController::class, 'approve'])->name('approve');
        Route::delete('/{id}/reject', [LoaRequestController::class, 'reject'])->name('reject');
    });

    // LOA Approved
    Route::get('/loas', [LoaController::class, 'index'])->name('loas.index');
    Route::get('/loas/{id}', [LoaController::class, 'show'])->name('loa.view');
    Route::get('/loas/{id}/edit', [LoaController::class, 'edit'])->name('loa.edit');
    Route::put('/loas/{id}', [LoaController::class, 'update'])->name('loa.update');
    Route::delete('/loas/{id}', [LoaController::class, 'destroy'])->name('loa.destroy');

    // Route cetak
    Route::get('/loas/print/{registration_number}/{lang}', [LoaController::class, 'print'])->name('loa.print');

    // Penerbit
    Route::resource('penerbits', PenerbitController::class);

    // Route::get('/loas/{id}/print/{lang}', [LoaController::class, 'print'])->name('loa.print');


    // Route::get('/loas/{id}/print/{lang}', [App\Http\Controllers\LoaController::class, 'print'])->name('loa.print');
    // Route::get('/loas/{id}/print/{lang}', [LoaController::class, 'print'])->name('loa.print');
    // Route::get('/loas/{id}/print/{lang}', [LoaController::class, 'print'])->name('admin.loa.print');
});

Route::get('/recent-activity', [App\Http\Controllers\DashboardController::class, 'recentActivity'])->name('recent.activity');


require __DIR__ . '/auth.php';
