<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        $pengajuan = collect([
            [
                'id_pengajuan' => 1,
                'user' => ['nama' => 'Budi Santoso', 'alamat' => 'Jakarta Pusat'],
                'jenis_bantuan' => 'Pendidikan',
                'jumlah_tanggungan' => 4,
                'status_pengajuan' => 'Disetujui',
                'tanggal_pengajuan' => '2026-04-01',
                'nominal' => 1250000,
            ],
            [
                'id_pengajuan' => 2,
                'user' => ['nama' => 'Sari Rahma', 'alamat' => 'Jakarta Barat'],
                'jenis_bantuan' => 'Kesehatan',
                'jumlah_tanggungan' => 3,
                'status_pengajuan' => 'Pending',
                'tanggal_pengajuan' => '2026-04-03',
                'nominal' => 850000,
            ],
            [
                'id_pengajuan' => 3,
                'user' => ['nama' => 'Andi Pratama', 'alamat' => 'Jakarta Utara'],
                'jenis_bantuan' => 'Pangan',
                'jumlah_tanggungan' => 5,
                'status_pengajuan' => 'Disetujui',
                'tanggal_pengajuan' => '2026-04-05',
                'nominal' => 920000,
            ],
            [
                'id_pengajuan' => 4,
                'user' => ['nama' => 'Rina Dewi', 'alamat' => 'Jakarta Selatan'],
                'jenis_bantuan' => 'Pendidikan',
                'jumlah_tanggungan' => 2,
                'status_pengajuan' => 'Selesai',
                'tanggal_pengajuan' => '2026-04-06',
                'nominal' => 700000,
            ],
        ]);

        $summary = [
            'total_bantuan' => $pengajuan->sum('nominal'),
            'pending' => $pengajuan->where('status_pengajuan', 'Pending')->count(),
            'program_count' => $pengajuan->pluck('jenis_bantuan')->unique()->count(),
            'wilayah_count' => $pengajuan->pluck('user.alamat')->unique()->count(),
        ];

        $perWilayah = $pengajuan
            ->groupBy('user.alamat')
            ->map(fn ($items, $alamat) => [
                'wilayah' => $alamat,
                'total' => $items->count(),
            ])
            ->values();

        $category = $pengajuan
            ->groupBy('jenis_bantuan')
            ->map(fn ($items, $program) => [
                'program' => $program,
                'total' => $items->count(),
            ])
            ->values();

        $recent = $pengajuan->sortByDesc('tanggal_pengajuan')->values()->take(4);

        return view('admin.dashboard', compact('summary', 'perWilayah', 'category', 'recent'));
    }
}
