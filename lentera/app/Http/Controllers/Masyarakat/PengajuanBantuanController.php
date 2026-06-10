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
            'nama_lengkap'        => 'required|string|max:255',
            'nik'                 => 'required|digits:16',
            'jenis_bantuan'       => 'required|string',
            'deskripsi_kebutuhan' => 'nullable|string',
            'bukti_pendukung'     => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $buktiPath = null;
        if ($request->hasFile('bukti_pendukung')) {
            $buktiPath = $request->file('bukti_pendukung')->store('bukti_pendukung', 'public');
        }

        PengajuanBantuan::create([
            'id_users'            => Auth::id(),
            'nama_lengkap'        => $request->nama_lengkap,
            'nik'                 => $request->nik,
            'jenis_bantuan'       => $request->jenis_bantuan,
            'jumlah_tanggungan'   => 0,
            'penghasilan'         => 0,
            'deskripsi_kebutuhan' => $request->deskripsi_kebutuhan,
            'bukti_pendukung'     => $buktiPath,
            'status_pengajuan'    => 'pending',
            'tanggal_pengajuan'   => now()->toDateString(),
        ]);

        return redirect()->route('masyarakat.pengajuan.index')
            ->with('success', 'Pengajuan berhasil dikirim!');
    }

    public function uploadForm($id)
    {
        $pengajuan = PengajuanBantuan::findOrFail($id);
        return view('masyarakat.pengajuan.upload', compact('pengajuan'));
    }

    public function uploadDokumen(Request $request, $id)
    {
        $request->validate([
            'dokumen.*' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $pengajuan = PengajuanBantuan::findOrFail($id);

        foreach ($request->file('dokumen') as $jenis => $file) {
            $path = $file->store('dokumen_pengajuan', 'public');
            DokumenPengajuan::create([
                'id_pengajuan'  => $pengajuan->id_pengajuan,
                'jenis_dokumen' => $jenis,
                'file_path'     => $path,
            ]);
        }

        return redirect()->route('masyarakat.pengajuan.index')
            ->with('success', 'Pengajuan berhasil dikirim!');
    }

    public function index(Request $request)
    {
        $pengajuan = PengajuanBantuan::where('id_users', Auth::id())
            ->with('dokumen', 'validasi')
            ->latest()
            ->get();

        $selected = $request->id 
            ? $pengajuan->firstWhere('id_pengajuan', $request->id)
            : $pengajuan->first();

        return view('masyarakat.pengajuan.index', compact('pengajuan', 'selected'));
    }
}