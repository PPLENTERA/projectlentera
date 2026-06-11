<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Recipient;

use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\RecipientController;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Masyarakat\LaporanPenyalahgunaanController;
use App\Http\Controllers\Masyarakat\PengajuanBantuanController;
use App\Http\Controllers\Masyarakat\PendaftaranBantuanController;
use App\Http\Controllers\Masyarakat\NotificationController;
use App\Http\Controllers\Admin\ValidasiVerifikasiController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\ScoringIndicatorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\MonitoringController;
use App\Http\Controllers\Admin\BroadcastController;

/*
|--------------------------------------------------------------------------
| Landing Page
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('landing-page-lentera', [
        'totalDana' => 12400000000000,
        'totalPenerima' => Recipient::count(),
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
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout.get');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/monitoring', [MonitoringController::class, 'index'])->name('admin.monitoring');

    Route::get('/validasi', [ValidasiVerifikasiController::class, 'index'])->name('admin.validasi.index');
    Route::get('/validasi/export', [ValidasiVerifikasiController::class, 'export'])->name('admin.validasi.export');
    Route::get('/validasi/{id}', [ValidasiVerifikasiController::class, 'show'])->name('admin.validasi.show');
    Route::put('/validasi/{id}', [ValidasiVerifikasiController::class, 'update'])->name('admin.validasi.update');
    Route::get('/penentuan', [ValidasiVerifikasiController::class, 'penentuanPenerima'])->name('admin.validasi.penentuan');
    Route::post('/penentuan/{id}/status', [ValidasiVerifikasiController::class, 'updateStatusPenerima'])->name('admin.validasi.update_status');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('admin.laporan.index');
    Route::get('/laporan/{id}', [LaporanController::class, 'show'])->name('admin.laporan.show');
    Route::put('/laporan/{id}', [LaporanController::class, 'update'])->name('admin.laporan.update');

    Route::get('/broadcast', [BroadcastController::class, 'index'])->name('admin.broadcast.index');
    Route::post('/broadcast', [BroadcastController::class, 'send'])->name('admin.broadcast.send');
    Route::resource('scoring-indicators', ScoringIndicatorController::class)->names('admin.scoring_indicators');
});

/*
|--------------------------------------------------------------------------
| Masyarakat
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:masyarakat'])->prefix('masyarakat')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'masyarakatDashboard'])->name('masyarakat.dashboard');

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

    Route::get('/notifikasi', [NotificationController::class, 'index'])->name('masyarakat.notifikasi.index');
    Route::post('/notifikasi/read-all', [NotificationController::class, 'markAllRead'])->name('masyarakat.notifikasi.read_all');
    Route::post('/notifikasi/{id}/read', [NotificationController::class, 'markRead'])->name('masyarakat.notifikasi.read');
});

Route::get('/feedback', [FeedbackController::class, 'create'])->name('feedback.create');
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
