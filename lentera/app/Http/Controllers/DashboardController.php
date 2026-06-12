<?php

namespace App\Http\Controllers;

use App\Models\PengajuanBantuan;
use App\Models\Recipient;
use App\Models\LaporanPenyalahgunaan;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        $totalPengajuan   = PengajuanBantuan::count();
        $totalDisetujui   = PengajuanBantuan::whereIn('status_pengajuan', ['diverifikasi', 'diterima'])->count();
        $sedangMengajukan = PengajuanBantuan::where('status_pengajuan', 'pending')->count();
        $totalDitolak     = PengajuanBantuan::where('status_pengajuan', 'ditolak')->count();

        $rataRataScore = Recipient::avg('score') ?? 0;
        $totalBantuan  = $totalDisetujui * 500000;

        $feedbackBelumDitinjau = Feedback::where('status', 'belum_ditinjau')->count();
        $totalFeedback         = Feedback::count();

        $laporanPending = LaporanPenyalahgunaan::where('status', 'menunggu_tindak_lanjut')->count();
        $totalLaporan   = LaporanPenyalahgunaan::count();

        $pendaftaranPending = \App\Models\PendaftaranBantuan::where('status', 'pending')->count();
        $totalPendaftaran   = \App\Models\PendaftaranBantuan::count();

        $pendaftaran   = \App\Models\PendaftaranBantuan::all();
        $villages = [
            'Bojongsoang' => 'Desa Bojongsoang',
            'Bojongsari'  => 'Desa Bojongsari',
            'Buahbatu'    => 'Desa Buahbatu',
            'Cipagalo'    => 'Desa Cipagalo',
            'Lengkong'    => 'Desa Lengkong',
            'Tegalluar'   => 'Desa Tegalluar',
        ];

        $wilayahCounts = [];
        foreach ($villages as $key => $name) {
            $wilayahCounts[$name] = 0;
        }
        foreach ($pendaftaran as $p) {
            $alamat = strtoupper($p->alamat_lengkap);
            foreach ($villages as $key => $name) {
                if (str_contains($alamat, strtoupper($key))) {
                    $wilayahCounts[$name]++;
                    break;
                }
            }
        }

        $perWilayah = collect();
        foreach ($wilayahCounts as $villageName => $count) {
            $perWilayah->push(['wilayah' => $villageName, 'total' => $count]);
        }

        // Hitung penyaluran bulanan untuk admin
        $pengajuanApproved = PengajuanBantuan::whereIn('status_pengajuan', ['diverifikasi', 'diterima'])->get();
        
        $grouped = $pengajuanApproved->groupBy(function ($date) {
            return \Carbon\Carbon::parse($date->tanggal_pengajuan)->format('M');
        });

        $penyaluranBulanan = collect();
        foreach (['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'] as $month) {
            $monthData = $grouped->get($month, collect());
            
            $pendidikan = $monthData->filter(fn($q) => stripos($q->jenis_bantuan, 'Pendidikan') !== false)->count() * 1500000;
            $kesehatan  = $monthData->filter(fn($q) => stripos($q->jenis_bantuan, 'Kesehatan') !== false)->count() * 1000000;
            $pangan     = $monthData->filter(fn($q) => stripos($q->jenis_bantuan, 'Pangan') !== false)->count() * 500000;
            $perumahan  = $monthData->filter(fn($q) => stripos($q->jenis_bantuan, 'Perumahan') !== false)->count() * 2000000;

            $penyaluranBulanan->push([
                'bulan'      => strtoupper($month),
                'pendidikan' => $pendidikan,
                'kesehatan'  => $kesehatan,
                'pangan'     => $pangan,
                'perumahan'  => $perumahan,
            ]);
        }

        $recent         = $this->getAdminRecentReports();
        $categoriesList = $this->getCategoriesData();
        $authUser       = Auth::user();

        return view('admin.dashboard', compact(
            'totalPengajuan',
            'totalDisetujui',
            'sedangMengajukan',
            'totalDitolak',
            'rataRataScore',
            'totalBantuan',
            'perWilayah',
            'penyaluranBulanan',
            'recent',
            'categoriesList',
            'feedbackBelumDitinjau',
            'totalFeedback',
            'laporanPending',
            'totalLaporan',
            'pendaftaranPending',
            'totalPendaftaran',
            'authUser'
        ));
    }

    public function masyarakatDashboard()
    {
        $userId = Auth::id();

        $totalBantuan = PengajuanBantuan::where('id_users', $userId)
            ->whereIn('status_pengajuan', ['diverifikasi', 'diterima'])
            ->count() * 500000;

        $pengajuanPending = PengajuanBantuan::where('id_users', $userId)
            ->where('status_pengajuan', 'pending')
            ->count();

        $disetujui = PengajuanBantuan::where('id_users', $userId)
            ->whereIn('status_pengajuan', ['diverifikasi', 'diterima'])
            ->count();

        $ditolak = PengajuanBantuan::where('id_users', $userId)
            ->where('status_pengajuan', 'ditolak')
            ->count();

        $pendaftaranUser = \App\Models\PendaftaranBantuan::where('user_id', $userId)->latest()->first();

        if (!$pendaftaranUser) {
            return redirect()->route('pendaftaran.create')
                ->with('warning', 'Silakan melakukan pendaftaran bantuan terlebih dahulu.');
        }

        $pengajuanTerbaru = PengajuanBantuan::where('id_users', $userId)
            ->with('validasi')
            ->latest()
            ->take(3)
            ->get();

        $pengajuan = PengajuanBantuan::whereIn('status_pengajuan', ['diverifikasi', 'diterima'])->get();

        // Hitung progress per wilayah untuk masyarakat
        $villages = [
            'Bojongsoang' => 'Desa Bojongsoang',
            'Bojongsari'  => 'Desa Bojongsari',
            'Buahbatu'    => 'Desa Buahbatu',
            'Cipagalo'    => 'Desa Cipagalo',
            'Lengkong'    => 'Desa Lengkong',
            'Tegalluar'   => 'Desa Tegalluar',
        ];

        $pendaftaranAll = \App\Models\PendaftaranBantuan::all();
        $wilayahProgressData = [];
        
        foreach ($villages as $key => $villageName) {
            $wilayahCounts = 0;
            $wilayahApproved = 0;
            
            foreach ($pendaftaranAll as $p) {
                $alamat = strtoupper($p->alamat_lengkap);
                if (str_contains($alamat, strtoupper($key))) {
                    $wilayahCounts++;
                    
                    // Hitung yang sudah diterima
                    $userPengajuanApproved = PengajuanBantuan::where('id_users', $p->user_id)
                        ->whereIn('status_pengajuan', ['diverifikasi', 'diterima'])
                        ->count();
                    if ($userPengajuanApproved > 0) {
                        $wilayahApproved++;
                    }
                }
            }
            
            $progress = $wilayahCounts > 0 ? round(($wilayahApproved / $wilayahCounts) * 100) : 0;
            $wilayahProgressData[$villageName] = [
                'wilayah' => $villageName,
                'total' => $wilayahCounts,
                'approved' => $wilayahApproved,
                'progress' => $progress
            ];
        }

        $wilayahProgress = collect($wilayahProgressData);

        $grouped = $pengajuan->groupBy(function ($date) {
            return \Carbon\Carbon::parse($date->tanggal_pengajuan)->format('M');
        });

        $penyaluranBulanan = collect();
        foreach (['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'] as $month) {
            $monthData = $grouped->get($month, collect());
            
            $pendidikan = $monthData->filter(fn($q) => stripos($q->jenis_bantuan, 'Pendidikan') !== false)->count() * 1500000;
            $kesehatan  = $monthData->filter(fn($q) => stripos($q->jenis_bantuan, 'Kesehatan') !== false)->count() * 1000000;
            $pangan     = $monthData->filter(fn($q) => stripos($q->jenis_bantuan, 'Pangan') !== false)->count() * 500000;
            $perumahan  = $monthData->filter(fn($q) => stripos($q->jenis_bantuan, 'Perumahan') !== false)->count() * 2000000;

            $penyaluranBulanan->push([
                'bulan'      => strtoupper($month),
                'pendidikan' => $pendidikan,
                'kesehatan'  => $kesehatan,
                'pangan'     => $pangan,
                'perumahan'  => $perumahan,
            ]);
        }

        $recent         = $this->getMasyarakatRecentReports($userId);
        $categoriesList = $this->getCategoriesData(true);
        $authUser       = Auth::user();
        $unreadNotificationsCount = 0; // Placeholder untuk notifikasi yang belum dibaca

        return view('masyarakat.dashboard', compact(
            'totalBantuan',
            'pengajuanPending',
            'disetujui',
            'ditolak',
            'penyaluranBulanan',
            'wilayahProgress',
            'recent',
            'categoriesList',
            'pendaftaranUser',
            'pengajuanTerbaru',
            'authUser',
            'unreadNotificationsCount'
        ));
    }

    private function getCategoriesData($onlyApproved = false)
    {
        $query = PengajuanBantuan::query();
        if ($onlyApproved) {
            $query->whereIn('status_pengajuan', ['diverifikasi', 'diterima']);
        }
        $allPengajuan = $query->get();

        $categoriesData = [
            'Bantuan Pendidikan' => ['name' => 'Pendidikan', 'icon' => 'academic-cap', 'color' => 'blue',    'hex' => '#3b82f6', 'bg_hex' => '#eff6ff', 'count' => 0, 'approved' => 0],
            'Bantuan Kesehatan'  => ['name' => 'Kesehatan',  'icon' => 'heart',         'color' => 'emerald', 'hex' => '#10b981', 'bg_hex' => '#ecfdf5', 'count' => 0, 'approved' => 0],
            'Bantuan Pangan'     => ['name' => 'Pangan',     'icon' => 'shopping-bag',  'color' => 'amber',   'hex' => '#f59e0b', 'bg_hex' => '#fffbeb', 'count' => 0, 'approved' => 0],
            'Bantuan Perumahan'  => ['name' => 'Perumahan',  'icon' => 'home',          'color' => 'purple',  'hex' => '#8b5cf6', 'bg_hex' => '#f5f3ff', 'count' => 0, 'approved' => 0],
        ];

        foreach ($allPengajuan as $p) {
            $cat = $p->jenis_bantuan;
            if (stripos($cat, 'Pendidikan') !== false)    $key = 'Bantuan Pendidikan';
            elseif (stripos($cat, 'Kesehatan') !== false) $key = 'Bantuan Kesehatan';
            elseif (stripos($cat, 'Pangan') !== false)    $key = 'Bantuan Pangan';
            elseif (stripos($cat, 'Perumahan') !== false) $key = 'Bantuan Perumahan';
            else continue;

            $categoriesData[$key]['count']++;
            if (in_array(strtolower($p->status_pengajuan), ['diverifikasi', 'diterima', 'disetujui'])) {
                $categoriesData[$key]['approved']++;
            }
        }

        $totalCount     = $allPengajuan->count();
        $categoriesList = collect();

        foreach ($categoriesData as $data) {
            $count    = $data['count'];
            $approved = $data['approved'];

            $percentage   = $totalCount > 0 ? round(($count / $totalCount) * 100) : 0;
            $progress     = $count > 0 ? round(($approved / $count) * 100) : 0;
            $danaEstimasi = match ($data['name']) {
                'Pendidikan' => $count * 1500000,
                'Kesehatan'  => $count * 1000000,
                'Pangan'     => $count * 500000,
                default      => $count * 2000000,
            };

            $categoriesList->push([
                'name'       => $data['name'],
                'icon'       => $data['icon'],
                'color'      => $data['color'],
                'hex'        => $data['hex'],
                'bg_hex'     => $data['bg_hex'],
                'count'      => $count,
                'percentage' => $percentage,
                'progress'   => $progress,
                'dana'       => $danaEstimasi,
            ]);
        }

        return $categoriesList;
    }

    private function getAdminRecentReports()
    {
        $reports = collect();

        try {
            $laporans = LaporanPenyalahgunaan::latest()->take(3)->get();
            foreach ($laporans as $lap) {
                $reports->push([
                    'icon'      => 'beras',
                    'judul'     => 'Laporan — ' . ($lap->lokasi_kejadian ?? 'Umum'),
                    'waktu'     => $lap->created_at ? $lap->created_at->diffForHumans() : 'Baru saja',
                    'deskripsi' => $lap->deskripsi_kejadian,
                ]);
            }
        } catch (\Exception $e) {}

        return $reports->take(3);
    }

    private function getMasyarakatRecentReports($userId)
    {
        $reports = collect();

        try {
            $laporans = LaporanPenyalahgunaan::where('user_id', $userId)->latest()->take(3)->get();
            foreach ($laporans as $lap) {
                $reports->push([
                    'icon'      => 'beras',
                    'judul'     => 'Laporan — ' . ($lap->lokasi_kejadian ?? 'Umum'),
                    'waktu'     => $lap->created_at ? $lap->created_at->diffForHumans() : 'Baru saja',
                    'deskripsi' => $lap->deskripsi_kejadian,
                ]);
            }
        } catch (\Exception $e) {}

        return $reports->take(3);
    }
}
