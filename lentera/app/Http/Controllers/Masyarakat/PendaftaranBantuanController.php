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
            'pekerjaan' => 'required|string|max:255',
            'penghasilan_per_bulan' => 'required|numeric',
            'pengeluaran_bulanan' => 'required|numeric',
            'jumlah_tanggungan' => 'required|integer',
            'status_rumah' => 'required|string|max:255',
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
            'pekerjaan' => $validated['pekerjaan'],
            'penghasilan_per_bulan' => $validated['penghasilan_per_bulan'],
            'pengeluaran_bulanan' => $validated['pengeluaran_bulanan'],
            'jumlah_tanggungan' => $validated['jumlah_tanggungan'],
            'status_rumah' => $validated['status_rumah'],
            'dokumen_ktp' => $dokumen_ktp,
            'dokumen_kk' => $dokumen_kk,
            'dokumen_rumah' => $dokumen_rumah,
            'dokumen_sktm' => $dokumen_sktm,
            'status' => 'pending',
        ]);

        return redirect()->route('masyarakat.dashboard')->with('success', 'Pendaftaran Bantuan berhasil diajukan!');
    }
}
