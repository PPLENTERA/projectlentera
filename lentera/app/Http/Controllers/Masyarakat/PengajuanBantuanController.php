<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Models\PengajuanBantuan;
use App\Models\DokumenPengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanBantuanController extends Controller
{
    public function create()
    {
        return view('masyarakat.pengajuan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_bantuan'       => 'required|string',
            'jumlah_tanggungan'   => 'required|integer|min:0',
            'penghasilan'         => 'required|numeric|min:0',
            'deskripsi_kebutuhan' => 'nullable|string',
            'dokumen.*'           => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $pengajuan = PengajuanBantuan::create([
            'id_users'            => Auth::id(),
            'jenis_bantuan'       => $request->jenis_bantuan,
            'jumlah_tanggungan'   => $request->jumlah_tanggungan,
            'penghasilan'         => $request->penghasilan,
            'deskripsi_kebutuhan' => $request->deskripsi_kebutuhan,
            'status_pengajuan'    => 'pending',
            'tanggal_pengajuan'   => now()->toDateString(),
        ]);

        if ($request->hasFile('dokumen')) {
            foreach ($request->file('dokumen') as $jenis => $file) {
                $path = $file->store('dokumen_pengajuan', 'public');
                DokumenPengajuan::create([
                    'id_pengajuan' => $pengajuan->id_pengajuan,
                    'jenis_dokumen' => $jenis,
                    'file_path'    => $path,
                ]);
            }
        }

        return redirect()->route('masyarakat.pengajuan.status')
            ->with('success', 'Pengajuan berhasil dikirim!');
    }

    public function index()
    {
        $pengajuan = PengajuanBantuan::where('id_users', Auth::id())
            ->with('dokumen', 'validasi')
            ->latest()
            ->get();

        return view('masyarakat.pengajuan.index', compact('pengajuan'));
    }
}