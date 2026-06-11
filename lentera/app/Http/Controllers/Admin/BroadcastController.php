<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PendaftaranBantuan;
use App\Models\Notification;

class BroadcastController extends Controller
{
    public function index()
    {
        $totalRegistered = PendaftaranBantuan::distinct('user_id')->count();
        
        // Ambil riwayat broadcast (notifikasi program baru)
        $pastBroadcasts = Notification::where('status_badge', 'PROGRAM BARU')
            ->select('title', 'message', 'created_at')
            ->distinct()
            ->latest()
            ->get();

        return view('admin.broadcast.index', compact('totalRegistered', 'pastBroadcasts'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'max_income' => 'required|numeric|min:0',
            'min_dependents' => 'required|integer|min:0',
            'jenis_bantuan' => 'required|string',
        ]);

        // Cari calon penerima yang memenuhi kriteria
        $userIds = PendaftaranBantuan::where('penghasilan_per_bulan', '<=', $request->max_income)
            ->where('jumlah_tanggungan', '>=', $request->min_dependents)
            ->distinct()
            ->pluck('user_id');

        if ($userIds->isEmpty()) {
            return back()->withInput()->with('error', 'Tidak ada calon penerima yang memenuhi kriteria tersebut.');
        }

        // Kirim notifikasi ke masing-masing user yang cocok
        foreach ($userIds as $userId) {
            Notification::create([
                'user_id' => $userId,
                'title' => $request->title,
                'message' => $request->message,
                'type' => 'system_update',
                'icon' => 'info',
                'status_badge' => 'PROGRAM BARU',
                'action_link' => route('masyarakat.pengajuan.create'),
            ]);
        }

        return redirect()->route('admin.broadcast.index')
            ->with('success', 'Broadcast berhasil dikirim ke ' . $userIds->count() . ' calon penerima.');
    }
}
