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

<div class="space-y-6">

    {{-- Header --}}
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-[#1C2C4E]">Validasi Pengajuan Bantuan</h1>
            <p class="text-sm text-slate-500 mt-1">Verifikasi berkas persyaratan dan hitung kelayakan pemohon secara sistematis.</p>
        </div>
    </div>

    {{-- Sub-navigation --}}
    <div class="flex gap-6 mb-6 border-b border-slate-200">
        <a href="{{ route('admin.validasi.index') }}" 
           class="text-sm font-bold text-[#1C2C4E] border-b-2 border-[#1C2C4E] pb-3 transition-all">
            Validasi & Verifikasi
        </a>
        <a href="{{ route('admin.scoring_indicators.index') }}" 
           class="text-sm font-semibold text-slate-500 hover:text-[#1C2C4E] pb-3 transition-all">
            Indikator Scoring
        </a>
        <a href="{{ route('admin.validasi.penentuan') }}" 
           class="text-sm font-semibold text-slate-500 hover:text-[#1C2C4E] pb-3 transition-all">
            Penentuan Penerima
        </a>
    </div>

    {{-- Stat Cards --}}
    <section class="grid gap-6 grid-cols-1 md:grid-cols-3">
        <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-200">
            <p class="text-xs text-slate-500 font-bold uppercase tracking-wider mb-1">Total Pengajuan</p>
            <p class="text-3xl font-extrabold text-slate-900">{{ $pengajuan->count() }}</p>
        </article>
        <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-200">
            <p class="text-xs text-slate-500 font-bold uppercase tracking-wider mb-1">Pending</p>
            <p class="text-3xl font-extrabold text-amber-600">{{ $pengajuan->where('status_pengajuan', 'pending')->count() }}</p>
        </article>
        <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-200">
            <p class="text-xs text-slate-500 font-bold uppercase tracking-wider mb-1">Diverifikasi</p>
            <p class="text-3xl font-extrabold text-emerald-600">{{ $pengajuan->where('status_pengajuan', 'diverifikasi')->count() }}</p>
        </article>
    </section>

    {{-- Filter Form --}}
    <form action="{{ route('admin.validasi.index') }}" method="GET" class="rounded-2xl bg-white p-6 shadow-sm border border-slate-200 flex flex-wrap gap-4 items-end">
        <div class="flex flex-col gap-2 flex-1 min-w-[200px]">
            <label class="text-xs font-bold text-slate-600 uppercase tracking-wider">Jenis Bantuan</label>
            <select name="jenis_bantuan" class="px-4 py-2.5 bg-slate-50 rounded-xl text-sm font-medium text-slate-800 outline-none border border-slate-200 focus:ring-2 focus:ring-cyan-600">
                <option value="">Semua Bantuan</option>
                <option value="Bantuan Pangan" {{ request('jenis_bantuan') == 'Bantuan Pangan' ? 'selected' : '' }}>Bantuan Pangan</option>
                <option value="Bantuan Kesehatan" {{ request('jenis_bantuan') == 'Bantuan Kesehatan' ? 'selected' : '' }}>Bantuan Kesehatan</option>
                <option value="Bantuan Pendidikan" {{ request('jenis_bantuan') == 'Bantuan Pendidikan' ? 'selected' : '' }}>Bantuan Pendidikan</option>
                <option value="Bantuan Perumahan" {{ request('jenis_bantuan') == 'Bantuan Perumahan' ? 'selected' : '' }}>Bantuan Perumahan</option>
            </select>
        </div>
        <div class="flex flex-col gap-2 flex-1 min-w-[200px]">
            <label class="text-xs font-bold text-slate-600 uppercase tracking-wider">Status Verifikasi</label>
            <select name="status" class="px-4 py-2.5 bg-slate-50 rounded-xl text-sm font-medium text-slate-800 outline-none border border-slate-200 focus:ring-2 focus:ring-cyan-600">
                <option value="">Semua</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Belum Diverifikasi</option>
                <option value="diverifikasi" {{ request('status') == 'diverifikasi' ? 'selected' : '' }}>Sudah Diverifikasi</option>
                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </div>
        <button type="submit" class="bg-[#1C2C4E] text-white text-xs font-bold px-6 py-3.5 rounded-xl hover:bg-[#111A31] transition-colors">
            Terapkan
        </button>
        @if(request('status') || request('jenis_bantuan'))
            <a href="{{ route('admin.validasi.index') }}" class="text-xs font-bold text-slate-600 hover:text-slate-900 px-4 py-3.5">
                Reset
            </a>
        @endif
    </form>

    @if(session('success'))
        <div class="rounded-2xl bg-emerald-50 text-emerald-600 text-sm p-4 border border-emerald-100 shadow-sm">
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


    {{-- Table --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-slate-500">
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Jenis Bantuan</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-center">Skor Kelayakan</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($pengajuan as $item)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <p class="font-semibold text-slate-800">{{ $item->user->name ?? 'N/A' }}</p>
                                <p class="text-xs text-slate-400">{{ $item->user->email ?? 'N/A' }}</p>
                            </td>
                            <td class="px-6 py-4 font-medium text-slate-700">
                                {{ $item->jenis_bantuan }}
                            </td>
                            <td class="px-6 py-4 text-slate-500">
                                {{ $item->tanggal_pengajuan }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($item->skor_kelayakan !== null)
                                    @if($item->skor_kelayakan >= 60)
                                        <span class="text-xs font-bold bg-green-50 text-green-600 px-3 py-1.5 rounded-lg border border-green-100 shadow-2xs">
                                            {{ $item->skor_kelayakan }}
                                        </span>
                                    @elseif($item->skor_kelayakan >= 40)
                                        <span class="text-xs font-bold bg-yellow-50 text-yellow-600 px-3 py-1.5 rounded-lg border border-yellow-100 shadow-2xs">
                                            {{ $item->skor_kelayakan }}
                                        </span>
                                    @else
                                        <span class="text-xs font-bold bg-red-50 text-red-600 px-3 py-1.5 rounded-lg border border-red-100 shadow-2xs">
                                            {{ $item->skor_kelayakan }}
                                        </span>
                                    @endif
                                @else
                                    <span class="text-xs text-slate-400 font-medium">Belum dihitung</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($item->status_pengajuan == 'pending')
                                    <span class="text-xs font-bold bg-amber-50 text-amber-600 px-3 py-1 rounded-full border border-amber-100">
                                        Pending
                                    </span>
                                @elseif($item->status_pengajuan == 'diverifikasi')
                                    <span class="text-xs font-bold bg-green-50 text-green-600 px-3 py-1 rounded-full border border-green-100">
                                        Diverifikasi
                                    </span>
                                @elseif($item->status_pengajuan == 'ditolak')
                                    <span class="text-xs font-bold bg-red-50 text-red-600 px-3 py-1 rounded-full border border-red-100">
                                        Ditolak
                                    </span>
                                @else
                                    <span class="text-xs font-bold bg-slate-50 text-slate-600 px-3 py-1 rounded-full border border-slate-100">
                                        {{ $item->status_pengajuan }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.validasi.show', $item->id_pengajuan) }}"
                                    class="inline-block text-xs font-bold text-white bg-[#1C2C4E] px-4 py-2 rounded-xl hover:bg-[#111A31] transition-colors">
                                    Periksa
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-400 text-sm">
                                Belum ada pengajuan masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection
