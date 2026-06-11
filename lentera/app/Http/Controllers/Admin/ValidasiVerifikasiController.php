<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengajuanBantuan;
use App\Models\ValidasiVerifikasi;
use App\Models\ScoringIndicator;

class ValidasiVerifikasiController extends Controller
{
    public function index()
    {
        $pengajuan = PengajuanBantuan::with('user', 'dokumen', 'validasi')
            ->latest()
            ->get();

        return view('admin.validasi.index', compact('pengajuan'));
    }

    public function show($id)
    {
        $pengajuan = PengajuanBantuan::with('user', 'dokumen', 'validasi')
            ->findOrFail($id);

        return view('admin.validasi.show', compact('pengajuan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status_validasi' => 'required|in:valid,tidak_valid',
            'catatan'         => 'nullable|string',
        ]);

        ValidasiVerifikasi::updateOrCreate(
            ['id_pengajuan' => $id],
            [
                'id_admin'         => auth()->id(),
                'status_validasi'  => $request->status_validasi,
                'catatan'          => $request->catatan,
                'tanggal_verifikasi' => now()->toDateString(),
            ]
        );

        $status_pengajuan = $request->status_validasi === 'valid' ? 'diverifikasi' : 'ditolak';
        $score = null;

        if ($status_pengajuan === 'diverifikasi') {
            $pengajuan = PengajuanBantuan::findOrFail($id);
            $score = ScoringIndicator::calculateScore(
                $pengajuan->penghasilan,
                $pengajuan->jumlah_tanggungan
            );
        }

        PengajuanBantuan::where('id_pengajuan', $id)->update([
            'status_pengajuan' => $status_pengajuan,
            'skor_kelayakan'   => $score,
        ]);

        return redirect()->route('admin.validasi.index')
            ->with('success', 'Validasi berhasil disimpan!');
    }

    public function penentuanPenerima(Request $request)
    {
        $query = PengajuanBantuan::with('user', 'dokumen', 'validasi')
            ->whereIn('status_pengajuan', ['diverifikasi', 'diterima']);

        if ($request->filled('jenis_bantuan')) {
            $query->where('jenis_bantuan', $request->jenis_bantuan);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $pengajuan = $query->orderByRaw('skor_kelayakan IS NULL, skor_kelayakan DESC')
            ->orderBy('tanggal_pengajuan')
            ->get();

        // Recalculate score on-the-fly if it is 0 or null using the new calculateScore logic
        foreach ($pengajuan as $item) {
            if ($item->skor_kelayakan === null || $item->skor_kelayakan === 0) {
                $newScore = ScoringIndicator::calculateScore($item->penghasilan, $item->jumlah_tanggungan);
                if ($newScore > 0) {
                    $item->update(['skor_kelayakan' => $newScore]);
                }
            }
        }

        // Re-query to sort based on the newly updated scores
        $pengajuan = $query->orderByRaw('skor_kelayakan IS NULL, skor_kelayakan DESC')
            ->orderBy('tanggal_pengajuan')
            ->get();

        $jenisBantuanList = PengajuanBantuan::select('jenis_bantuan')
            ->distinct()
            ->pluck('jenis_bantuan');

        return view('admin.validasi.penentuan', compact('pengajuan', 'jenisBantuanList'));
    }

    public function updateStatusPenerima(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diverifikasi,diterima,ditolak',
        ]);

        $pengajuan = PengajuanBantuan::findOrFail($id);
        $pengajuan->update([
            'status_pengajuan' => $request->status,
        ]);

        $message = $request->status === 'diterima'
            ? 'Pengajuan berhasil disetujui sebagai penerima bantuan!'
            : 'Status pengajuan berhasil diperbarui.';

        return redirect()->route('admin.validasi.penentuan')
            ->with('success', $message);
    }
}