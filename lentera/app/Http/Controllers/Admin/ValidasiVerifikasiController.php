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

    public function export(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $pengajuan = PengajuanBantuan::with('user')
            ->whereBetween('tanggal_pengajuan', [$request->start_date, $request->end_date])
            ->latest()
            ->get();

        $filename = "laporan_pengajuan_bantuan_{$request->start_date}_sampai_{$request->end_date}.csv";

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['ID', 'Nama Pemohon', 'Jenis Bantuan', 'Jumlah Tanggungan', 'Penghasilan', 'Status Pengajuan', 'Tanggal Pengajuan'];

        $callback = function() use($pengajuan, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($pengajuan as $p) {
                $row = [
                    $p->id_pengajuan,
                    $p->user->name ?? 'N/A',
                    $p->jenis_bantuan,
                    $p->jumlah_tanggungan,
                    $p->penghasilan,
                    $p->status_pengajuan,
                    $p->tanggal_pengajuan
                ];

                fputcsv($file, $row);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}