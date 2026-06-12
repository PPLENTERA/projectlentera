<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Masyarakat</title>
    @vite(['resources/css/app.css'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
</head>
<body class="bg-slate-50 text-slate-900">
    <div class="min-h-screen">
        <div class="grid grid-cols-12 gap-6 p-6">

            {{-- ===== SIDEBAR ===== --}}
            <aside class="col-span-12 xl:col-span-3 bg-white rounded-3xl border border-slate-200 p-6 shadow-sm flex flex-col sticky top-6 h-max">
                <div class="flex items-center gap-3 mb-6">
                    <div class="h-12 w-12 rounded-2xl bg-slate-900 text-white flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <div>
                        <p class="text-slate-900 font-semibold uppercase tracking-wider text-xs">LENTERA</p>
                        <p class="text-slate-500 text-xs font-medium uppercase tracking-wider">Panel Transparansi</p>
                    </div>
                </div>

                {{-- Profil User --}}
                <div class="flex items-center gap-3 mb-6 p-3 rounded-2xl border border-slate-100 bg-slate-50">
                    <div class="h-10 w-10 rounded-full bg-orange-100 flex items-center justify-center shrink-0">
                        <span class="text-orange-600 font-bold text-sm">{{ strtoupper(substr($authUser->name ?? 'U', 0, 2)) }}</span>
                    </div>
                    <div class="overflow-hidden">
                        <p class="font-semibold text-sm truncate">{{ $authUser->name ?? 'Pengguna' }}</p>
                        <p class="text-slate-500 text-xs">ID: {{ $authUser->id ?? '-' }}</p>
                    </div>
                </div>

                {{-- Status Pendaftaran (badge) --}}
                @if($pendaftaranUser)
                    @if($pendaftaranUser->status === 'disetujui')
                        <div class="mb-4 px-3 py-2 rounded-xl border bg-emerald-50 border-emerald-100">
                            <p class="text-xs font-semibold text-emerald-700">
                                Pendaftaran: ✅ Diterima
                            </p>
                        </div>
                    @elseif($pendaftaranUser->status === 'ditolak')
                        <div class="mb-4 px-3 py-2 rounded-xl border bg-red-50 border-red-100">
                            <p class="text-xs font-semibold text-red-600">
                                Pendaftaran: ❌ Ditolak
                            </p>
                        </div>
                    @else
                        <div class="mb-4 px-3 py-2 rounded-xl border bg-amber-50 border-amber-100">
                            <p class="text-xs font-semibold text-amber-700">
                                Pendaftaran: ⏳ Menunggu Verifikasi
                            </p>
                        </div>
                    @endif
                @else
                    <a href="{{ route('pendaftaran.create') }}" class="mb-4 flex items-center gap-2 px-3 py-2 rounded-xl bg-slate-900 text-white text-xs font-semibold hover:bg-slate-700 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Daftar Bantuan Sekarang
                    </a>
                @endif

                <nav class="space-y-1 flex-1">
                    <a href="{{ route('masyarakat.dashboard') }}" class="flex items-center gap-3 rounded-2xl bg-white border border-slate-200 text-slate-900 px-4 py-3 shadow-sm font-medium">
                        <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        Overview
                    </a>
                    <a href="{{ route('masyarakat.pengajuan.index') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-600 hover:bg-slate-100 font-medium transition-colors">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Pengajuan Saya
                        @if($pengajuanPending > 0)
                            <span class="ml-auto bg-amber-100 text-amber-700 text-xs font-bold px-2 py-0.5 rounded-full">{{ $pengajuanPending }}</span>
                        @endif
                    </a>
                    <a href="{{ route('masyarakat.pengajuan.create') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-600 hover:bg-slate-100 hover:text-slate-900 font-medium transition-colors">
                        <svg class="w-5 h-5 text-slate-400 group-hover:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Ajukan Bantuan
                    </a>
                    <a href="{{ route('masyarakat.pelaporan.create') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-600 hover:bg-slate-100 font-medium transition-colors">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        Laporkan Penyalahgunaan
                    </a>
                    <a href="{{ route('masyarakat.notifikasi.index') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-600 hover:bg-slate-100 font-medium transition-colors">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        Notifikasi & Pengingat
                        @if($unreadNotificationsCount > 0)
                            <span class="ml-auto bg-red-100 text-red-655 text-xs font-bold px-2 py-0.5 rounded-full">{{ $unreadNotificationsCount }}</span>
                        @endif
                    </a>
                    <a href="{{ url('/masyarakat/peta-bantuan') }}"
                        class="flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-600 hover:bg-slate-100 font-medium transition-colors">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Peta Bantuan
                        </a>

                        <a href="{{ url('/masyarakat/statistik-publik') }}"
                        class="flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-600 hover:bg-slate-100 font-medium transition-colors">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-6m4 6V7m4 10v-3"/>
                            </svg>
                            Statistik Bantuan
                        </a>
                    <a href="{{ route('masyarakat.feedback.create') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-600 hover:bg-slate-100 font-medium transition-colors">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                        Beri Feedback
                    </a>
                </nav>

                <div class="mt-6 pt-6 border-t border-slate-200">
                    <a href="{{ route('logout') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-red-500 hover:bg-red-50 font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Keluar
                    </a>
                </div>
            </aside>

            {{-- ===== MAIN CONTENT ===== --}}
            <main class="col-span-12 xl:col-span-9 space-y-6">
                <header class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <p class="text-sm text-slate-500">Selamat datang kembali,</p>
                        <h1 class="text-2xl font-bold text-slate-900">{{ $authUser->name ?? 'Pengguna' }} 👋</h1>
                    </div>
                    <div class="flex items-center gap-4">
                        <a href="{{ route('masyarakat.pengajuan.create') }}" class="flex items-center gap-2 bg-slate-900 text-white px-4 py-2.5 rounded-2xl text-sm font-semibold hover:bg-slate-700 transition-colors shadow">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Ajukan Bantuan
                        </a>
                        <!-- Bell Icon with Badge -->
                        <a href="{{ route('masyarakat.notifikasi.index') }}" class="relative p-2.5 text-slate-600 hover:text-slate-900 bg-white border border-slate-200 hover:bg-slate-50 rounded-2xl transition-colors shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                            @if($unreadNotificationsCount > 0)
                                <span class="absolute top-1 right-1 block h-2.5 w-2.5 rounded-full bg-red-500 ring-2 ring-white"></span>
                            @endif
                        </a>

                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 rounded-full bg-orange-100 flex items-center justify-center font-bold text-orange-600">
                                {{ strtoupper(substr($authUser->name ?? 'U', 0, 2)) }}
                            </div>
                        </div>
                    </div>
                </header>

                {{-- ===== STAT CARDS ===== --}}
                <section class="grid gap-4 xl:grid-cols-4">
                    <article class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200 flex flex-col justify-between">
                        <div class="flex items-center justify-between mb-4">
                            <div class="h-10 w-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <span class="text-xs font-semibold text-emerald-600">Personal</span>
                        </div>
                        <p class="text-xs text-slate-500 font-medium uppercase tracking-wider mb-1">Total Bantuan Diterima</p>
                        <p class="text-2xl font-bold text-slate-900 mb-2">Rp {{ number_format($totalBantuan, 0, ',', '.') }}</p>
                        <p class="text-xs text-slate-400">Akumulasi bantuan Anda</p>
                    </article>

                    <article class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200 flex flex-col justify-between">
                        <div class="flex items-center justify-between mb-4">
                            <div class="h-10 w-10 rounded-full bg-amber-50 flex items-center justify-center text-amber-505 text-amber-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                            </div>
                            <span class="text-xs font-medium text-amber-500">Pending</span>
                        </div>
                        <p class="text-xs text-slate-500 font-medium uppercase tracking-wider mb-1">Pengajuan Pending</p>
                        <p class="text-2xl font-bold text-slate-900 mb-2">{{ str_pad($pengajuanPending, 2, '0', STR_PAD_LEFT) }} Unit</p>
                        <p class="text-xs text-slate-400">Menunggu verifikasi RT/RW</p>
                    </article>

                    <article class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200 flex flex-col justify-between">
                        <div class="flex items-center justify-between mb-4">
                            <div class="h-10 w-10 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <span class="text-xs font-semibold text-emerald-600">Clear</span>
                        </div>
                        <p class="text-xs text-slate-500 font-medium uppercase tracking-wider mb-1">Disetujui</p>
                        <p class="text-2xl font-bold text-slate-900 mb-2">{{ str_pad($disetujui, 2, '0', STR_PAD_LEFT) }} Program</p>
                        <p class="text-xs text-slate-400">Terverifikasi sistem pusat</p>
                    </article>

                    <article class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200 flex flex-col justify-between">
                        <div class="flex items-center justify-between mb-4">
                            <div class="h-10 w-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <span class="text-xs font-medium text-slate-505 text-slate-550 text-slate-500">{{ $ditolak > 0 ? $ditolak.' Baru' : 'Nihil' }}</span>
                        </div>
                        <p class="text-xs text-slate-500 font-medium uppercase tracking-wider mb-1">Ditolak</p>
                        <p class="text-2xl font-bold text-slate-900 mb-2">{{ str_pad($ditolak, 2, '0', STR_PAD_LEFT) }} Berkas</p>
                        <p class="text-xs text-slate-400">Perlu perbaikan data NIK</p>
                    </article>
                </section>

                {{-- ===== WIDGET STATUS PENGAJUAN TERBARU ===== --}}
                @if($pengajuanTerbaru->count() > 0)
                <section>
                    <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-semibold text-slate-900">Status Pengajuan Anda</h2>
                            <a href="{{ route('masyarakat.pengajuan.index') }}" class="text-blue-600 text-sm font-semibold hover:underline">Lihat Semua</a>
                        </div>
                        <div class="space-y-3">
                            @foreach($pengajuanTerbaru as $pj)
                            <div class="flex items-center justify-between p-4 rounded-2xl bg-slate-50 border border-slate-100">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10 rounded-xl bg-slate-900 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-sm text-slate-900">{{ $pj->jenis_bantuan }}</p>
                                        <p class="text-xs text-slate-400">{{ $pj->tanggal_pengajuan }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    @if($pj->validasi && $pj->validasi->catatan)
                                        <p class="text-xs text-slate-500 hidden md:block max-w-xs truncate">{{ $pj->validasi->catatan }}</p>
                                    @endif
                                    @if($pj->status_pengajuan == 'pending')
                                        <span class="text-xs font-bold bg-amber-50 text-amber-600 px-3 py-1.5 rounded-full whitespace-nowrap">⏳ Pending</span>
                                    @elseif($pj->status_pengajuan == 'diverifikasi')
                                        <span class="text-xs font-bold bg-blue-50 text-blue-600 px-3 py-1.5 rounded-full whitespace-nowrap">🔍 Diverifikasi</span>
                                    @elseif($pj->status_pengajuan == 'diterima')
                                        <span class="text-xs font-bold bg-emerald-50 text-emerald-600 px-3 py-1.5 rounded-full whitespace-nowrap">✅ Diterima</span>
                                    @elseif($pj->status_pengajuan == 'ditolak')
                                        <span class="text-xs font-bold bg-red-50 text-red-650 px-3 py-1.5 rounded-full whitespace-nowrap">❌ Ditolak</span>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>
                @else
                {{-- Empty state: belum ada pengajuan --}}
                <section>
                    <div class="rounded-3xl bg-white p-8 shadow-sm border border-slate-200 text-center">
                        <div class="h-16 w-16 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <h3 class="font-semibold text-slate-900 mb-1">Belum ada pengajuan</h3>
                        <p class="text-sm text-slate-400 mb-4">Ajukan bantuan sekarang dan pantau statusnya di sini.</p>
                        <a href="{{ route('masyarakat.pengajuan.create') }}" class="inline-flex items-center gap-2 bg-slate-900 text-white px-5 py-2.5 rounded-2xl text-sm font-semibold hover:bg-slate-700 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Ajukan Sekarang
                        </a>
                    </div>
                </section>
                @endif


                {{-- ===== CHART PROGRESS PER WILAYAH ===== --}}
                <section class="grid gap-6">
                    <div class="col-span-12 rounded-3xl bg-white p-6 shadow-sm border border-slate-200 flex flex-col">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h2 class="text-lg font-semibold text-slate-900">Progress Bantuan per Wilayah</h2>
                                <p class="text-sm text-slate-500">Persentase permohonan yang telah disetujui per desa</p>
                            </div>
                        </div>
                        <div class="relative h-64 w-full">
                            <canvas id="wilayahProgressChart"></canvas>
                        </div>
                    </div>
                </section>

                {{-- ===== CHART PENYALURAN ===== --}}
                <section class="grid gap-6">
                    <div class="col-span-12 rounded-3xl bg-white p-6 shadow-sm border border-slate-200 flex flex-col">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h2 class="text-lg font-semibold text-slate-900">Penyaluran Bantuan Bulanan</h2>
                                <p class="text-sm text-slate-500">Data real-time penyaluran dana bansos wilayah</p>
                            </div>
                            <div class="flex gap-4 items-center">
                                <div class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full" style="background-color: #3b82f6;"></span><span class="text-xs text-slate-600 font-semibold">Pendidikan</span></div>
                                <div class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full" style="background-color: #10b981;"></span><span class="text-xs text-slate-600 font-semibold">Kesehatan</span></div>
                                <div class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full" style="background-color: #f59e0b;"></span><span class="text-xs text-slate-600 font-semibold">Pangan</span></div>
                                <div class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full" style="background-color: #8b5cf6;"></span><span class="text-xs text-slate-600 font-semibold">Perumahan</span></div>
                            </div>
                        </div>
                        <div class="relative h-64 w-full">
                            <canvas id="penyaluranChart"></canvas>
                        </div>
                    </div>
                </section>

                {{-- ===== KATEGORI & LAPORAN ===== --}}
                <section class="grid gap-6 xl:grid-cols-12">
                    {{-- Kategori Bantuan Donut --}}
                    <div class="col-span-12 xl:col-span-5 rounded-3xl bg-white p-6 shadow-sm border border-slate-200 flex flex-col">
                        <h2 class="text-lg font-semibold text-slate-900 mb-4">Kategori Bantuan</h2>
                        <div class="relative flex items-center justify-center my-2">
                            <div class="relative w-44 h-44">
                                <canvas id="kategoriChart"></canvas>
                                <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                                    <span class="text-3xl font-bold text-slate-900" id="kategoriTotal">{{ $categoriesList->sum('count') }}</span>
                                    <span class="text-[10px] font-semibold text-slate-400 uppercase tracking-widest mt-0.5">Program</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 space-y-2">
                            @foreach($categoriesList->filter(fn($i) => $i['percentage'] > 0) as $item)
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full shrink-0" style="background-color: {{ $item['hex'] }}"></span>
                                    <span class="text-sm text-slate-600 font-medium">{{ $item['name'] }}</span>
                                </div>
                                <span class="text-sm font-semibold text-slate-800">{{ $item['percentage'] }}%</span>
                            </div>
                            @endforeach
                            @if($categoriesList->filter(fn($i) => $i['percentage'] > 0)->isEmpty())
                            <p class="text-xs text-slate-400 text-center py-4">Belum ada data pengajuan bantuan.</p>
                            @endif
                        </div>
                    </div>

                    {{-- Aktivitas Laporan Terkini (milik user) --}}
                    <div class="col-span-12 xl:col-span-7 rounded-3xl bg-white p-6 shadow-sm border border-slate-200 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="text-lg font-semibold text-slate-900">Riwayat Laporan Penyalahgunaan</h2>
                                <a href="{{ route('masyarakat.pelaporan.create') }}" class="text-blue-600 text-sm font-semibold hover:underline">+ Laporan Baru</a>
                            </div>
                            <div class="space-y-4">
                                @forelse($recent as $item)
                                    <div class="flex items-start gap-4">
                                        <div class="h-12 w-12 rounded-2xl bg-slate-900 text-white flex items-center justify-center shrink-0">
                                            @if($item['icon'] == 'beras')
                                                <svg class="w-6 h-6 text-orange-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                            @elseif($item['icon'] == 'buku')
                                                <svg class="w-6 h-6 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                            @else
                                                <svg class="w-6 h-6 text-emerald-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                                            @endif
                                        </div>
                                        <div class="flex-1 border-b border-slate-100 pb-4 last:border-0 last:pb-0">
                                            <div class="flex justify-between items-start">
                                                <h3 class="font-semibold text-slate-900 text-sm">{{ $item['judul'] }}</h3>
                                                <span class="text-xs text-slate-400 whitespace-nowrap ml-4">{{ $item['waktu'] }}</span>
                                            </div>
                                            <p class="text-sm text-slate-500 mt-1 leading-relaxed">{{ $item['deskripsi'] }}</p>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-6">
                                        <p class="text-sm text-slate-400">Belum ada aktivitas. Mulai dengan mengajukan bantuan!</p>
                                        <a href="{{ route('masyarakat.pengajuan.create') }}" class="mt-3 inline-flex items-center gap-1 text-blue-600 text-sm font-semibold hover:underline">
                                            Ajukan sekarang <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                        </a>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </div>

    <script>
        // Chart Progress Per Wilayah
        const wilayahProgressData = @json($wilayahProgress->values());
        const wilayahLabels = wilayahProgressData.map(item => item.wilayah);
        const wilayahProgress = wilayahProgressData.map(item => item.progress);
        const wilayahColors = wilayahProgressData.map(item => {
            if (item.progress >= 75) return '#10b981'; // emerald
            if (item.progress >= 50) return '#3b82f6'; // blue
            if (item.progress >= 25) return '#f59e0b'; // amber
            return '#ef4444'; // red
        });

        new Chart(document.getElementById('wilayahProgressChart'), {
            type: 'bar',
            data: {
                labels: wilayahLabels,
                datasets: [{
                    label: 'Progress Persetujuan (%)',
                    data: wilayahProgress,
                    backgroundColor: wilayahColors,
                    borderRadius: 6,
                    barPercentage: 0.6,
                    categoryPercentage: 0.5
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: ctx => `${ctx.parsed.x}% Disetujui`
                        }
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        max: 100,
                        grid: { color: '#e2e8f0' },
                        ticks: { font: { size: 10, weight: 'bold' }, color: '#64748b' }
                    },
                    y: {
                        grid: { display: false },
                        ticks: { font: { size: 10, weight: 'bold' }, color: '#64748b' }
                    }
                }
            }
        });

        const penyaluranBulanan = @json($penyaluranBulanan);

        const labelsPenyaluran = penyaluranBulanan.map(item => item.bulan);
        const dataPendidikan = penyaluranBulanan.map(item => item.pendidikan);
        const dataKesehatan = penyaluranBulanan.map(item => item.kesehatan);
        const dataPangan = penyaluranBulanan.map(item => item.pangan);
        const dataPerumahan = penyaluranBulanan.map(item => item.perumahan);

        new Chart(document.getElementById('penyaluranChart'), {
            type: 'bar',
            data: {
                labels: labelsPenyaluran,
                datasets: [
                    { label: 'Pendidikan', data: dataPendidikan, backgroundColor: '#3b82f6', borderRadius: 4, barPercentage: 0.6, categoryPercentage: 0.4 },
                    { label: 'Kesehatan', data: dataKesehatan, backgroundColor: '#10b981', borderRadius: 4, barPercentage: 0.6, categoryPercentage: 0.4 },
                    { label: 'Pangan', data: dataPangan, backgroundColor: '#f59e0b', borderRadius: 4, barPercentage: 0.6, categoryPercentage: 0.4 },
                    { label: 'Perumahan', data: dataPerumahan, backgroundColor: '#8b5cf6', borderRadius: 4, barPercentage: 0.6, categoryPercentage: 0.4 }
                ]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { display: false }, ticks: { font: { size: 12, weight: 'bold' }, color: '#64748b' } },
                    y: { display: false, grid: { display: false } }
                }
            }
        });

        const kategoriData = @json($categoriesList->filter(fn($i) => $i['percentage'] > 0)->values());
        const hasKategoriData = kategoriData.length > 0 && kategoriData.some(i => i.count > 0);

        if (hasKategoriData) {
            new Chart(document.getElementById('kategoriChart'), {
                type: 'doughnut',
                data: {
                    labels: kategoriData.map(i => i.name),
                    datasets: [{ data: kategoriData.map(i => i.count), backgroundColor: kategoriData.map(i => i.hex), borderWidth: 0, hoverOffset: 6 }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false, cutout: '72%',
                    plugins: {
                        legend: { display: false },
                        tooltip: { callbacks: { label: ctx => ` ${ctx.label}: ${ctx.parsed} program (${kategoriData[ctx.dataIndex].percentage}%)` } }
                    }
                }
            });
        } else {
            new Chart(document.getElementById('kategoriChart'), {
                type: 'doughnut',
                data: { datasets: [{ data: [1], backgroundColor: ['#e2e8f0'], borderWidth: 0 }] },
                options: { responsive: true, maintainAspectRatio: false, cutout: '72%', plugins: { legend: { display: false }, tooltip: { enabled: false } } }
            });
        }
    </script>
</body>
</html>
