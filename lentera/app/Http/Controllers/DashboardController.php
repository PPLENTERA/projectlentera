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
        
        $rataRataScore = Recipient::avg('score') ?? 84.2;
        $totalBantuan = 4200000000;

        // Mock data for charts
        $perWilayah = collect([['wilayah' => 'Jakarta Pusat', 'total' => 120]]);
        $category = collect([['program' => 'Pendidikan', 'total' => 45]]);
        $recent = collect();

        return view('admin.dashboard', compact(
            'totalPengajuan', 
            'totalDisetujui', 
            'sedangMengajukan', 
            'totalDitolak', 
            'rataRataScore', 
            'totalBantuan', 
            'perWilayah', 
            'category', 
            'recent'
        ));
    }

    public function masyarakatDashboard()
    {
        $totalBantuan = 4250000; 
        $pengajuanPending = PengajuanBantuan::where('status_pengajuan', 'Pending')->count();
        $disetujui = PengajuanBantuan::where('status_pengajuan', 'Disetujui')->count();
        $ditolak = PengajuanBantuan::where('status_pengajuan', 'Ditolak')->count();
        
        $perWilayah = collect();
        $category = collect();
        $recent = collect();

        return view('masyarakat.dashboard', compact(
            'totalBantuan', 
            'pengajuanPending', 
            'disetujui', 
            'ditolak', 
            'perWilayah', 
            'category', 
            'recent'
        ));
    }
}
