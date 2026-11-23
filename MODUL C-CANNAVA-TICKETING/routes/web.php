<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/tiket', [TiketController::class, 'index'])->name('tiket.index');
    
    // Route Beli dengan Form Konfirmasi
    Route::get('/tiket/beli/{id}', [TiketController::class, 'formBeli'])->name('tiket.form_beli');
    Route::post('/tiket/beli/{id}', [TiketController::class, 'beli'])->name('tiket.beli');
    
    Route::get('/tiket-saya', [TiketController::class, 'tiketSaya'])->name('tiket.saya');
    Route::delete('/tiket/batal/{id}', [TiketController::class, 'batalkan'])->name('tiket.batal');

    Route::middleware('admin')->group(function () {
        Route::get('/tiket/create', [TiketController::class, 'create'])->name('tiket.create');
        Route::post('/tiket/store', [TiketController::class, 'store'])->name('tiket.store');
        Route::get('/tiket/{id}/edit', [TiketController::class, 'edit'])->name('tiket.edit');
        Route::put('/tiket/{id}', [TiketController::class, 'update'])->name('tiket.update');
        Route::delete('/tiket/{id}', [TiketController::class, 'destroy'])->name('tiket.destroy');
        
        Route::get('/admin/tambah', [AuthController::class, 'showCreateAdmin'])->name('admin.create');
        Route::post('/admin/store', [AuthController::class, 'storeAdmin'])->name('admin.store');
        Route::get('/admin/laporan', [TiketController::class, 'laporanPenjualan'])->name('admin.laporan');
    });
});