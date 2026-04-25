<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PendaftaranBantuanController extends Controller
{
    public function create()
    {
        return view('masyarakat.pendaftaran.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'nik' => 'required|string|size:16',
            'nomor_kk' => 'required|string|size:16',
            'nomor_hp' => 'required|string|max:15',
            'jenis_kelamin' => 'required|string',
            'alamat_lengkap' => 'required|string',
            'dokumen_ktp' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'dokumen_kk' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'dokumen_rumah' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'dokumen_sktm' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        $dokumen_ktp = $request->file('dokumen_ktp')->store('dokumen_pendaftaran', 'public');
        $dokumen_kk = $request->file('dokumen_kk')->store('dokumen_pendaftaran', 'public');
        $dokumen_rumah = $request->file('dokumen_rumah')->store('dokumen_pendaftaran', 'public');
        $dokumen_sktm = $request->file('dokumen_sktm')->store('dokumen_pendaftaran', 'public');
        
        \App\Models\PendaftaranBantuan::create([
            'user_id' => auth()->id(),
            'nama_lengkap' => $validated['nama_lengkap'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'nik' => $validated['nik'],
            'nomor_kk' => $validated['nomor_kk'],
            'nomor_hp' => $validated['nomor_hp'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'alamat_lengkap' => $validated['alamat_lengkap'],
            'dokumen_ktp' => $dokumen_ktp,
            'dokumen_kk' => $dokumen_kk,
            'dokumen_rumah' => $dokumen_rumah,
            'dokumen_sktm' => $dokumen_sktm,
        ]);

        return redirect()->route('masyarakat.dashboard')->with('success', 'Pendaftaran Bantuan berhasil diajukan!');
    }
}
