<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Recipient;

use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\RecipientController;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\LaporanPenyalahgunaanController;
use App\Http\Controllers\Masyarakat\PengajuanBantuanController;
use App\Http\Controllers\Masyarakat\PendaftaranBantuanController;
use App\Http\Controllers\Admin\ValidasiVerifikasiController;
use App\Http\Controllers\Admin\LaporanController;

/*
|--------------------------------------------------------------------------
| Landing Page
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('landing-page-lentera', [
        'totalDana' => 12400000000000,
        'totalPenerima' => 24,
    ]);
});

/*
|--------------------------------------------------------------------------
| Hitung Ulang Score
|--------------------------------------------------------------------------
*/
Route::get('/hitung', function () {
    $data = Recipient::all();

    foreach ($data as $d) {
        $d->save();
    }

    return "OK";
});

/*
|--------------------------------------------------------------------------
| Ranking
|--------------------------------------------------------------------------
*/
Route::get('/ranking', function () {
    $data = Recipient::orderByDesc('score')->get();

    foreach ($data as $d) {
        echo $d->name . " | Skor: " . $d->score . "<br>";
    }
});

/*
|--------------------------------------------------------------------------
| Recommendation
|--------------------------------------------------------------------------
*/
Route::get('/rekomendasi', [RecommendationController::class, 'index']);

/*
|--------------------------------------------------------------------------
| Store Recipient
|--------------------------------------------------------------------------
*/
Route::post('/recipient/store', [RecipientController::class, 'store']);

/*
|--------------------------------------------------------------------------
| Guest
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
});

/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return "Ini halaman Dashboard Admin.";
    })->name('admin.dashboard');

    Route::get('/validasi', [ValidasiVerifikasiController::class, 'index'])->name('admin.validasi.index');
    Route::get('/validasi/{id}', [ValidasiVerifikasiController::class, 'show'])->name('admin.validasi.show');
    Route::put('/validasi/{id}', [ValidasiVerifikasiController::class, 'update'])->name('admin.validasi.update');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('admin.laporan.index');
    Route::get('/laporan/{id}', [LaporanController::class, 'show'])->name('admin.laporan.show');
    Route::put('/laporan/{id}', [LaporanController::class, 'update'])->name('admin.laporan.update');
});

/*
|--------------------------------------------------------------------------
| Masyarakat
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:masyarakat'])->prefix('masyarakat')->group(function () {
    Route::get('/dashboard', function () {
        return "Ini halaman Dashboard Masyarakat.";
    })->name('masyarakat.dashboard');

    Route::get('/pendaftaran/create', [PendaftaranBantuanController::class, 'create'])->name('pendaftaran.create');
    Route::post('/pendaftaran', [PendaftaranBantuanController::class, 'store'])->name('pendaftaran.store');

    Route::get('/pelaporan', [LaporanPenyalahgunaanController::class, 'create'])->name('masyarakat.pelaporan.create');
    Route::post('/pelaporan', [LaporanPenyalahgunaanController::class, 'store'])->name('masyarakat.pelaporan.store');

    Route::get('/pengajuan/create', [PengajuanBantuanController::class, 'create'])->name('masyarakat.pengajuan.create');
    Route::post('/pengajuan', [PengajuanBantuanController::class, 'store'])->name('masyarakat.pengajuan.store');
    Route::get('/pengajuan', [PengajuanBantuanController::class, 'index'])->name('masyarakat.pengajuan.index');
    Route::get('/pengajuan/{id}/upload', [PengajuanBantuanController::class, 'uploadForm'])->name('masyarakat.pengajuan.upload');
    Route::post('/pengajuan/{id}/upload', [PengajuanBantuanController::class, 'uploadDokumen'])->name('masyarakat.pengajuan.upload.dokumen');
});
