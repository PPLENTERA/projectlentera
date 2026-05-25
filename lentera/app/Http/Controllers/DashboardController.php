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
        $totalPengajuan = PengajuanBantuan::count();
        $totalDisetujui = PengajuanBantuan::where('status_pengajuan', 'Disetujui')->count();
        $sedangMengajukan = PengajuanBantuan::where('status_pengajuan', 'Pending')->count();
        $totalDitolak = PengajuanBantuan::where('status_pengajuan', 'Ditolak')->count();
        
        $rataRataScore = Recipient::avg('score') ?? 0;
        $totalBantuan = PengajuanBantuan::where('status_pengajuan', 'Disetujui')->count() * 500000; // Contoh kalkulasi total real

        // Query real data from database for perWilayah
        $pendaftaran = \App\Models\PendaftaranBantuan::all();
        $villages = [
            'Bojongsoang' => 'Desa Bojongsoang',
            'Bojongsari' => 'Desa Bojongsari',
            'Buahbatu' => 'Desa Buahbatu',
            'Cipagalo' => 'Desa Cipagalo',
            'Lengkong' => 'Desa Lengkong',
            'Tegalluar' => 'Desa Tegalluar'
        ];

        // Initialize all villages with 0 so they appear on the chart even if empty
        foreach ($villages as $key => $name) {
            $wilayahCounts[$name] = 0;
        }
        
        foreach ($pendaftaran as $p) {
            $alamat = strtoupper($p->alamat_lengkap);
            foreach ($villages as $key => $name) {
                // Check if the address contains the village name
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

        $recent = $this->getRecentReports();
        $categoriesList = $this->getCategoriesData();

        return view('admin.dashboard', compact(
            'totalPengajuan', 
            'totalDisetujui', 
            'sedangMengajukan', 
            'totalDitolak', 
            'rataRataScore', 
            'totalBantuan', 
            'perWilayah', 
            'recent',
            'categoriesList'
        ));
    }

    public function masyarakatDashboard()
    {
        $totalBantuan = PengajuanBantuan::where('status_pengajuan', 'Disetujui')->count() * 500000; 
        $pengajuanPending = PengajuanBantuan::where('status_pengajuan', 'Pending')->count();
        $disetujui = PengajuanBantuan::where('status_pengajuan', 'Disetujui')->count();
        $ditolak = PengajuanBantuan::where('status_pengajuan', 'Ditolak')->count();
        
        // Query real data for penyaluran bulanan
        $pengajuan = PengajuanBantuan::where('status_pengajuan', 'Disetujui')
                        ->orWhere('status_pengajuan', 'diterima')
                        ->orWhere('status_pengajuan', 'diverifikasi')
                        ->get();

        $grouped = $pengajuan->groupBy(function($date) {
            return \Carbon\Carbon::parse($date->tanggal_pengajuan)->format('M'); // e.g. 'Jan'
        });

        $penyaluranBulanan = collect();
        foreach (['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'] as $month) {
            $monthData = $grouped->get($month, collect());
            
            // Pencarian case-insensitive untuk jenis_bantuan
            $tunai = $monthData->filter(fn($q) => stripos($q->jenis_bantuan, 'Tunai') !== false)->count() * 500000;
            $sembako = $monthData->filter(fn($q) => stripos($q->jenis_bantuan, 'Sembako') !== false)->count() * 300000;
            
            $penyaluranBulanan->push([
                'bulan' => strtoupper($month),
                'dana_tunai' => $tunai,
                'sembako' => $sembako
            ]);
        }

        $recent = $this->getRecentReports();
        $categoriesList = $this->getCategoriesData();

        return view('masyarakat.dashboard', compact(
            'totalBantuan', 
            'pengajuanPending', 
            'disetujui', 
            'ditolak', 
            'penyaluranBulanan', 
            'recent',
            'categoriesList'
        ));
    }

    private function getCategoriesData()
    {
        $allPengajuan = PengajuanBantuan::all();
        
        $categoriesData = [
            'Bantuan Pendidikan' => [
                'name' => 'Pendidikan',
                'icon' => 'academic-cap',
                'color' => 'blue',
                'hex' => '#3b82f6',
                'bg_hex' => '#eff6ff',
                'count' => 0,
                'approved' => 0,
            ],
            'Bantuan Kesehatan' => [
                'name' => 'Kesehatan',
                'icon' => 'heart',
                'color' => 'emerald',
                'hex' => '#10b981',
                'bg_hex' => '#ecfdf5',
                'count' => 0,
                'approved' => 0,
            ],
            'Bantuan Pangan' => [
                'name' => 'Pangan',
                'icon' => 'shopping-bag',
                'color' => 'amber',
                'hex' => '#f59e0b',
                'bg_hex' => '#fffbeb',
                'count' => 0,
                'approved' => 0,
            ],
            'Bantuan Perumahan' => [
                'name' => 'Perumahan',
                'icon' => 'home',
                'color' => 'purple',
                'hex' => '#8b5cf6',
                'bg_hex' => '#f5f3ff',
                'count' => 0,
                'approved' => 0,
            ],
        ];

        foreach ($allPengajuan as $p) {
            $cat = $p->jenis_bantuan;
            if (stripos($cat, 'Pendidikan') !== false) {
                $key = 'Bantuan Pendidikan';
            } elseif (stripos($cat, 'Kesehatan') !== false) {
                $key = 'Bantuan Kesehatan';
            } elseif (stripos($cat, 'Pangan') !== false) {
                $key = 'Bantuan Pangan';
            } elseif (stripos($cat, 'Perumahan') !== false) {
                $key = 'Bantuan Perumahan';
            } else {
                continue;
            }

            $categoriesData[$key]['count']++;
            if (in_array(strtolower($p->status_pengajuan), ['diverifikasi', 'diterima', 'disetujui'])) {
                $categoriesData[$key]['approved']++;
            }
        }

        $totalCount = $allPengajuan->count();
        $categoriesList = collect();

        foreach ($categoriesData as $key => $data) {
            $count = $data['count'];
            $approved = $data['approved'];
            
            $percentage = $totalCount > 0 ? round(($count / $totalCount) * 100) : 0;
            $progress = $count > 0 ? round(($approved / $count) * 100) : 0;

            $danaEstimasi = 0;
            if ($data['name'] === 'Pendidikan') {
                $danaEstimasi = $count * 1500000;
            } elseif ($data['name'] === 'Kesehatan') {
                $danaEstimasi = $count * 1000000;
            } elseif ($data['name'] === 'Pangan') {
                $danaEstimasi = $count * 500000;
            } else {
                $danaEstimasi = $count * 2000000;
            }

            $categoriesList->push([
                'name' => $data['name'],
                'icon' => $data['icon'],
                'color' => $data['color'],
                'hex' => $data['hex'],
                'bg_hex' => $data['bg_hex'],
                'count' => $count,
                'percentage' => $percentage,
                'progress' => $progress,
                'dana' => $danaEstimasi
            ]);
        }

        return $categoriesList;
    }

    private function getRecentReports()
    {
        $reports = collect();

        // 1. Fetch real LaporanPenyalahgunaan
        try {
            $laporans = LaporanPenyalahgunaan::latest()->take(3)->get();
            foreach ($laporans as $lap) {
                $reports->push([
                    'icon' => 'beras',
                    'judul' => 'Laporan Kejadian - ' . ($lap->lokasi_kejadian ?? 'Umum'),
                    'waktu' => $lap->created_at ? $lap->created_at->diffForHumans() : 'Baru saja',
                    'deskripsi' => $lap->deskripsi_kejadian
                ]);
            }
        } catch (\Exception $e) {
        }

        // 2. Fetch real Feedback
        try {
            $feedbacks = Feedback::latest()->take(3)->get();
            foreach ($feedbacks as $fb) {
                $reports->push([
                    'icon' => 'buku',
                    'judul' => 'Masukan dari ' . ($fb->nama_lengkap ?? 'Masyarakat'),
                    'waktu' => $fb->created_at ? $fb->created_at->diffForHumans() : 'Baru saja',
                    'deskripsi' => $fb->deskripsi_masukan
                ]);
            }
        } catch (\Exception $e) {
        }

        // 3. Fallback to real PengajuanBantuan if reports & feedback are empty
        if ($reports->isEmpty()) {
            try {
                $latestPengajuan = PengajuanBantuan::with('user')->latest()->take(3)->get();
                foreach ($latestPengajuan as $p) {
                    $reports->push([
                        'icon' => 'kesehatan',
                        'judul' => 'Pengajuan ' . $p->jenis_bantuan,
                        'waktu' => $p->created_at ? $p->created_at->diffForHumans() : 'Baru saja',
                        'deskripsi' => 'Pengajuan baru dari ' . ($p->user->name ?? 'Verified Citizen') . ' dengan total tanggungan ' . $p->jumlah_tanggungan
                    ]);
                }
            } catch (\Exception $e) {
            }
        }

        return $reports->take(3);
    }
}
