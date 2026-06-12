<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - LENTERA Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-900">

<div class="grid grid-cols-12 gap-6 p-6 min-h-screen">

    @php
        $sedangMengajukan = \App\Models\PengajuanBantuan::where('status_pengajuan', 'pending')->count();
        $laporanPending = \App\Models\LaporanPenyalahgunaan::where('status', 'menunggu_tindak_lanjut')->count();
        $feedbackBelumDitinjau = \App\Models\Feedback::where('status', 'belum_ditinjau')->count();
        $authUser = auth()->user();
    @endphp

    {{-- ===== SIDEBAR ===== --}}
    <aside class="col-span-12 xl:col-span-3 bg-white rounded-3xl border border-slate-200 p-6 shadow-sm flex flex-col sticky top-6 h-max">
        <div class="flex items-center gap-3 mb-8">
            <div class="h-12 w-12 rounded-2xl bg-cyan-600 text-white flex items-center justify-center text-lg font-semibold">L</div>
            <div>
                <p class="text-slate-500 text-sm">LENTERA</p>
                <p class="font-semibold">Panel Transparansi</p>
            </div>
        </div>

        {{-- Profil Admin --}}
        @if($authUser)
            <div class="flex items-center gap-3 mb-6 p-3 rounded-2xl border border-slate-100 bg-slate-50">
                <div class="h-10 w-10 rounded-full bg-cyan-100 flex items-center justify-center font-bold text-cyan-700 flex-shrink-0">
                    {{ strtoupper(substr($authUser->name ?? 'A', 0, 2)) }}
                </div>
                <div class="overflow-hidden">
                    <p class="font-semibold text-sm truncate">{{ $authUser->name ?? 'Admin' }}</p>
                    <p class="text-slate-500 text-xs capitalize">{{ $authUser->role ?? 'admin' }}</p>
                </div>
            </div>
        @endif

        <nav class="space-y-1 flex-1">
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-3 rounded-2xl {{ request()->is('admin/dashboard') ? 'bg-cyan-600 text-white shadow-sm' : 'px-4 py-3 text-slate-600 hover:bg-slate-100' }} px-4 py-3 font-medium transition-colors">
                <svg class="w-5 h-5 {{ request()->is('admin/dashboard') ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Overview
            </a>
            <a href="{{ route('admin.validasi.index') }}"
                class="flex items-center gap-3 rounded-2xl {{ request()->is('admin/validasi*') || request()->is('admin/penentuan*') || request()->is('admin/scoring-indicators*') ? 'bg-cyan-600 text-white shadow-sm' : 'px-4 py-3 text-slate-600 hover:bg-slate-100' }} px-4 py-3 font-medium transition-colors">
                <svg class="w-5 h-5 {{ request()->is('admin/validasi*') || request()->is('admin/penentuan*') || request()->is('admin/scoring-indicators*') ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Validasi Pengajuan
                @if($sedangMengajukan > 0)
                    <span class="ml-auto {{ request()->is('admin/validasi*') || request()->is('admin/penentuan*') || request()->is('admin/scoring-indicators*') ? 'bg-cyan-700 text-white' : 'bg-amber-100 text-amber-700' }} text-xs font-bold px-2 py-0.5 rounded-full">{{ $sedangMengajukan }}</span>
                @endif
            </a>

            <a href="{{ route('admin.broadcast.index') }}"
                class="flex items-center gap-3 rounded-2xl {{ request()->is('admin/broadcast*') ? 'bg-cyan-600 text-white shadow-sm' : 'px-4 py-3 text-slate-600 hover:bg-slate-100' }} px-4 py-3 font-medium transition-colors">
                <svg class="w-5 h-5 {{ request()->is('admin/broadcast*') ? 'text-white' : 'text-slate-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                </svg>
                Broadcast Notifikasi
            </a>

            <a href="{{ route('admin.monitoring') }}"
                class="flex items-center gap-3 rounded-2xl {{ request()->is('admin/monitoring*') ? 'bg-cyan-600 text-white shadow-sm' : 'px-4 py-3 text-slate-600 hover:bg-slate-100' }} px-4 py-3 font-medium transition-colors">
                <svg class="w-5 h-5 {{ request()->is('admin/monitoring*') ? 'text-white' : 'text-slate-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                Monitoring Dana
            </a>

            <a href="{{ route('admin.laporan.index') }}"
                class="flex items-center gap-3 rounded-2xl {{ request()->is('admin/laporan*') ? 'bg-cyan-600 text-white shadow-sm' : 'px-4 py-3 text-slate-600 hover:bg-slate-100' }} px-4 py-3 font-medium transition-colors">
                <svg class="w-5 h-5 {{ request()->is('admin/laporan*') ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                Laporan
                @if($laporanPending > 0)
                    <span class="ml-auto {{ request()->is('admin/laporan*') ? 'bg-cyan-700 text-white' : 'bg-red-100 text-red-650' }} text-xs font-bold px-2 py-0.5 rounded-full">{{ $laporanPending }}</span>
                @endif
            </a>
            <a href="{{ url('/admin/lokasi-bantuan') }}"
                class="flex items-center gap-3 rounded-2xl {{ request()->is('admin/lokasi-bantuan*') ? 'bg-cyan-600 text-white shadow-sm' : 'px-4 py-3 text-slate-600 hover:bg-slate-100' }} px-4 py-3 font-medium transition-colors">

                <svg class="w-5 h-5 {{ request()->is('admin/lokasi-bantuan*') ? 'text-white' : 'text-slate-400' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>

                Lokasi Bantuan
            </a>

            <a href="{{ url('/admin/statistik-bantuan') }}"
                class="flex items-center gap-3 rounded-2xl {{ request()->is('admin/statistik-bantuan*') ? 'bg-cyan-600 text-white shadow-sm' : 'px-4 py-3 text-slate-600 hover:bg-slate-100' }} px-4 py-3 font-medium transition-colors">

                <svg class="w-5 h-5 {{ request()->is('admin/statistik-bantuan*') ? 'text-white' : 'text-slate-400' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 17v-6m4 6V7m4 10v-3"/>
                </svg>

                Statistik Bantuan
            </a>

            <a href="{{ route('admin.feedback.index') }}"
                class="flex items-center gap-3 rounded-2xl {{ request()->is('admin/feedback*') ? 'bg-cyan-600 text-white shadow-sm' : 'px-4 py-3 text-slate-600 hover:bg-slate-100' }} px-4 py-3 font-medium transition-colors">
                <svg class="w-5 h-5 {{ request()->is('admin/feedback*') ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                Feedback
                @if($feedbackBelumDitinjau > 0)
                    <span class="ml-auto {{ request()->is('admin/feedback*') ? 'bg-cyan-700 text-white' : 'bg-blue-100 text-blue-600' }} text-xs font-bold px-2 py-0.5 rounded-full">{{ $feedbackBelumDitinjau }}</span>
                @endif
            </a>
        </nav>

        <div class="mt-6 pt-6 border-t border-slate-200 space-y-4">
            <div class="text-sm text-slate-500 space-y-1">
                <div class="flex items-center justify-between">
                    <span>Pusat Bantuan</span>
                    <span class="text-slate-900 font-medium">08-800-100-101</span>
                </div>
                <p class="text-xs">Pelayanan distribusi bantuan dan pelaporan masalah.</p>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="inline w-full">
                @csrf
                <button type="submit" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-red-500 hover:bg-red-50 font-medium transition-colors w-full">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- ===== MAIN CONTENT ===== --}}
    <main class="col-span-12 xl:col-span-9">
        @yield('content')
    </main>

</div>

@stack('scripts')
</body>
</html>