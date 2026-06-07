<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pengajuan - LENTERA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F3F4F6] min-h-screen p-6 font-['Inter']">

<div class="max-w-4xl mx-auto">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-[#1C2C4E]">Status Pengajuan</h1>
            <p class="text-sm text-slate-500 mt-1">Pantau perkembangan pengajuan bantuan Anda.</p>
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

    <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-2xl shadow p-5">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Total Pengajuan</p>
            <p class="text-2xl font-bold text-[#1C2C4E]">{{ $pengajuan->count() }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow p-5">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Pending</p>
            <p class="text-2xl font-bold text-yellow-500">{{ $pengajuan->where('status_pengajuan', 'pending')->count() }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow p-5">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Diterima</p>
            <p class="text-2xl font-bold text-green-500">{{ $pengajuan->where('status_pengajuan', 'diterima')->count() }}</p>
        </div>
    </div>

    @forelse($pengajuan as $item)
        <div class="bg-white rounded-2xl shadow p-6 mb-4">

            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Jenis Bantuan</p>
                    <p class="text-base font-bold text-[#1C2C4E]">{{ $item->jenis_bantuan }}</p>
                </div>

                @if($item->status_pengajuan == 'pending')
                    <span class="text-xs font-bold bg-yellow-50 text-yellow-600 px-3 py-1.5 rounded-full">
                        ⏳ Pending
                    </span>
                @elseif($item->status_pengajuan == 'diverifikasi')
                    <span class="text-xs font-bold bg-blue-50 text-blue-600 px-3 py-1.5 rounded-full">
                        🔍 Diverifikasi
                    </span>
                @elseif($item->status_pengajuan == 'diterima')
                    <span class="text-xs font-bold bg-green-50 text-green-600 px-3 py-1.5 rounded-full">
                        ✅ Diterima
                    </span>
                @elseif($item->status_pengajuan == 'ditolak')
                    <span class="text-xs font-bold bg-red-50 text-red-600 px-3 py-1.5 rounded-full">
                        ❌ Ditolak
                    </span>
                @endif
            </div>

            <div class="grid grid-cols-3 gap-4 text-sm mb-4">
                <div>
                    <p class="text-xs text-slate-400 font-semibold uppercase tracking-widest mb-1">Penghasilan</p>
                    <p class="font-semibold text-slate-700">Rp {{ number_format($item->penghasilan, 0, ',', '.') }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-400 font-semibold uppercase tracking-widest mb-1">Tanggungan</p>
                    <p class="font-semibold text-slate-700">{{ $item->jumlah_tanggungan }} orang</p>
                </div>
                <div>
                    <p class="text-xs text-slate-400 font-semibold uppercase tracking-widest mb-1">Tanggal</p>
                    <p class="font-semibold text-slate-700">{{ $item->tanggal_pengajuan }}</p>
                </div>
            </div>

<<<<<<< Updated upstream
            @if($item->dokumen->count() > 0)
                <div class="border-t border-slate-100 pt-4 mb-4">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Dokumen Terupload</p>
                    <div class="flex gap-2 flex-wrap">
                        @foreach($item->dokumen as $dok)
                            <span class="text-xs font-semibold bg-[#F0F2F5] text-slate-600 px-3 py-1 rounded-lg uppercase">
                                {{ $dok->jenis_dokumen }}
                            </span>
                        @endforeach
=======
    <main class="ml-72 flex-1 p-10">

        <div class="flex items-start justify-between mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-[#1E3A5F] font-['Plus_Jakarta_Sans'] tracking-tight">Riwayat & Status</h1>
                <p class="text-sm text-slate-500 mt-1">Pantau perkembangan permohonan bantuan Anda secara real-time dengan transparansi penuh.</p>
            </div>
            <div class="flex items-center gap-3">
                <!-- Notification Bell -->
                <div class="relative" id="notification-bell-container">
                    <button id="notification-bell-btn" class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-slate-500 hover:text-slate-800 shadow-sm relative transition-all">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span id="notification-count-badge" class="hidden absolute -top-0.5 -right-0.5 bg-red-500 text-white text-[9px] font-bold w-4 h-4 rounded-full flex items-center justify-center animate-pulse">0</span>
                    </button>
                    <!-- Dropdown -->
                    <div id="notification-dropdown" class="hidden absolute right-0 mt-2 w-80 bg-white rounded-2xl shadow-xl border border-slate-100 z-50 overflow-hidden">
                        <div class="p-4 border-b border-slate-50 flex justify-between items-center bg-slate-50">
                            <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Notifikasi</h4>
                            <button onclick="window.markAllNotificationsRead()" class="text-[10px] text-blue-600 font-bold hover:underline">Tandai semua dibaca</button>
                        </div>
                        <div id="notification-list" class="max-h-64 overflow-y-auto divide-y divide-slate-50">
                            <!-- Loaded via Ajax -->
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-full px-5 py-2.5 flex items-center gap-2 shadow-sm">
                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" placeholder="Cari ID atau Jenis Bantuan" class="bg-transparent text-sm text-slate-600 outline-none w-44">
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
                                <tr class="hover:bg-[#F8F9FA] transition-colors cursor-pointer">
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
>>>>>>> Stashed changes
                    </div>
                </div>
            @endif

            @if($item->validasi && $item->validasi->catatan)
                <div class="border-t border-slate-100 pt-4">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Catatan Admin</p>
                    <p class="text-sm text-slate-600">{{ $item->validasi->catatan }}</p>
                </div>
            @endif

        </div>
    @empty
        <div class="bg-white rounded-2xl shadow p-10 text-center">
            <p class="text-slate-400 text-sm mb-4">Belum ada pengajuan bantuan.</p>
            <a href="{{ route('masyarakat.pengajuan.create') }}"
                class="inline-flex items-center px-5 py-2.5 rounded-xl text-sm font-bold text-white bg-gradient-to-r from-[#172545] to-[#1F335C] shadow hover:shadow-lg transition-all">
                Ajukan Sekarang
            </a>
        </div>
    @endforelse

</div>

</body>
</html>