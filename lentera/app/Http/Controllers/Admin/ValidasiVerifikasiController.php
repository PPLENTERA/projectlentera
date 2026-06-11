<?php

namespace App\Http\Controllers\Admin;
use App\Models\PengajuanBantuan;
use App\Models\ValidasiVerifikasi;
use App\Models\Notification;
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

        $newStatus = $request->status_validasi === 'valid' ? 'diverifikasi' : 'ditolak';
        $pengajuan->update([
            'status_pengajuan' => $newStatus,
        ]);

        // Kirim Notifikasi Status Update
        if ($newStatus === 'diverifikasi') {
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
}