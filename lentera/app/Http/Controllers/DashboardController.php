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

        $pengajuanTerbaru = PengajuanBantuan::where('id_users', $userId)
            ->with('validasi')
            ->latest()
            ->take(3)
            ->get();

        $pengajuan = PengajuanBantuan::whereIn('status_pengajuan', ['diverifikasi', 'diterima'])->get();

        $grouped = $pengajuan->groupBy(function ($date) {
            return \Carbon\Carbon::parse($date->tanggal_pengajuan)->format('M');
        });

        $penyaluranBulanan = collect();
        foreach (['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'] as $month) {
            $monthData = $grouped->get($month, collect());
            
            // Map types of received assistance:
            // Tunai includes Kesehatan, Pendidikan, Perumahan
            $tunai = $monthData->filter(fn($q) => 
                stripos($q->jenis_bantuan, 'Kesehatan') !== false || 
                stripos($q->jenis_bantuan, 'Pendidikan') !== false ||
                stripos($q->jenis_bantuan, 'Perumahan') !== false
            )->count() * 500000;
            
            // Sembako includes Pangan
            $sembako = $monthData->filter(fn($q) => 
                stripos($q->jenis_bantuan, 'Pangan') !== false
            )->count() * 300000;

            $penyaluranBulanan->push([
                'bulan'      => strtoupper($month),
                'dana_tunai' => $tunai,
                'sembako'    => $sembako,
            ]);
        }

        $recent         = $this->getMasyarakatRecentReports($userId);
        $categoriesList = $this->getCategoriesData(true);
        $authUser       = Auth::user();

        return view('masyarakat.dashboard', compact(
            'totalBantuan',
            'pengajuanPending',
            'disetujui',
            'ditolak',
            'penyaluranBulanan',
            'recent',
            'categoriesList',
            'pendaftaranUser',
            'pengajuanTerbaru',
            'authUser'
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
