<?php

use Illuminate\Support\Facades\Route;
<<<<<<< Updated upstream
=======
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\LaporanPenyalahgunaanController;
>>>>>>> Stashed changes

Route::get('/', function () {
    return view('welcome');
});
<<<<<<< Updated upstream
=======

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return "Ini halaman Dashboard Admin.";
    })->name('admin.dashboard');
});

Route::middleware(['auth', 'role:masyarakat'])->prefix('masyarakat')->group(function () {
    Route::get('/dashboard', function () {
        return "Ini halaman Dashboard Masyarakat.";
    })->name('masyarakat.dashboard');

    Route::get('/pelaporan', [LaporanPenyalahgunaanController::class, 'create'])->name('masyarakat.pelaporan.create');
    Route::post('/pelaporan', [LaporanPenyalahgunaanController::class, 'store'])->name('masyarakat.pelaporan.store');
});
>>>>>>> Stashed changes
