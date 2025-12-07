<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\PosyanduController;
use App\Http\Controllers\KaderPosyanduController;
use App\Http\Controllers\JadwalPosyanduController;
use App\Http\Controllers\LayananPosyanduController;

// LOGIN
Route::get('/', [AuthController::class, 'index'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// SEMUA YANG LOGIN
Route::middleware(['checkislogin'])->group(function () {

    // ADMIN ONLY
    Route::resource('user', UserController::class)
        ->middleware('checkrole:admin');

    Route::resource('posyandu', PosyanduController::class)
        ->middleware('checkrole:admin,warga');

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
