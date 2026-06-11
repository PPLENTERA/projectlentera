<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validasi & Verifikasi - LENTERA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F3F4F6] min-h-screen p-6 font-['Inter']">

<div class="max-w-5xl mx-auto">

    <div class="mb-6 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-[#1C2C4E]">Validasi & Verifikasi</h1>
            <p class="text-sm text-slate-500 mt-1">Periksa dan validasi dokumen pengajuan bantuan masuk.</p>
        </div>

    </div>
@extends('layouts.admin')

@section('title', 'Validasi & Verifikasi')

@section('content')

<div class="flex flex-col gap-12">

    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-extrabold text-[#022448] font-['Plus_Jakarta_Sans'] tracking-tight">
                Validasi & Verifikasi
            </h1>
            <p class="text-base text-slate-500 mt-1">
                Periksa dan validasi data pengajuan bantuan masuk.
            </p>
        </div>
        <div class="flex items-center gap-3">
            <div class="bg-[#E7E8E9] rounded-full px-6 py-3 flex items-center gap-2">
                <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" placeholder="Cari pemohon..." class="bg-transparent text-sm text-slate-600 outline-none w-40">
            </div>
            <div class="w-10 h-10 rounded-full bg-[#D5E3FF] border-2 border-[#D5E3FF] flex items-center justify-center text-xs font-bold text-[#022448]">
                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
            </div>
        </div>
    </div>

    <div class="grid grid-cols-3 gap-4">
        <div class="bg-white rounded-3xl p-6">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Total Pengajuan</p>
            <p class="text-3xl font-extrabold text-[#022448] font-['Plus_Jakarta_Sans']">{{ $pengajuan->count() }}</p>
        </div>
        <div class="bg-white rounded-3xl p-6">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Pending</p>
            <p class="text-3xl font-extrabold text-yellow-500 font-['Plus_Jakarta_Sans']">{{ $pengajuan->where('status_pengajuan', 'pending')->count() }}</p>
        </div>
        <div class="bg-white rounded-3xl p-6">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Diverifikasi</p>
            <p class="text-3xl font-extrabold text-green-500 font-['Plus_Jakarta_Sans']">{{ $pengajuan->where('status_pengajuan', 'diverifikasi')->count() }}</p>
        </div>
    </div>

    <form action="{{ route('admin.validasi.index') }}" method="GET" class="bg-[#F3F4F5] rounded-3xl px-6 py-4 flex gap-4 items-end">
        
        <div class="flex flex-col gap-2 flex-1">
            <label class="text-[0.65rem] font-bold text-slate-400 uppercase tracking-widest">Jenis Bantuan</label>
            <select name="jenis_bantuan" class="w-full px-4 py-2.5 bg-white rounded-lg text-sm font-medium text-slate-800 outline-none">
                <option value="">Semua Bantuan</option>
                <option value="Bantuan Pangan" {{ request('jenis_bantuan') == 'Bantuan Pangan' ? 'selected' : '' }}>Bantuan Pangan</option>
                <option value="Bantuan Kesehatan" {{ request('jenis_bantuan') == 'Bantuan Kesehatan' ? 'selected' : '' }}>Bantuan Kesehatan</option>
                <option value="Bantuan Pendidikan" {{ request('jenis_bantuan') == 'Bantuan Pendidikan' ? 'selected' : '' }}>Bantuan Pendidikan</option>
                <option value="Bantuan Perumahan" {{ request('jenis_bantuan') == 'Bantuan Perumahan' ? 'selected' : '' }}>Bantuan Perumahan</option>
            </select>
        </div>
        <div class="flex flex-col gap-2 flex-1">
            <label class="text-[0.65rem] font-bold text-slate-400 uppercase tracking-widest">Status Verifikasi</label>
            <select name="status" class="w-full px-4 py-2.5 bg-white rounded-lg text-sm font-medium text-slate-800 outline-none">
                <option value="">Semua</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Belum Diverifikasi</option>
                <option value="diverifikasi" {{ request('status') == 'diverifikasi' ? 'selected' : '' }}>Sudah Diverifikasi</option>
                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </div>
        <button type="submit" class="bg-[#022448] text-white text-sm font-bold px-8 py-2.5 rounded-full h-fit">
            Terapkan Filter
        </button>
        @if(request('status') || request('jenis_bantuan'))
            <a href="{{ route('admin.validasi.index') }}" 
                class="text-sm font-bold text-slate-400 hover:text-slate-600 px-4 py-2.5 h-fit">
                Reset
            </a>
        @endif

    </form>

    @if(session('success'))
        <div class="bg-green-50 text-green-600 text-sm p-4 rounded-2xl border border-green-100">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-col gap-4">
        @forelse($pengajuan as $item)
            <div class="bg-white rounded-3xl p-6 flex items-center justify-between
                {{ $item->status_pengajuan == 'pending' ? 'shadow-[0_0_40px_-10px_rgba(249,189,34,0.3)]' : '' }}
                overflow-hidden relative">

                @if($item->status_pengajuan == 'pending')
                    <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-yellow-400"></div>
                @elseif($item->status_pengajuan == 'diverifikasi')
                    <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-green-400"></div>
                @elseif($item->status_pengajuan == 'ditolak')
                    <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-red-400"></div>
                @endif

                <div class="flex items-center gap-8 pl-4">
                    <div class="w-12 h-12 rounded-full bg-[#E7E8E9] flex items-center justify-center text-sm font-bold text-[#022448]">
                        {{ strtoupper(substr($item->user->name ?? 'U', 0, 2)) }}
                    </div>
                    <div>
                        <p class="text-lg font-bold text-[#022448]">{{ $item->user->name ?? '-' }}</p>
                        <p class="text-xs text-slate-400 uppercase tracking-widest">{{ $item->jenis_bantuan }} • {{ $item->tanggal_pengajuan }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-12">
                    {{-- Status Badge --}}
                    @if($item->status_pengajuan == 'pending')
                        <span class="bg-yellow-100 text-yellow-700 text-xs font-bold px-4 py-2 rounded-full uppercase tracking-widest">
                            Pending
                        </span>
                    @elseif($item->status_pengajuan == 'diverifikasi')
                        <span class="bg-green-100 text-green-700 text-xs font-bold px-4 py-2 rounded-full uppercase tracking-widest">
                            Diverifikasi
                        </span>
                    @elseif($item->status_pengajuan == 'ditolak')
                        <span class="bg-red-100 text-red-700 text-xs font-bold px-4 py-2 rounded-full uppercase tracking-widest">
                            Ditolak
                        </span>
                    @endif

                    {{-- Tombol Periksa --}}
                    <a href="{{ route('admin.validasi.show', $item->id_pengajuan) }}"
                        class="bg-gradient-to-br from-[#022448] to-[#1E3A5F] text-white text-sm font-bold px-8 py-3 rounded-3xl hover:shadow-lg hover:-translate-y-0.5 transition-all">
                        Periksa
                    </a>
                </div>

            </div>
        @empty
            <div class="bg-white rounded-3xl p-12 text-center">
                <p class="text-slate-400 text-sm">Belum ada pengajuan masuk.</p>
            </div>
        @endforelse
    </div>

    <div class="flex items-center justify-between border-t border-slate-100 pt-6">
        <p class="text-sm text-slate-500">
            Showing <span class="font-bold text-[#022448]">{{ $pengajuan->count() }}</span> pengajuan
        </p>
    </div>

</div>



</body>
</html>
@endsection
