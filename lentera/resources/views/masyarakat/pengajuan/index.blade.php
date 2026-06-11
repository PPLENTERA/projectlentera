<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat & Status - LENTERA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F3F4F6] min-h-screen font-['Inter']">

<div class="flex min-h-screen">

    <aside class="w-72 bg-white fixed left-0 top-0 h-full flex flex-col py-8 border-r border-slate-100">
        <div class="px-8 mb-10">
            <h1 class="text-2xl font-extrabold text-[#1E3A5F] font-['Plus_Jakarta_Sans'] tracking-tight">LENTERA</h1>
            <p class="text-xs text-slate-400 uppercase tracking-widest mt-1">Panel Transparansi</p>
        </div>
        <a href="{{ route('masyarakat.pengajuan.create') }}"
            class="flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold text-white bg-gradient-to-r from-[#172545] to-[#1F335C] shadow hover:shadow-lg hover:-translate-y-0.5 transition-all">
            + Ajukan Baru
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-50 text-green-600 text-sm p-4 rounded-xl border border-green-100 mb-6">
            {{ session('success') }}
        </div>
    @endif
        <nav class="flex-1 px-6 space-y-2">
            <a href="{{ route('masyarakat.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-full text-sm font-medium text-slate-500 hover:bg-slate-50 hover:text-[#1E3A5F] transition-all">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                Overview
            </a>
            <a href="{{ route('masyarakat.pengajuan.create') }}" class="flex items-center gap-3 px-4 py-3 rounded-full text-sm font-medium text-slate-500 hover:bg-slate-50 hover:text-[#1E3A5F] transition-all">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                Pengajuan
            </a>
            <a href="{{ route('masyarakat.pengajuan.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-full text-sm font-medium bg-white shadow text-[#1E3A5F] font-semibold transition-all">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                Riwayat
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-full text-sm font-medium text-slate-500 hover:bg-slate-50 hover:text-[#1E3A5F] transition-all">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                Monitoring
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-full text-sm font-medium text-slate-500 hover:bg-slate-50 hover:text-[#1E3A5F] transition-all">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" /></svg>
                Statistik
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-full text-sm font-medium text-slate-500 hover:bg-slate-50 hover:text-[#1E3A5F] transition-all">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                Laporan
            </a>
            <a href="{{ route('masyarakat.notifikasi.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-full text-sm font-medium text-slate-500 hover:bg-slate-50 hover:text-[#1E3A5F] transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                Notifikasi
                @if($unreadNotificationsCount > 0)
                    <span class="ml-auto bg-red-100 text-red-600 text-xs font-bold px-2 py-0.5 rounded-full">{{ $unreadNotificationsCount }}</span>
                @endif
            </a>
        </nav>

        <nav class="flex-1 px-6 space-y-2">
            <a href="{{ route('masyarakat.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-full text-sm font-medium text-slate-500 hover:bg-slate-50 hover:text-[#1E3A5F] transition-all">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                Overview
            </a>
            <a href="{{ route('masyarakat.pengajuan.create') }}" class="flex items-center gap-3 px-4 py-3 rounded-full text-sm font-medium text-slate-500 hover:bg-slate-50 hover:text-[#1E3A5F] transition-all">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                Pengajuan
            </a>
            <a href="{{ route('masyarakat.pengajuan.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-full text-sm font-medium bg-white shadow text-[#1E3A5F] font-semibold transition-all">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                Riwayat
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-full text-sm font-medium text-slate-500 hover:bg-slate-50 hover:text-[#1E3A5F] transition-all">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                Monitoring
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-full text-sm font-medium text-slate-500 hover:bg-slate-50 hover:text-[#1E3A5F] transition-all">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" /></svg>
                Statistik
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-full text-sm font-medium text-slate-500 hover:bg-slate-50 hover:text-[#1E3A5F] transition-all">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                Laporan
            </a>
        </nav>

        <div class="px-6 pt-6 border-t border-slate-100">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-full bg-[#1C2C4E] flex items-center justify-center text-white text-sm font-bold">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
                <div>
                    <p class="text-sm font-bold text-slate-800">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-slate-400">Verified Citizen</p>
                </div>
            </div>
            <a href="{{ route('masyarakat.pengajuan.create') }}"
                class="flex items-center justify-center gap-2 w-full py-2.5 rounded-full text-sm font-bold text-white bg-gradient-to-r from-[#172545] to-[#1F335C] hover:shadow-lg transition-all">
                + Bantuan Baru
            </a>
        </div>
    </aside>

    <main class="ml-72 flex-1 p-10">

        <div class="flex items-start justify-between mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-[#1E3A5F] font-['Plus_Jakarta_Sans'] tracking-tight">Riwayat & Status</h1>
                <p class="text-sm text-slate-500 mt-1">Pantau perkembangan permohonan bantuan Anda secara real-time dengan transparansi penuh.</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="bg-white rounded-full px-5 py-2.5 flex items-center gap-2 shadow-sm">
                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <form action="{{ route('masyarakat.pengajuan.index') }}" method="GET" class="flex items-center gap-2">
                        <input type="text" name="search" value="{{ request('search') }}" 
                            placeholder="Cari ID atau Jenis Bantuan" 
                            class="bg-transparent text-sm text-slate-600 outline-none w-44">
                        <button type="submit" class="text-slate-400 hover:text-slate-600">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-50 text-green-600 text-sm p-4 rounded-2xl border border-green-100 mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex gap-6">

            <div class="flex-1 flex flex-col gap-4">

                <div class="bg-white rounded-3xl shadow-sm overflow-hidden">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-[#F8F9FA] border-b border-slate-100">
                                <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-widest">ID Permohonan</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-widest">Jenis Bantuan</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-widest">Tanggal</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-widest">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($pengajuan as $item)
                                <tr class="hover:bg-[#F8F9FA] transition-colors cursor-pointer {{ $selected && $selected->id_pengajuan == $item->id_pengajuan ? 'bg-blue-50' : '' }}"
                                    onclick="window.location='{{ route('masyarakat.pengajuan.index') }}?id={{ $item->id_pengajuan }}'">
                                    <td class="px-6 py-4 font-bold text-[#1E3A5F]">#LT-{{ str_pad($item->id_pengajuan, 4, '0', STR_PAD_LEFT) }}</td>
                                    <td class="px-6 py-4 text-slate-700">{{ $item->jenis_bantuan }}</td>
                                    <td class="px-6 py-4 text-slate-500">{{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->format('d M Y') }}</td>
                                    <td class="px-6 py-4">
                                        @if($item->status_pengajuan == 'pending')
                                            <span class="bg-yellow-100 text-yellow-700 text-xs font-bold px-3 py-1 rounded-full uppercase">Pending</span>
                                        @elseif($item->status_pengajuan == 'diverifikasi')
                                            <span class="bg-blue-100 text-blue-700 text-xs font-bold px-3 py-1 rounded-full uppercase">Diverifikasi</span>
                                        @elseif($item->status_pengajuan == 'diterima')
                                            <span class="bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full uppercase">Approved</span>
                                        @elseif($item->status_pengajuan == 'ditolak')
                                            <span class="bg-red-100 text-red-700 text-xs font-bold px-3 py-1 rounded-full uppercase">Rejected</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-slate-400 text-sm">
                                        Belum ada pengajuan bantuan.
                                        <a href="{{ route('masyarakat.pengajuan.create') }}" class="text-[#1F54CE] font-bold ml-1">Ajukan Sekarang</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white rounded-3xl p-5 flex items-center gap-4 shadow-sm">
                        <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 uppercase tracking-widest font-bold">Total Dana Diterima</p>
                            <p class="text-lg font-extrabold text-[#1E3A5F] font-['Plus_Jakarta_Sans']">Rp 0</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-3xl p-5 flex items-center gap-4 shadow-sm">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 uppercase tracking-widest font-bold">Permohonan Aktif</p>
                            <p class="text-lg font-extrabold text-[#1E3A5F] font-['Plus_Jakarta_Sans']">{{ $pengajuan->whereIn('status_pengajuan', ['pending', 'diverifikasi'])->count() }}</p>
                        </div>
                    </div>
                </div>

            </div>

            @if($item->dokumen->count() > 0)
                <div class="border-t border-slate-100 pt-4 mb-4">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Dokumen Terupload</p>
                    <div class="flex gap-2 flex-wrap">
                        @foreach($item->dokumen as $dok)
                            <span class="text-xs font-semibold bg-[#F0F2F5] text-slate-600 px-3 py-1 rounded-lg uppercase">
                                {{ $dok->jenis_dokumen }}
                            </span>
                        @endforeach
    <main class="ml-72 flex-1 p-10">

        <div class="flex items-start justify-between mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-[#1E3A5F] font-['Plus_Jakarta_Sans'] tracking-tight">Riwayat & Status</h1>
                <p class="text-sm text-slate-500 mt-1">Pantau perkembangan permohonan bantuan Anda secara real-time dengan transparansi penuh.</p>
            </div>
            <div class="flex items-center gap-3">
                <!-- Bell Icon with Badge -->
                <a href="{{ route('masyarakat.notifikasi.index') }}" class="relative p-2.5 text-slate-600 hover:text-slate-900 bg-white hover:bg-slate-50 rounded-full transition-colors shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                    @if($unreadNotificationsCount > 0)
                        <span class="absolute top-1 right-1 block h-2.5 w-2.5 rounded-full bg-red-500 ring-2 ring-white"></span>
                    @endif
                </a>
                <div class="bg-white rounded-full px-5 py-2.5 flex items-center gap-2 shadow-sm">
                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <form action="{{ route('masyarakat.pengajuan.index') }}" method="GET" class="flex items-center gap-2">
                        <input type="text" name="search" value="{{ request('search') }}" 
                            placeholder="Cari ID atau Jenis Bantuan" 
                            class="bg-transparent text-sm text-slate-600 outline-none w-44">
                        <button type="submit" class="text-slate-400 hover:text-slate-600">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-50 text-green-600 text-sm p-4 rounded-2xl border border-green-100 mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex gap-6">

            <div class="flex-1 flex flex-col gap-4">

                <div class="bg-white rounded-3xl shadow-sm overflow-hidden">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-[#F8F9FA] border-b border-slate-100">
                                <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-widest">ID Permohonan</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-widest">Jenis Bantuan</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-widest">Tanggal</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-widest">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($pengajuan as $item)
                                <tr class="hover:bg-[#F8F9FA] transition-colors cursor-pointer {{ $selected && $selected->id_pengajuan == $item->id_pengajuan ? 'bg-blue-50' : '' }}"
                                    onclick="window.location='{{ route('masyarakat.pengajuan.index') }}?id={{ $item->id_pengajuan }}'">
                                    <td class="px-6 py-4 font-bold text-[#1E3A5F]">#LT-{{ str_pad($item->id_pengajuan, 4, '0', STR_PAD_LEFT) }}</td>
                                    <td class="px-6 py-4 text-slate-700">{{ $item->jenis_bantuan }}</td>
                                    <td class="px-6 py-4 text-slate-500">{{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->format('d M Y') }}</td>
                                    <td class="px-6 py-4">
                                        @if($item->status_pengajuan == 'pending')
                                            <span class="bg-yellow-100 text-yellow-700 text-xs font-bold px-3 py-1 rounded-full uppercase">Pending</span>
                                        @elseif($item->status_pengajuan == 'diverifikasi')
                                            <span class="bg-blue-100 text-blue-700 text-xs font-bold px-3 py-1 rounded-full uppercase">Diverifikasi</span>
                                        @elseif($item->status_pengajuan == 'diterima')
                                            <span class="bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full uppercase">Approved</span>
                                        @elseif($item->status_pengajuan == 'ditolak')
                                            <span class="bg-red-100 text-red-700 text-xs font-bold px-3 py-1 rounded-full uppercase">Rejected</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-slate-400 text-sm">
                                        Belum ada pengajuan bantuan.
                                        <a href="{{ route('masyarakat.pengajuan.create') }}" class="text-[#1F54CE] font-bold ml-1">Ajukan Sekarang</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white rounded-3xl p-5 flex items-center gap-4 shadow-sm">
                        <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 uppercase tracking-widest font-bold">Total Dana Diterima</p>
                            <p class="text-lg font-extrabold text-[#1E3A5F] font-['Plus_Jakarta_Sans']">Rp 0</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-3xl p-5 flex items-center gap-4 shadow-sm">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 uppercase tracking-widest font-bold">Permohonan Aktif</p>
                            <p class="text-lg font-extrabold text-[#1E3A5F] font-['Plus_Jakarta_Sans']">{{ $pengajuan->whereIn('status_pengajuan', ['pending', 'diverifikasi'])->count() }}</p>
                        </div>
                    </div>
            @if($selected)
            @php $latest = $selected; @endphp
            <div class="w-80 bg-white rounded-3xl shadow-sm p-6 flex flex-col gap-6 h-fit">

                {{-- Header --}}
                <div class="flex items-center justify-between">
                    <h3 class="text-sm font-bold text-[#1E3A5F]">Detail Progress</h3>
                    <span class="text-xs font-bold text-slate-400 bg-slate-100 px-3 py-1 rounded-full">
                        LT-{{ str_pad($latest->id_pengajuan, 4, '0', STR_PAD_LEFT) }}
                    </span>
                </div>

            @if($item->validasi && $item->validasi->catatan)
                <div class="border-t border-slate-100 pt-4">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Catatan Admin</p>
                    <p class="text-sm text-slate-600">{{ $item->validasi->catatan }}</p>
            </div>

            @if($selected)
            @php $latest = $selected; @endphp
            <div class="w-80 bg-white rounded-3xl shadow-sm p-6 flex flex-col gap-6 h-fit">

                {{-- Header --}}
                <div class="flex items-center justify-between">
                    <h3 class="text-sm font-bold text-[#1E3A5F]">Detail Progress</h3>
                    <span class="text-xs font-bold text-slate-400 bg-slate-100 px-3 py-1 rounded-full">
                        LT-{{ str_pad($latest->id_pengajuan, 4, '0', STR_PAD_LEFT) }}
                    </span>
                <div class="flex flex-col gap-0 relative">
                    <div class="absolute left-3.5 top-4 bottom-4 w-0.5 bg-slate-100"></div>

                    <div class="flex gap-4 pb-6 relative">
                        <div class="w-7 h-7 rounded-full bg-green-500 flex items-center justify-center flex-shrink-0 z-10">
                            <svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-[#1E3A5F]">Permohonan Dikirim</p>
                            <p class="text-xs text-slate-400 mt-0.5">Berkas administrasi dan data diri telah berhasil diunggah ke sistem.</p>
                            <p class="text-xs text-slate-300 mt-1">{{ \Carbon\Carbon::parse($latest->tanggal_pengajuan)->format('d M Y') }}</p>
                        </div>
                    </div>

                    <div class="flex gap-4 pb-6 relative">
                        <div class="w-7 h-7 rounded-full {{ in_array($latest->status_pengajuan, ['diverifikasi', 'diterima', 'ditolak']) ? 'bg-green-500' : 'bg-slate-200' }} flex items-center justify-center flex-shrink-0 z-10">
                            @if(in_array($latest->status_pengajuan, ['diverifikasi', 'diterima', 'ditolak']))
                                <svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                </svg>
                            @else
                                <div class="w-2 h-2 rounded-full bg-slate-400"></div>
                            @endif
                        </div>
                        <div>
                            <p class="text-sm font-bold {{ in_array($latest->status_pengajuan, ['diverifikasi', 'diterima', 'ditolak']) ? 'text-[#1E3A5F]' : 'text-slate-400' }}">Verifikasi Dokumen</p>
                            <p class="text-xs text-slate-400 mt-0.5">Tim kurator telah memvalidasi kelengkapan dokumen persyaratan.</p>
                            @if($latest->validasi && $latest->validasi->tanggal_verifikasi)
                                <p class="text-xs text-slate-300 mt-1">{{ \Carbon\Carbon::parse($latest->validasi->tanggal_verifikasi)->format('d M Y') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="flex gap-4 relative">
                        <div class="w-7 h-7 rounded-full {{ $latest->status_pengajuan == 'diterima' ? 'bg-green-500' : ($latest->status_pengajuan == 'ditolak' ? 'bg-red-400' : 'bg-slate-200') }} flex items-center justify-center flex-shrink-0 z-10">
                            @if($latest->status_pengajuan == 'diterima')
                                <svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                </svg>
                            @elseif($latest->status_pengajuan == 'ditolak')
                                <svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            @else
                                <div class="w-2 h-2 rounded-full bg-slate-400"></div>
                            @endif
                        </div>
                        <div>
                            <p class="text-sm font-bold {{ $latest->status_pengajuan == 'diterima' ? 'text-green-600' : ($latest->status_pengajuan == 'ditolak' ? 'text-red-500' : 'text-slate-400') }}">Keputusan Akhir</p>
                            <p class="text-xs text-slate-400 mt-0.5">Penetapan status kelayakan penerima bantuan oleh dewan pengawas.</p>
                        </div>
                    </div>

                </div>

                @if($latest->validasi && $latest->validasi->catatan)
                    <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Catatan Admin</p>
                        <p class="text-sm text-slate-600">{{ $latest->validasi->catatan }}</p>
                    </div>
                @endif

                <button class="flex items-center justify-center gap-2 w-full py-3 rounded-2xl text-sm font-bold text-[#1E3A5F] bg-slate-100 hover:bg-slate-200 transition-all">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.948V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 12V5z" />
                    </svg>
                    Hubungi Petugas
                </button>

            </div>
            @endif

        </div>

    </main>

</div>

</body>
</html>