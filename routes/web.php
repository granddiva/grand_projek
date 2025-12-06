<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\PosyanduController;
use App\Http\Controllers\KaderPosyanduController;
use App\Http\Controllers\LayananPosyanduController;
use App\Http\Controllers\JadwalPosyanduController;
use App\Http\Controllers\ProfileController;

// ==========================
// HALAMAN UTAMA
// ==========================
Route::get('/', [PosyanduController::class, 'index'])->name('home');

// ==========================
// LOGIN
// ==========================
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==========================
// RESOURCE ROUTES
// ==========================
Route::resource('layanan', LayananPosyanduController::class);
Route::resource('user', UserController::class);
Route::resource('warga', WargaController::class);
Route::resource('posyandu', PosyanduController::class);
Route::resource('kaderposyandu', KaderPosyanduController::class);
Route::resource('jadwal', JadwalPosyanduController::class);


// ==========================
// HALAMAN GUEST
// ==========================
Route::get('/about', function () {
    return view('guest.about.about');
})->name('about');
