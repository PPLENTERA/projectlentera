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

            @if($item->dokumen->count() > 0)
                <div class="border-t border-slate-100 pt-4 mb-4">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Dokumen Terupload</p>
                    <div class="flex gap-2 flex-wrap">
                        @foreach($item->dokumen as $dok)
                            <span class="text-xs font-semibold bg-[#F0F2F5] text-slate-600 px-3 py-1 rounded-lg uppercase">
                                {{ $dok->jenis_dokumen }}
                            </span>
                        @endforeach
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