<?php

use App\Http\Controllers\PesertaController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('peserta.index'));
Route::resource('peserta', PesertaController::class);