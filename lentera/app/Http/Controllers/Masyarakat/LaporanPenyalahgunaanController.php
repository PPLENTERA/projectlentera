<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Models\LaporanPenyalahgunaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanPenyalahgunaanController extends Controller
{
    /**
     * Show the form for creating a new report.
     */
    public function create()
    {
        return view('masyarakat.pelaporan.create');
    }

    /**
     * Store a newly created report in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'deskripsi_kejadian' => 'required|string',
            'lokasi_kejadian' => 'required|string|max:255',
            'bukti' => 'required|file|mimes:jpg,jpeg,png,mp4,mov|max:10240', // 10MB max
        ]);

        $buktiPath = null;
        if ($request->hasFile('bukti')) {
            $buktiPath = $request->file('bukti')->store('bukti_pelaporan', 'public');
        }

        LaporanPenyalahgunaan::create([
            'user_id' => Auth::id(),
            'deskripsi_kejadian' => $request->deskripsi_kejadian,
            'lokasi_kejadian' => $request->lokasi_kejadian,
            'bukti_path' => $buktiPath,
            'status' => 'menunggu_tindak_lanjut',
        ]);

        return redirect()->route('masyarakat.pelaporan.create')->with('success', 'Laporan penyalahgunaan berhasil dikirim. Terima kasih atas partisipasi Anda.');
    }
}