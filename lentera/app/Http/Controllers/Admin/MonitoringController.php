<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengajuanBantuan;
use App\Models\PendaftaranBantuan;
use Illuminate\Support\Facades\DB;

class MonitoringController extends Controller
{
    public function index(Request $request)
    {
        $isFiltered = $request->filled('start_date') || $request->filled('end_date') || $request->filled('jenis_bantuan') || $request->filled('wilayah');

        // 1. Ambil data pengajuan dari database untuk memperkaya data real-time dengan filter
        $query = PengajuanBantuan::whereIn('status_pengajuan', ['diverifikasi', 'diterima']);

        if ($request->filled('start_date')) {
            $query->where('tanggal_pengajuan', '>=', $request->input('start_date'));
        }
        if ($request->filled('end_date')) {
            $query->where('tanggal_pengajuan', '<=', $request->input('end_date'));
        }
        if ($request->filled('jenis_bantuan')) {
            $query->where('jenis_bantuan', $request->input('jenis_bantuan'));
        }
        if ($request->filled('wilayah')) {
            $wilayah = $request->input('wilayah');
            $query->whereHas('user.pendaftaran', function ($q) use ($wilayah) {
                $q->where('alamat_lengkap', 'like', "%{$wilayah}%");
            });
        }

        $realApprovedCount = $query->count();
        // Asumsi rata-rata bantuan per pengajuan disetujui adalah Rp 1.000.000 (1 Juta Rupiah)
        $realApprovedFunds = $realApprovedCount * 1000000;

        // Base total dana dari landing page: Rp 12.4 Triliun
        if ($isFiltered) {
            $totalDanaTersalurkan = $realApprovedFunds;
        } else {
            $baseTotalDana = 12400000000000;
            $totalDanaTersalurkan = $baseTotalDana + $realApprovedFunds;
        }

        if ($totalDanaTersalurkan >= 1000000000000) {
            $totalDanaTersalurkanFormatted = 'Rp ' . number_format($totalDanaTersalurkan / 1000000000000, 1, ',', '.') . ' Triliun';
        } elseif ($totalDanaTersalurkan >= 1000000000) {
            $totalDanaTersalurkanFormatted = 'Rp ' . number_format($totalDanaTersalurkan / 1000000000, 1, ',', '.') . ' Miliar';
        } else {
            $totalDanaTersalurkanFormatted = 'Rp ' . number_format($totalDanaTersalurkan, 0, ',', '.');
        }

        // 2. Data detail per kategori bantuan
        $kategoriList = ['Pendidikan', 'Kesehatan', 'Infrastruktur Desa', 'Subsidi Pangan'];
        $kategoriData = [];

        foreach ($kategoriList as $kat) {
            $totalQuery = PengajuanBantuan::where(function($q) use ($kat) {
                if ($kat === 'Pendidikan') {
                    $q->where('jenis_bantuan', 'like', '%didik%')->orWhere('jenis_bantuan', 'like', '%sekolah%');
                } elseif ($kat === 'Kesehatan') {
                    $q->where('jenis_bantuan', 'like', '%sehat%')->orWhere('jenis_bantuan', 'like', '%medis%');
                } elseif ($kat === 'Infrastruktur Desa') {
                    $q->where('jenis_bantuan', 'like', '%desa%')->orWhere('jenis_bantuan', 'like', '%infra%');
                } elseif ($kat === 'Subsidi Pangan') {
                    $q->where('jenis_bantuan', 'like', '%pangan%')->orWhere('jenis_bantuan', 'like', '%sembako%');
                } else {
                    $q->where('jenis_bantuan', 'like', "%{$kat}%");
                }
            });

            $approvedQuery = PengajuanBantuan::whereIn('status_pengajuan', ['diverifikasi', 'diterima'])
                ->where(function($q) use ($kat) {
                    if ($kat === 'Pendidikan') {
                        $q->where('jenis_bantuan', 'like', '%didik%')->orWhere('jenis_bantuan', 'like', '%sekolah%');
                    } elseif ($kat === 'Kesehatan') {
                        $q->where('jenis_bantuan', 'like', '%sehat%')->orWhere('jenis_bantuan', 'like', '%medis%');
                    } elseif ($kat === 'Infrastruktur Desa') {
                        $q->where('jenis_bantuan', 'like', '%desa%')->orWhere('jenis_bantuan', 'like', '%infra%');
                    } elseif ($kat === 'Subsidi Pangan') {
                        $q->where('jenis_bantuan', 'like', '%pangan%')->orWhere('jenis_bantuan', 'like', '%sembako%');
                    } else {
                        $q->where('jenis_bantuan', 'like', "%{$kat}%");
                    }
                });

            if ($request->filled('start_date')) {
                $totalQuery->where('tanggal_pengajuan', '>=', $request->input('start_date'));
                $approvedQuery->where('tanggal_pengajuan', '>=', $request->input('start_date'));
            }
            if ($request->filled('end_date')) {
                $totalQuery->where('tanggal_pengajuan', '<=', $request->input('end_date'));
                $approvedQuery->where('tanggal_pengajuan', '<=', $request->input('end_date'));
            }
            if ($request->filled('jenis_bantuan')) {
                $totalQuery->where('jenis_bantuan', $request->input('jenis_bantuan'));
                $approvedQuery->where('jenis_bantuan', $request->input('jenis_bantuan'));
            }
            if ($request->filled('wilayah')) {
                $wilayah = $request->input('wilayah');
                $totalQuery->whereHas('user.pendaftaran', function ($q) use ($wilayah) {
                    $q->where('alamat_lengkap', 'like', "%{$wilayah}%");
                });
                $approvedQuery->whereHas('user.pendaftaran', function ($q) use ($wilayah) {
                    $q->where('alamat_lengkap', 'like', "%{$wilayah}%");
                });
            }

            $totalCount = $totalQuery->count();
            $approvedCount = $approvedQuery->count();

            if ($isFiltered) {
                $pagu = max(1, $totalCount) * 1500000;
                $realisasi = $approvedCount * 1000000;
                $sisa = max(0, $pagu - $realisasi);
                $persentase = round(($realisasi / $pagu) * 100);
            } else {
                $basePagu = [
                    'Pendidikan' => 4200000000000,
                    'Kesehatan' => 3500000000000,
                    'Infrastruktur Desa' => 2900000000000,
                    'Subsidi Pangan' => 1800000000000
                ];
                $baseRealisasi = [
                    'Pendidikan' => 3570000000000,
                    'Kesehatan' => 2520000000000,
                    'Infrastruktur Desa' => 1392000000000,
                    'Subsidi Pangan' => 1620000000000
                ];

                $pagu = $basePagu[$kat];
                $realisasi = $baseRealisasi[$kat] + ($approvedCount * 1000000);
                $sisa = max(0, $pagu - $realisasi);
                $persentase = round(($realisasi / $pagu) * 100);
            }

            $kategoriData[$kat] = [
                'nama' => $kat,
                'pagu' => $pagu,
                'realisasi' => $realisasi,
                'sisa' => $sisa,
                'persentase' => $persentase,
            ];
        }

        // 3. Data Distribusi Wilayah (Desa di Jawa Barat)
        $baseWilayah = [
            'Desa Bojongsoang' => ['kabupaten' => 'Bandung', 'pagu' => 223400000000, 'realisasi' => 210000000000, 'lat' => -6.9744, 'lon' => 107.6369],
            'Desa Lengkong' => ['kabupaten' => 'Bandung', 'pagu' => 170400000000, 'realisasi' => 150000000000, 'lat' => -6.9271, 'lon' => 107.6214],
            'Desa Cipagalo' => ['kabupaten' => 'Bandung', 'pagu' => 206500000000, 'realisasi' => 190000000000, 'lat' => -6.9669, 'lon' => 107.6433],
            'Desa Bojongsari' => ['kabupaten' => 'Bandung', 'pagu' => 153800000000, 'realisasi' => 120000000000, 'lat' => -6.9681, 'lon' => 107.6775],
            'Desa Buahbatu' => ['kabupaten' => 'Bandung', 'pagu' => 155500000000, 'realisasi' => 70000000000, 'lat' => -6.9458, 'lon' => 107.6483],
            'Desa Tegalluar' => ['kabupaten' => 'Bandung', 'pagu' => 97500000000, 'realisasi' => 80000000000, 'lat' => -6.9688, 'lon' => 107.6894],
        ];

        $approvedSubmissions = $query->get();
        $dbWilayahCounts = [];
        $dbWilayahTotals = [];

        foreach ($baseWilayah as $prov => $info) {
            $dbWilayahCounts[$prov] = 0;
            $dbWilayahTotals[$prov] = 0;
        }

        foreach ($approvedSubmissions as $sub) {
            $alamat = $sub->user?->pendaftaran?->alamat_lengkap ?? '';
            $prov = $this->getVillageFromAddress($alamat);
            if (isset($dbWilayahCounts[$prov])) {
                $dbWilayahCounts[$prov]++;
            }
        }

        $totalSubmissionsQuery = PengajuanBantuan::query();
        if ($request->filled('start_date')) {
            $totalSubmissionsQuery->where('tanggal_pengajuan', '>=', $request->input('start_date'));
        }
        if ($request->filled('end_date')) {
            $totalSubmissionsQuery->where('tanggal_pengajuan', '<=', $request->input('end_date'));
        }
        if ($request->filled('jenis_bantuan')) {
            $totalSubmissionsQuery->where('jenis_bantuan', $request->input('jenis_bantuan'));
        }
        if ($request->filled('wilayah')) {
            $wilayah = $request->input('wilayah');
            $totalSubmissionsQuery->whereHas('user.pendaftaran', function ($q) use ($wilayah) {
                $q->where('alamat_lengkap', 'like', "%{$wilayah}%");
            });
        }
        $totalSubmissions = $totalSubmissionsQuery->get();

        foreach ($totalSubmissions as $sub) {
            $alamat = $sub->user?->pendaftaran?->alamat_lengkap ?? '';
            $prov = $this->getVillageFromAddress($alamat);
            if (isset($dbWilayahTotals[$prov])) {
                $dbWilayahTotals[$prov]++;
            }
        }

        $wilayahData = [];
        foreach ($baseWilayah as $prov => $info) {
            if ($isFiltered) {
                $pagu = max(1, $dbWilayahTotals[$prov]) * 1500000;
                $realisasi = $dbWilayahCounts[$prov] * 1000000;
                $persentase = round(($realisasi / $pagu) * 100);
            } else {
                $pagu = $info['pagu'];
                $realisasi = $info['realisasi'] + ($dbWilayahCounts[$prov] * 1000000);
                $persentase = round(($realisasi / $pagu) * 100);
            }

            $status = 'Rendah';
            if ($persentase >= 80) $status = 'Optimal';
            elseif ($persentase >= 50) $status = 'Moderat';

            $wilayahData[] = [
                'desa' => $prov,
                'kabupaten' => $info['kabupaten'],
                'pagu' => $pagu,
                'realisasi' => $realisasi,
                'persentase' => $persentase,
                'status' => $status,
                'latitude' => $info['lat'],
                'longitude' => $info['lon']
            ];
        }

        // 4. Data perbandingan bulanan (Mei 2026 vs April 2026)
        $chartBulanan = [
            'Mei' => ['W1' => 0, 'W2' => 0, 'W3' => 0, 'W4' => 0, 'total' => 0],
            'April' => ['W1' => 0, 'W2' => 0, 'W3' => 0, 'W4' => 0, 'total' => 0]
        ];

        $meiQuery = PengajuanBantuan::whereIn('status_pengajuan', ['diverifikasi', 'diterima'])
            ->whereBetween('tanggal_pengajuan', ['2026-05-01', '2026-05-31']);
        
        $aprilQuery = PengajuanBantuan::whereIn('status_pengajuan', ['diverifikasi', 'diterima'])
            ->whereBetween('tanggal_pengajuan', ['2026-04-01', '2026-04-30']);

        if ($request->filled('jenis_bantuan')) {
            $meiQuery->where('jenis_bantuan', $request->input('jenis_bantuan'));
            $aprilQuery->where('jenis_bantuan', $request->input('jenis_bantuan'));
        }
        if ($request->filled('wilayah')) {
            $wilayah = $request->input('wilayah');
            $meiQuery->whereHas('user.pendaftaran', function ($q) use ($wilayah) {
                $q->where('alamat_lengkap', 'like', "%{$wilayah}%");
            });
            $aprilQuery->whereHas('user.pendaftaran', function ($q) use ($wilayah) {
                $q->where('alamat_lengkap', 'like', "%{$wilayah}%");
            });
        }

        $meiRecords = $meiQuery->get();
        $aprilRecords = $aprilQuery->get();

        foreach ($meiRecords as $rec) {
            $w = $this->getWeekOfMonth($rec->tanggal_pengajuan);
            $chartBulanan['Mei'][$w] += 1000000;
        }
        foreach ($aprilRecords as $rec) {
            $w = $this->getWeekOfMonth($rec->tanggal_pengajuan);
            $chartBulanan['April'][$w] += 1000000;
        }

        if (!$isFiltered) {
            $chartBulanan['Mei']['W1'] += 2800000000000;
            $chartBulanan['Mei']['W2'] += 3100000000000;
            $chartBulanan['Mei']['W3'] += 3700000000000;
            $chartBulanan['Mei']['W4'] += 2800000000000;

            $chartBulanan['April']['W1'] += 2500000000000;
            $chartBulanan['April']['W2'] += 2600000000000;
            $chartBulanan['April']['W3'] += 3200000000000;
            $chartBulanan['April']['W4'] += 2500000000000;
        }

        $chartBulanan['Mei']['total'] = array_sum(array_slice($chartBulanan['Mei'], 0, 4));
        $chartBulanan['April']['total'] = array_sum(array_slice($chartBulanan['April'], 0, 4));

        $totalMei = $chartBulanan['Mei']['total'];
        $totalApril = $chartBulanan['April']['total'];

        if ($totalMei >= 1000000000000) {
            $totalMeiFormatted = 'Rp ' . number_format($totalMei / 1000000000000, 1, ',', '.') . 'T';
        } elseif ($totalMei >= 1000000000) {
            $totalMeiFormatted = 'Rp ' . number_format($totalMei / 1000000000, 1, ',', '.') . 'M';
        } else {
            $totalMeiFormatted = 'Rp ' . number_format($totalMei, 0, ',', '.');
        }

        if ($totalApril >= 1000000000000) {
            $totalAprilFormatted = 'Rp ' . number_format($totalApril / 1000000000000, 1, ',', '.') . 'T';
        } elseif ($totalApril >= 1000000000) {
            $totalAprilFormatted = 'Rp ' . number_format($totalApril / 1000000000, 1, ',', '.') . 'M';
        } else {
            $totalAprilFormatted = 'Rp ' . number_format($totalApril, 0, ',', '.');
        }

        // 5. Indeks Transparansi
        $totalSubmittedQuery = PengajuanBantuan::query();
        if ($request->filled('start_date')) {
            $totalSubmittedQuery->where('tanggal_pengajuan', '>=', $request->input('start_date'));
        }
        if ($request->filled('end_date')) {
            $totalSubmittedQuery->where('tanggal_pengajuan', '<=', $request->input('end_date'));
        }
        if ($request->filled('jenis_bantuan')) {
            $totalSubmittedQuery->where('jenis_bantuan', $request->input('jenis_bantuan'));
        }
        if ($request->filled('wilayah')) {
            $wilayah = $request->input('wilayah');
            $totalSubmittedQuery->whereHas('user.pendaftaran', function ($q) use ($wilayah) {
                $q->where('alamat_lengkap', 'like', "%{$wilayah}%");
            });
        }

        $allSubCount = $totalSubmittedQuery->count();
        $approvedSubCount = $query->count();

        if ($allSubCount > 0) {
            $transparencyIndex = round(($approvedSubCount / $allSubCount) * 100);
            $transparencyIndex = max(50, min(100, $transparencyIndex));
        } else {
            $transparencyIndex = 88;
        }

        if ($transparencyIndex >= 85) {
            $transparencyStatus = 'Kategori Sangat Transparan';
        } elseif ($transparencyIndex >= 70) {
            $transparencyStatus = 'Kategori Transparan';
        } else {
            $transparencyStatus = 'Kategori Cukup Transparan';
        }

        // Determine chart scale and unit based on max value in chartBulanan
        $maxVal = max(
            $chartBulanan['Mei']['W1'],
            $chartBulanan['Mei']['W2'],
            $chartBulanan['Mei']['W3'],
            $chartBulanan['Mei']['W4'],
            $chartBulanan['April']['W1'],
            $chartBulanan['April']['W2'],
            $chartBulanan['April']['W3'],
            $chartBulanan['April']['W4']
        );

        if ($maxVal >= 1000000000000) {
            $chartScale = 1000000000000;
            $chartUnit = 'T';
        } elseif ($maxVal >= 1000000000) {
            $chartScale = 1000000000;
            $chartUnit = 'M';
        } elseif ($maxVal >= 1000000) {
            $chartScale = 1000000;
            $chartUnit = 'Jt';
        } else {
            $chartScale = 1;
            $chartUnit = '';
        }

        return view('admin.monitoring', compact(
            'totalDanaTersalurkan',
            'totalDanaTersalurkanFormatted',
            'kategoriData',
            'wilayahData',
            'chartBulanan',
            'totalMeiFormatted',
            'totalAprilFormatted',
            'transparencyIndex',
            'transparencyStatus',
            'chartScale',
            'chartUnit'
        ));
    }

    private function getVillageFromAddress($alamat)
    {
        $alamat = strtolower($alamat);
        if (str_contains($alamat, 'bojongsoang')) {
            return 'Desa Bojongsoang';
        }
        if (str_contains($alamat, 'lengkong')) {
            return 'Desa Lengkong';
        }
        if (str_contains($alamat, 'cipagalo')) {
            return 'Desa Cipagalo';
        }
        if (str_contains($alamat, 'bojongsari')) {
            return 'Desa Bojongsari';
        }
        if (str_contains($alamat, 'buahbatu')) {
            return 'Desa Buahbatu';
        }
        if (str_contains($alamat, 'tegalluar')) {
            return 'Desa Tegalluar';
        }
        
        $villages = [
            'Desa Bojongsoang', 'Desa Lengkong', 'Desa Cipagalo', 
            'Desa Bojongsari', 'Desa Buahbatu', 'Desa Tegalluar'
        ];
        $index = abs(crc32($alamat)) % count($villages);
        return $villages[$index];
    }

    private function getWeekOfMonth($dateStr)
    {
        $day = (int) date('d', strtotime($dateStr));
        if ($day <= 7) return 'W1';
        if ($day <= 14) return 'W2';
        if ($day <= 21) return 'W3';
        return 'W4';
    }
}

