<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JadwalPosyanduController;
use App\Http\Controllers\KaderPosyanduController;
use App\Http\Controllers\LayananPosyanduController;
use App\Http\Controllers\PosyanduController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use Illuminate\Support\Facades\Route;

// LOGIN
Route::match(['GET', 'POST'], '/', [AuthController::class, 'index'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::view('/about', 'pages.about.about')->name('about');
// SEMUA YANG LOGIN
Route::middleware(['checkislogin'])->group(function () {

    // ADMIN ONLY
    Route::resource('user', UserController::class)
        ->middleware('checkrole:admin');

    Route::resource('posyandu', PosyanduController::class)
        ->middleware('checkrole:admin,warga,kader');

    Route::resource('kaderposyandu', KaderPosyanduController::class)
        ->middleware('checkrole:admin');

    // ADMIN & KADER
    Route::resource('layanan', LayananPosyanduController::class)
        ->middleware('checkrole:admin,kader');

    Route::resource('jadwal', JadwalPosyanduController::class)
        ->middleware('checkrole:admin,kader');

    Route::resource('warga', WargaController::class)
        ->middleware('checkrole:admin,kader');
});
