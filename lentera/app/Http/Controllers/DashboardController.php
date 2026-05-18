<?php

namespace App\Http\Controllers;

use App\Models\PengajuanBantuan;
use App\Models\Recipient;
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

        $recent = collect();

        return view('admin.dashboard', compact(
            'totalPengajuan', 
            'totalDisetujui', 
            'sedangMengajukan', 
            'totalDitolak', 
            'rataRataScore', 
            'totalBantuan', 
            'perWilayah', 
            'recent'
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

        $recent = collect(); // Real implementation should fetch from Laporan/Feedback real tables

        return view('masyarakat.dashboard', compact(
            'totalBantuan', 
            'pengajuanPending', 
            'disetujui', 
            'ditolak', 
            'penyaluranBulanan', 
            'recent'
        ));
    }
}
