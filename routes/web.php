<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UltrasoundRecordController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/ultrasound/create', [UltrasoundRecordController::class, 'create'])->name('ultrasound.create');
Route::post('/ultrasound/store', [UltrasoundRecordController::class, 'store'])->name('ultrasound.store');
