<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UltrasoundRecordController;
use App\Http\Controllers\OTPController;
use App\Http\Controllers\OtpVerificationController;


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

Route::post('/fetch-data', [UltrasoundRecordController::class, 'fetchData'])->name('fetch.data');
Route::post('/fetch-data_auth', [UltrasoundRecordController::class, 'fetchData_auth'])->name('fetch.data_auth');

Route::get('/verify-otp', [OtpVerificationController::class, 'show'])->name('verify-otp');
Route::post('/verify-otp', [OtpVerificationController::class, 'verify'])->name('verify-otp.submit');
Route::post('/send-otp', [OtpVerificationController::class, 'sendOtp'])->name('send-otp');
