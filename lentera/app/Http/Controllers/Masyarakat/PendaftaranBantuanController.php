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
        ]);

        

        \App\Models\PendaftaranBantuan::create([
            'user_id' => auth()->id(),
            'nama_lengkap' => $validated['nama_lengkap'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'nik' => $validated['nik'],
            'nomor_kk' => $validated['nomor_kk'],
            'nomor_hp' => $validated['nomor_hp'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'alamat_lengkap' => $validated['alamat_lengkap'],
        ]);

        return redirect()->route('masyarakat.dashboard')->with('success', 'Pendaftaran Bantuan berhasil diajukan!');
    }
}
