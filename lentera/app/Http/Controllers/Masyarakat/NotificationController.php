<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $authUser = Auth::user();

        // Ambil notifikasi milik user
        $notifications = Notification::where('user_id', $userId)
            ->latest()
            ->get();

        // Kelompokkan
        $todayNotifications = $notifications->filter(function ($n) {
            return $n->created_at->isToday();
        });

        $yesterdayNotifications = $notifications->filter(function ($n) {
            return $n->created_at->isYesterday();
        });

        $olderNotifications = $notifications->filter(function ($n) {
            return !$n->created_at->isToday() && !$n->created_at->isYesterday();
        });

        $unreadCount = $notifications->whereNull('read_at')->count();

        return view('masyarakat.notifikasi', compact(
            'todayNotifications',
            'yesterdayNotifications',
            'olderNotifications',
            'unreadCount',
            'authUser'
        ));
    }

    public function markAllRead()
    {
        Notification::where('user_id', Auth::id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return redirect()->back()->with('success', 'Semua notifikasi telah ditandai dibaca.');
    }

    public function markRead($id)
    {
        Notification::where('user_id', Auth::id())
            ->where('id', $id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return redirect()->back();
    }
}
