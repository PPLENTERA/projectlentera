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
<body class="bg-slate-50 text-slate-900 min-h-screen font-['Inter']">

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
                <div class="h-10 w-10 rounded-full bg-orange-100 flex items-center justify-center flex-shrink-0">
                    <span class="text-orange-600 font-bold text-sm">{{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 2)) }}</span>
                </div>
                <div class="overflow-hidden">
                    <p class="font-semibold text-sm truncate">{{ Auth::user()->name ?? 'Pengguna' }}</p>
                    <p class="text-slate-500 text-xs">Verified Citizen</p>
                </div>
            </div>

            <nav class="space-y-1 flex-1">
                <a href="{{ route('masyarakat.dashboard') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-600 hover:bg-slate-100 font-medium transition-colors">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Overview
                </a>
                <a href="{{ route('masyarakat.pengajuan.index') }}" class="flex items-center gap-3 rounded-2xl bg-white border border-slate-200 text-slate-900 px-4 py-3 shadow-sm font-medium">
                    <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Pengajuan Saya
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
                        <span class="ml-auto bg-red-100 text-red-650 text-xs font-bold px-2 py-0.5 rounded-full">{{ $unreadNotificationsCount }}</span>
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
                    <h1 class="text-3xl font-extrabold text-slate-900 font-['Plus_Jakarta_Sans'] tracking-tight">Riwayat & Status</h1>
                    <p class="text-sm text-slate-500 mt-1">Pantau perkembangan permohonan bantuan Anda secara real-time dengan transparansi penuh.</p>
                </div>
                <div class="flex items-center gap-4">
                    <div class="bg-white rounded-full px-5 py-2.5 flex items-center gap-2 shadow-sm border border-slate-200">
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
            </header>

            @if(session('success'))
                <div class="bg-green-50 text-green-600 text-sm p-4 rounded-2xl border border-green-100 mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-12 gap-6">

                <div class="col-span-12 {{ $selected ? 'lg:col-span-8' : '' }} flex flex-col gap-6">

                    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
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

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-white rounded-3xl p-5 flex items-center gap-4 shadow-sm border border-slate-200">
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
                        <div class="bg-white rounded-3xl p-5 flex items-center gap-4 shadow-sm border border-slate-200">
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

                @if($selected)
                @php $latest = $selected; @endphp
                <div class="col-span-12 lg:col-span-4 bg-white rounded-3xl shadow-sm p-6 flex flex-col gap-6 h-fit border border-slate-200">

                    {{-- Header --}}
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-bold text-[#1E3A5F]">Detail Progress</h3>
                        <span class="text-xs font-bold text-slate-400 bg-slate-100 px-3 py-1 rounded-full">
                            LT-{{ str_pad($latest->id_pengajuan, 4, '0', STR_PAD_LEFT) }}
                        </span>
                    </div>

                    {{-- Progress Steps --}}
                    <div class="flex flex-col gap-0 relative">
                        <div class="absolute left-3.5 top-4 bottom-4 w-0.5 bg-slate-100"></div>

                        {{-- Step 1: Permohonan Dikirim --}}
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

                        {{-- Step 2: Verifikasi Dokumen --}}
                        @php
                            $docPassed = in_array($latest->status_pengajuan, ['diverifikasi', 'diterima']) || 
                                         ($latest->status_pengajuan == 'ditolak' && $latest->validasi && $latest->validasi->status_validasi == 'valid');
                            $docFailed = $latest->status_pengajuan == 'ditolak' && (!$latest->validasi || $latest->validasi->status_validasi == 'tidak_valid');
                        @endphp
                        <div class="flex gap-4 pb-6 relative">
                            <div class="w-7 h-7 rounded-full {{ $docPassed ? 'bg-green-500' : ($docFailed ? 'bg-red-500' : 'bg-slate-200') }} flex items-center justify-center flex-shrink-0 z-10">
                                @if($docPassed)
                                    <svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                    </svg>
                                @elseif($docFailed)
                                    <svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                @else
                                    <div class="w-2 h-2 rounded-full bg-slate-400"></div>
                                @endif
                            </div>
                            <div>
                                <p class="text-sm font-bold {{ ($docPassed || $docFailed) ? 'text-[#1E3A5F]' : 'text-slate-400' }}">
                                    @if($docFailed)
                                        Verifikasi Dokumen: Ditolak
                                    @else
                                        Verifikasi Dokumen
                                    @endif
                                </p>
                                <p class="text-xs text-slate-400 mt-0.5">Tim kurator telah memvalidasi kelengkapan dokumen persyaratan.</p>
                                @if($latest->validasi && $latest->validasi->tanggal_verifikasi)
                                    <p class="text-xs text-slate-300 mt-1">{{ \Carbon\Carbon::parse($latest->validasi->tanggal_verifikasi)->format('d M Y') }}</p>
                                @endif
                            </div>
                        </div>

                        {{-- Step 3: Survei Lapangan --}}
                        @php
                            $hasSurvey = $latest->validasi && $latest->validasi->tanggal_pengambilan;
                            $surveyComplete = $latest->status_pengajuan == 'diterima';
                            $surveyRejected = $latest->status_pengajuan == 'ditolak' && $latest->validasi && $latest->validasi->status_validasi == 'valid';
                            $surveyActive = $latest->status_pengajuan == 'diverifikasi';
                        @endphp
                        <div class="flex gap-4 pb-6 relative">
                            <div class="w-7 h-7 rounded-full {{ $surveyComplete ? 'bg-green-500' : ($surveyRejected ? 'bg-red-500' : ($surveyActive ? 'bg-blue-500' : 'bg-slate-200')) }} flex items-center justify-center flex-shrink-0 z-10">
                                @if($surveyComplete)
                                    <svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                    </svg>
                                @elseif($surveyRejected)
                                    <svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                @elseif($surveyActive)
                                    <svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                @else
                                    <div class="w-2 h-2 rounded-full bg-slate-400"></div>
                                @endif
                            </div>
                            <div>
                                <p class="text-sm font-bold {{ ($surveyActive || $surveyComplete || $surveyRejected) ? 'text-[#1E3A5F]' : 'text-slate-400' }}">
                                    @if($surveyRejected)
                                        Survei Lapangan: Ditolak
                                    @else
                                        Survei Lapangan
                                    @endif
                                </p>
                                <p class="text-xs text-slate-400 mt-0.5">
                                    @if($surveyRejected)
                                        Pengajuan ditolak pada tahap penentuan hasil survei.
                                    @elseif($hasSurvey)
                                        Jadwal survei lapangan untuk pengecekan kelayakan kondisi tempat tinggal secara langsung.
                                    @else
                                        Menunggu penentuan jadwal survei kondisi lapangan oleh petugas.
                                    @endif
                                </p>
                                @if($hasSurvey && !$surveyRejected)
                                    <p class="text-xs text-blue-600 font-semibold mt-1">
                                        📅 Jadwal: {{ \Carbon\Carbon::parse($latest->validasi->tanggal_pengambilan)->format('d M Y') }}
                                        @if($latest->validasi->waktu_pengambilan)
                                             - {{ \Carbon\Carbon::parse($latest->validasi->waktu_pengambilan)->format('H:i') }} WIB
                                        @endif
                                    </p>
                                @endif
                            </div>
                        </div>

                        {{-- Step 4: Keputusan Akhir --}}
                        <div class="flex gap-4 relative">
                            <div class="w-7 h-7 rounded-full {{ $latest->status_pengajuan == 'diterima' ? 'bg-green-500' : ($latest->status_pengajuan == 'ditolak' ? 'bg-red-500' : 'bg-slate-200') }} flex items-center justify-center flex-shrink-0 z-10">
                                @if($latest->status_pengajuan == 'diterima')
                                    <svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                    </svg>
                                @elseif($isRejected)
                                    <svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                @else
                                    <div class="w-2 h-2 rounded-full bg-slate-400"></div>
                                @endif
                            </div>
                            <div>
                                <p class="text-sm font-bold {{ $latest->status_pengajuan == 'diterima' ? 'text-green-600' : ($latest->status_pengajuan == 'ditolak' ? 'text-red-500' : 'text-slate-400') }}">
                                    @if($latest->status_pengajuan == 'diterima')
                                        Keputusan Akhir: Diterima
                                    @elseif($latest->status_pengajuan == 'ditolak')
                                        Keputusan Akhir: Ditolak
                                    @else
                                        Keputusan Akhir
                                    @endif
                                </p>
                                <p class="text-xs text-slate-400 mt-0.5">Penetapan status kelayakan penerima bantuan oleh dewan pengawas.</p>
                            </div>
                        </div>
                    </div>

                    {{-- Catatan Admin --}}
                    @if($latest->validasi && $latest->validasi->catatan)
                        <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100">
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Catatan Admin</p>
                            <p class="text-sm text-slate-600">{{ $latest->validasi->catatan }}</p>
                        </div>
                    @endif



                </div>
                @endif

            </div> {{-- grid-cols-12 --}}

        </main>

    </div> {{-- grid-cols-12 p-6 --}}
</div> {{-- min-h-screen --}}

</body>
</html>