<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\PengajuanBantuan;
use App\Models\ValidasiVerifikasi;
use App\Models\Notification;
use App\Http\Controllers\Controller;
use App\Models\ScoringIndicator;

class ValidasiVerifikasiController extends Controller
{
    public function index(Request $request)
    {   
    $query = PengajuanBantuan::with('user', 'dokumen', 'validasi')->latest();
    if ($request->status) {
        $query->where('status_pengajuan', $request->status);
    }
    
    if ($request->jenis_bantuan) {
        $query->where('jenis_bantuan', $request->jenis_bantuan);
    }
    $pengajuan = $query->get();

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
            'tanggal_pengambilan' => 'nullable|date',
            'waktu_pengambilan'   => 'nullable',
            'lokasi_pengambilan'  => 'nullable|string',
        ]);

        $pengajuan = PengajuanBantuan::findOrFail($id);

        ValidasiVerifikasi::updateOrCreate(
            ['id_pengajuan' => $id],
            [
                'id_admin'           => auth()->id(),
                'status_validasi'    => $request->status_validasi,
                'catatan'            => $request->catatan,
                'tanggal_verifikasi' => now()->toDateString(),
                'tanggal_pengambilan' => $request->tanggal_pengambilan,
                'waktu_pengambilan'   => $request->waktu_pengambilan,
                'lokasi_pengambilan'  => $request->lokasi_pengambilan,
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
        } else {
            $pengajuan = PengajuanBantuan::findOrFail($id);
        }

        $pengajuan->update([
            'status_pengajuan' => $status_pengajuan,
            'skor_kelayakan'   => $score,
        ]);

        // Kirim Notifikasi Status Update
        if ($status_pengajuan === 'diverifikasi') {
            Notification::create([
                'user_id' => $pengajuan->id_users,
                'title' => 'Pengajuan Anda telah Disetujui',
                'message' => 'Selamat! Berkas validasi ' . $pengajuan->jenis_bantuan . ' Anda telah diverifikasi oleh tim admin pusat.',
                'type' => 'status_update',
                'icon' => 'check',
                'status_badge' => 'STATUS BARU: AKTIF',
                'action_link' => route('masyarakat.pengajuan.index'),
            ]);
        } else {
            Notification::create([
                'user_id' => $pengajuan->id_users,
                'title' => 'Pengajuan Bantuan Ditolak',
                'message' => 'Mohon maaf, berkas validasi ' . $pengajuan->jenis_bantuan . ' Anda ditolak oleh tim admin pusat. Catatan: ' . ($request->catatan ?? 'Data pendukung tidak valid.'),
                'type' => 'status_update',
                'icon' => 'info',
                'status_badge' => 'STATUS: DITOLAK',
                'action_link' => route('masyarakat.pengajuan.index'),
            ]);
        }

        // Kirim Notifikasi Reminder (Jadwal Pengambilan) jika diisi
        if ($request->tanggal_pengambilan) {
            $formattedDate = \Carbon\Carbon::parse($request->tanggal_pengambilan)->translatedFormat('d M Y');
            // Cek apakah tanggal pengambilan adalah besok
            $isTomorrow = \Carbon\Carbon::parse($request->tanggal_pengambilan)->isTomorrow();
            $dateTitle = $isTomorrow ? 'Besok' : $formattedDate;
            
            $timeText = $request->waktu_pengambilan 
                ? \Carbon\Carbon::parse($request->waktu_pengambilan)->format('H:i') . ' WIB' 
                : '09:00 WIB';

            Notification::create([
                'user_id' => $pengajuan->id_users,
                'title' => 'Jadwal Pengambilan Bantuan: ' . $dateTitle,
                'message' => 'Jangan lupa membawa Kartu Keluarga (KK) asli dan KTP ke ' . ($request->lokasi_pengambilan ?? 'Kantor Pos terdekat') . ' pada pukul ' . $timeText . '.',
                'type' => 'reminder',
                'icon' => 'calendar',
                'status_badge' => null,
                'action_link' => '#',
            ]);
        }

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