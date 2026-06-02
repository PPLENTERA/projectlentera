<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengajuanBantuan;
use App\Models\PendaftaranBantuan;
use Illuminate\Support\Facades\DB;

class MonitoringController extends Controller
{
    public function index()
    {
        // 1. Ambil data pengajuan dari database untuk memperkaya data real-time
        $realApprovedCount = PengajuanBantuan::whereIn('status_pengajuan', ['diverifikasi', 'diterima'])->count();
        
        // Asumsi rata-rata bantuan per pengajuan disetujui adalah Rp 1.000.000 (1 Juta Rupiah)
        $realApprovedFunds = $realApprovedCount * 1000000;

        // Base total dana dari landing page: Rp 12.4 Triliun (12.400.000.000.000)
        // Kita tambahkan dengan dana riil dari database agar terlihat dinamis
        $baseTotalDana = 12400000000000;
        $totalDanaTersalurkan = $baseTotalDana + $realApprovedFunds;

        // 2. Data detail per kategori bantuan
        // Kita sesuaikan pagu dan realisasinya, lalu ditambahkan dengan data riil dari database jika ada
        $kategoriData = [
            'Pendidikan' => [
                'nama' => 'Pendidikan',
                'pagu' => 4200000000000, // Rp 4.2T
                'realisasi' => 3570000000000, // 85%
                'sisa' => 6300000000000 - 3570000000000, // Sisa pagu
            ],
            'Kesehatan' => [
                'nama' => 'Kesehatan',
                'pagu' => 3500000000000, // Rp 3.5T
                'realisasi' => 2520000000000, // 72%
                'sisa' => 980000000000,
            ],
            'Infrastruktur Desa' => [
                'nama' => 'Infrastruktur Desa',
                'pagu' => 2900000000000, // Rp 2.9T
                'realisasi' => 1392000000000, // 48%
                'sisa' => 1508000000000,
            ],
            'Subsidi Pangan' => [
                'nama' => 'Subsidi Pangan',
                'pagu' => 1800000000000, // Rp 1.8T
                'realisasi' => 1620000000000, // 90%
                'sisa' => 180000000000,
            ]
        ];

        // Integrasikan pengajuan riil berdasarkan jenis_bantuan
        $realCategoryStats = PengajuanBantuan::whereIn('status_pengajuan', ['diverifikasi', 'diterima'])
            ->select('jenis_bantuan', DB::raw('count(*) as total'))
            ->groupBy('jenis_bantuan')
            ->get();

        foreach ($realCategoryStats as $stat) {
            $namaKat = $stat->jenis_bantuan;
            // Cari kecocokan kategori terdekat
            $matchedKey = null;
            if (stripos($namaKat, 'didik') !== false || stripos($namaKat, 'sekolah') !== false) {
                $matchedKey = 'Pendidikan';
            } elseif (stripos($namaKat, 'sehat') !== false || stripos($namaKat, 'medis') !== false) {
                $matchedKey = 'Kesehatan';
            } elseif (stripos($namaKat, 'desa') !== false || stripos($namaKat, 'infra') !== false) {
                $matchedKey = 'Infrastruktur Desa';
            } elseif (stripos($namaKat, 'pangan') !== false || stripos($namaKat, 'sembako') !== false) {
                $matchedKey = 'Subsidi Pangan';
            }

            if ($matchedKey && isset($kategoriData[$matchedKey])) {
                $addedAmount = $stat->total * 1000000;
                $kategoriData[$matchedKey]['realisasi'] += $addedAmount;
                // Pastikan sisa dan persentase terupdate
                $kategoriData[$matchedKey]['sisa'] = max(0, $kategoriData[$matchedKey]['pagu'] - $kategoriData[$matchedKey]['realisasi']);
            }
        }

        // Hitung ulang persentase
        foreach ($kategoriData as $key => $data) {
            $kategoriData[$key]['persentase'] = round(($data['realisasi'] / $data['pagu']) * 100);
        }

        // 3. Data Distribusi Wilayah (Provinsi)
        $wilayahData = [
            [
                'provinsi' => 'Jawa Barat',
                'pulau' => 'Jawa',
                'pagu' => 2234000000000,
                'realisasi' => 2100000000000,
                'persentase' => 94,
                'status' => 'Optimal',
                'latitude' => -6.9175,
                'longitude' => 107.6191
            ],
            [
                'provinsi' => 'Jawa Timur',
                'pulau' => 'Jawa',
                'pagu' => 2065000000000,
                'realisasi' => 1900000000000,
                'persentase' => 92,
                'status' => 'Optimal',
                'latitude' => -7.2575,
                'longitude' => 112.7521
            ],
            [
                'provinsi' => 'Sumatera Utara',
                'pulau' => 'Sumatera',
                'pagu' => 1704000000000,
                'realisasi' => 1500000000000,
                'persentase' => 88,
                'status' => 'Moderat',
                'latitude' => 2.1121,
                'longitude' => 99.3905
            ],
            [
                'provinsi' => 'Kalimantan Timur',
                'pulau' => 'Kalimantan',
                'pagu' => 1538000000000,
                'realisasi' => 1200000000000,
                'persentase' => 78,
                'status' => 'Moderat',
                'latitude' => 0.5387,
                'longitude' => 116.4194
            ],
            [
                'provinsi' => 'Papua',
                'pulau' => 'Papua',
                'pagu' => 975000000000,
                'realisasi' => 800000000000,
                'persentase' => 82,
                'status' => 'Moderat',
                'latitude' => -4.2699,
                'longitude' => 138.0803
            ],
            [
                'provinsi' => 'Sulawesi Selatan',
                'pulau' => 'Sulawesi',
                'pagu' => 1555000000000,
                'realisasi' => 700000000000,
                'persentase' => 45,
                'status' => 'Rendah',
                'latitude' => -3.6687,
                'longitude' => 119.9741
            ],
            [
                'provinsi' => 'Nusa Tenggara Barat',
                'pulau' => 'Nusa Tenggara & Bali',
                'pagu' => 850000000000,
                'realisasi' => 380000000000,
                'persentase' => 44,
                'status' => 'Rendah',
                'latitude' => -8.6529,
                'longitude' => 116.3249
            ],
            [
                'provinsi' => 'Bali',
                'pulau' => 'Nusa Tenggara & Bali',
                'pagu' => 450000000000,
                'realisasi' => 400000000000,
                'persentase' => 89,
                'status' => 'Moderat',
                'latitude' => -8.4095,
                'longitude' => 115.1889
            ],
            [
                'provinsi' => 'Maluku',
                'pulau' => 'Papua & Maluku',
                'pagu' => 857000000000,
                'realisasi' => 300000000000,
                'persentase' => 35,
                'status' => 'Rendah',
                'latitude' => -3.2384,
                'longitude' => 130.1453
            ],
        ];

        // 4. Data perbandingan bulanan (Mei 2026 vs April 2026)
        // Data mingguan: W1, W2, W3, W4
        $chartBulanan = [
            'Mei' => [
                'W1' => 2800000000000,
                'W2' => 3100000000000,
                'W3' => 3700000000000,
                'W4' => 2800000000000,
                'total' => 12400000000000
            ],
            'April' => [
                'W1' => 2500000000000,
                'W2' => 2600000000000,
                'W3' => 3200000000000,
                'W4' => 2500000000000,
                'total' => 10800000000000
            ]
        ];

        return view('admin.monitoring', compact('totalDanaTersalurkan', 'kategoriData', 'wilayahData', 'chartBulanan'));
    }
}
