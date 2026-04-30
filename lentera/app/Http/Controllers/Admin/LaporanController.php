<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LaporanPenyalahgunaan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Menampilkan daftar semua laporan penyalahgunaan.
     */
    public function index()
    {
        // Mengambil semua laporan beserta relasi user pengirim
        $laporan = LaporanPenyalahgunaan::with('user')
            ->latest()
            ->get();

        // Mengambil statistik laporan per wilayah (10 teratas)
        $statistikWilayah = LaporanPenyalahgunaan::select('lokasi_kejadian', \DB::raw('count(*) as total'))
            ->groupBy('lokasi_kejadian')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        return view('admin.laporan.index', compact('laporan', 'statistikWilayah'));
    }

    /**
     * Menampilkan detail dari sebuah laporan.
     */
    public function show($id)
    {
        // Mengambil laporan beserta relasi user pengirim
        $laporan = LaporanPenyalahgunaan::with('user')->findOrFail($id);

        return view('admin.laporan.show', compact('laporan'));
    }

    /**
     * Memperbarui status tindak lanjut laporan.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu_tindak_lanjut,diproses,selesai,ditolak',
        ]);

        $laporan = LaporanPenyalahgunaan::findOrFail($id);
        $laporan->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.laporan.index')
            ->with('success', 'Status laporan penyalahgunaan berhasil diperbarui!');
    }
}