<?php

use App\Http\Controllers\SpeakerController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('speakers.index'));
Route::resource('speakers', SpeakerController::class)->only(['index', 'store', 'edit', 'update', 'destroy']);