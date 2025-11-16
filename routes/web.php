<?php

use App\Models\KaderPosyandu;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\PosyanduController;
use App\Http\Controllers\KaderPosyanduController;
use App\Http\Controllers\LayananPosyanduController;

Route::get('/layanan', function () {
    return view('Dashboard');
});

Route::get('/', [LayananPosyanduController::class, 'index']);
Route::resource('layanan', LayananPosyanduController::class);
Route::resource('user', UserController::class);
Route::resource('warga', WargaController::class);
Route::get('/login', [AuthController::class, 'index'])->name('login.index');

Route::post('/login', [AuthController::class, 'login']);
Route::get('/about', function () {
    return view('guest/about.about');
})->name('about');

Route::resource('posyandu', PosyanduController::class);
Route::resource('kaderposyandu', KaderPosyanduController::class);
