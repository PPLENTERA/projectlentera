<?php
namespace App\Http\Controllers\Admin;
use App\Models\PengajuanBantuan;
use App\Models\ValidasiVerifikasi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class ValidasiVerifikasiController extends Controller
{
<<<<<<< Updated upstream
    public function index()
    {
        $pengajuan = PengajuanBantuan::with('user', 'dokumen', 'validasi')
            ->latest()
            ->get();

        return view('admin.validasi.index', compact('pengajuan'));
=======
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
>>>>>>> Stashed changes
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
            'status_validasi' => 'required|in:valid,tidak_valid,diterima',
            'catatan'         => 'nullable|string',
        ]);
        ValidasiVerifikasi::updateOrCreate(
            ['id_pengajuan' => $id],
            [
                'id_admin'         => auth()->id(),
                'status_validasi'  => $request->status_validasi === 'tidak_valid' ? 'tidak_valid' : 'valid',
                'catatan'          => $request->catatan,
                'tanggal_verifikasi' => now()->toDateString(),
            ]
        );
        $pengajuan = PengajuanBantuan::findOrFail($id);
        $oldStatus = $pengajuan->status_pengajuan;
        $newStatus = 'diverifikasi';
        if ($request->status_validasi === 'tidak_valid') {
            $newStatus = 'ditolak';
        } elseif ($request->status_validasi === 'diterima') {
            $newStatus = 'diterima';
        }
        if ($oldStatus !== $newStatus) {
            $pengajuan->update([
                'status_pengajuan' => $newStatus,
            ]);
            // Map statuses for better display in the notification message
            $statusLabels = [
                'pending' => 'Diproses',
                'diverifikasi' => 'Diverifikasi',
                'diterima' => 'Diterima',
                'ditolak' => 'Ditolak'
            ];
            $oldLabel = $statusLabels[$oldStatus] ?? $oldStatus;
            $newLabel = $statusLabels[$newStatus] ?? $newStatus;
            \App\Models\Notification::create([
                'user_id' => $pengajuan->id_users,
                'id_pengajuan' => $pengajuan->id_pengajuan,
                'title' => 'Perubahan Status Pengajuan',
                'message' => "Pengajuan bantuan Anda (#LT-" . str_pad($pengajuan->id_pengajuan, 4, '0', STR_PAD_LEFT) . ") statusnya telah berubah dari '{$oldLabel}' menjadi '{$newLabel}'.",
                'status_before' => $oldStatus,
                'status_after' => $newStatus,
                'is_read' => false,
            ]);
        }
        return redirect()->route('admin.validasi.index')
            ->with('success', 'Validasi berhasil disimpan!');
    }
}