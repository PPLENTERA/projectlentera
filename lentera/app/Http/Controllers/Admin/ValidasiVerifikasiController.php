<?php

namespace App\Http\Controllers\Admin;
use App\Models\PengajuanBantuan;
use App\Models\ValidasiVerifikasi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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


        PengajuanBantuan::where('id_pengajuan', $id)->update([
            'status_pengajuan' => $request->status_validasi === 'valid' 
                ? 'diverifikasi' 
                : 'ditolak',
        ]);

        return redirect()->route('admin.validasi.index')
            ->with('success', 'Validasi berhasil disimpan!');
    }
}