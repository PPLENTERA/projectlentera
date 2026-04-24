<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Masyarakat\PengajuanBantuanController;
use App\Http\Controllers\Admin\ValidasiVerifikasiController;


Route::get('/', function () {
    return view('welcome');
});

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
    Route::get('/validasi', [ValidasiVerifikasiController::class, 'index'])->name('admin.validasi.index');
    Route::get('/validasi/{id}', [ValidasiVerifikasiController::class, 'show'])->name('admin.validasi.show');
    Route::put('/validasi/{id}', [ValidasiVerifikasiController::class, 'update'])->name('admin.validasi.update');
});

Route::middleware(['auth', 'role:masyarakat'])->prefix('masyarakat')->group(function () {
    Route::get('/dashboard', function () {
        return "Ini halaman Dashboard Masyarakat.";
    })->name('masyarakat.dashboard');
    Route::get('/pengajuan/create', [PengajuanBantuanController::class, 'create'])->name('masyarakat.pengajuan.create');
    Route::post('/pengajuan', [PengajuanBantuanController::class, 'store'])->name('masyarakat.pengajuan.store');
    Route::get('/pengajuan', [PengajuanBantuanController::class, 'index'])->name('masyarakat.pengajuan.index');
    Route::get('/pengajuan/{id}/upload', [PengajuanBantuanController::class, 'uploadForm'])->name('masyarakat.pengajuan.upload');
    Route::post('/pengajuan/{id}/upload', [PengajuanBantuanController::class, 'uploadDokumen'])->name('masyarakat.pengajuan.upload.dokumen');
});
