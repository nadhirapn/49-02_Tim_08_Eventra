<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PesertaController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('dashboard'));

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');

    // Khusus admin: detail, edit, update, hapus
    Route::middleware('role:admin')->group(function () {
        Route::resource('peserta', PesertaController::class)
            ->except(['index', 'create', 'store', 'show']);
    });

    // Admin dan user: lihat daftar, tambah data
    Route::resource('peserta', PesertaController::class)
        ->only(['index', 'create', 'store']);
});