@extends('layouts.admin')

@section('title', 'Penentuan Penerima')

@section('content')

<div class="space-y-6">

    {{-- Title Block --}}
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-[#1C2C4E]">Penentuan Penerima Bantuan</h1>
            <p class="text-sm text-slate-500 mt-1">Bandingkan skor kelayakan pengajuan yang terverifikasi dan tentukan penerima bantuan.</p>
        </div>
    </div>

    {{-- Sub-navigation --}}
    <div class="flex gap-6 mb-6 border-b border-slate-200">
        <a href="{{ route('admin.validasi.index') }}" 
           class="text-sm font-semibold text-slate-500 hover:text-[#1C2C4E] pb-3 transition-all">
            Validasi & Verifikasi
        </a>
        <a href="{{ route('admin.scoring_indicators.index') }}" 
           class="text-sm font-semibold text-slate-500 hover:text-[#1C2C4E] pb-3 transition-all">
            Indikator Scoring
        </a>
        <a href="{{ route('admin.validasi.penentuan') }}" 
           class="text-sm font-bold text-[#1C2C4E] border-b-2 border-[#1C2C4E] pb-3 transition-all">
            Penentuan Penerima
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-50 text-green-600 text-sm p-4 rounded-xl border border-green-100 mb-6 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- Stats --}}
    <section class="grid gap-6 grid-cols-1 md:grid-cols-3 mb-6">
        <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-200">
            <p class="text-xs text-slate-500 font-bold uppercase tracking-wider mb-1">Total Terverifikasi</p>
            <p class="text-2xl font-extrabold text-[#1C2C4E]">{{ $pengajuan->count() }}</p>
        </article>
        <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-200">
            <p class="text-xs text-slate-500 font-bold uppercase tracking-wider mb-1">Menunggu Keputusan</p>
            <p class="text-2xl font-extrabold text-amber-600">{{ $pengajuan->where('status_pengajuan', 'diverifikasi')->count() }}</p>
        </article>
        <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-200">
            <p class="text-xs text-slate-500 font-bold uppercase tracking-wider mb-1">Disetujui (Diterima)</p>
            <p class="text-2xl font-extrabold text-emerald-600">{{ $pengajuan->where('status_pengajuan', 'diterima')->count() }}</p>
        </article>
    </section>

    {{-- Filter & Search Form --}}
    <div class="bg-white rounded-2xl border border-slate-200 p-6 mb-6 shadow-sm">
        <form action="{{ route('admin.validasi.penentuan') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
            <div class="flex-1 w-full flex flex-col gap-2">
                <label class="text-xs font-bold text-slate-600 uppercase tracking-wider">Cari Pemohon</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email..."
                       class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-cyan-600 outline-none transition-all">
            </div>

            <div class="w-full md:w-64 flex flex-col gap-2">
                <label class="text-xs font-bold text-slate-600 uppercase tracking-wider">Jenis Bantuan</label>
                <select name="jenis_bantuan"
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-800 focus:ring-2 focus:ring-cyan-600 outline-none transition-all">
                    <option value="">Semua Jenis Bantuan</option>
                    @foreach($jenisBantuanList as $type)
                        <option value="{{ $type }}" {{ request('jenis_bantuan') == $type ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex gap-2 w-full md:w-auto">
                <button type="submit"
                        class="flex-1 md:flex-none text-xs font-bold text-white bg-[#1C2C4E] px-6 py-3.5 rounded-xl hover:bg-[#111A31] transition-all">
                    Terapkan
                </button>
                @if(request()->anyFilled(['search', 'jenis_bantuan']))
                    <a href="{{ route('admin.validasi.penentuan') }}"
                       class="flex-1 md:flex-none text-center text-xs font-bold text-slate-600 bg-slate-100 px-6 py-3.5 rounded-xl hover:bg-slate-200 transition-all">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Comparison Table --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 border-b border-slate-100">
            <h2 class="text-sm font-bold text-slate-600 uppercase tracking-wider">Peringkat Kelayakan Pengajuan</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-slate-500">
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-center">Rank</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Nama Pemohon</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Jenis Bantuan</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-right">Penghasilan</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-center">Tanggungan</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-center">Skor Kelayakan</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-center">Tingkat</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-center">Status</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($pengajuan as $index => $item)
                        @php
                            $rank = $index + 1;
                            $score = $item->skor_kelayakan;
                            $level = 'Kurang Layak';
                            $levelClass = 'bg-red-50 text-red-650 border-red-100';
                            if ($score >= 60) {
                                $level = 'Sangat Layak';
                                $levelClass = 'bg-green-50 text-green-600 border-green-100';
                            } elseif ($score >= 40) {
                                $level = 'Layak';
                                $levelClass = 'bg-yellow-50 text-yellow-600 border-yellow-100';
                            }
                        @endphp
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4 text-center font-bold text-slate-500">
                                #{{ str_pad($rank, 2, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-semibold text-slate-800">{{ $item->user->name ?? 'N/A' }}</p>
                                <p class="text-xs text-slate-400">{{ $item->user->email ?? 'N/A' }}</p>
                            </td>
                            <td class="px-6 py-4 font-medium text-slate-700">
                                {{ $item->jenis_bantuan }}
                            </td>
                            <td class="px-6 py-4 text-right font-semibold text-slate-650">
                                Rp {{ number_format($item->penghasilan, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-center text-slate-700 font-semibold">
                                {{ $item->jumlah_tanggungan }} Orang
                            </td>
                            <td class="px-6 py-4 text-center font-extrabold text-slate-900">
                                @if($score !== null)
                                    {{ $score }}
                                @else
                                    <span class="text-xs text-slate-400 font-medium">Belum dihitung</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($score !== null)
                                    <span class="text-xs font-bold px-2.5 py-1 rounded-lg border {{ $levelClass }}">
                                        {{ $level }}
                                    </span>
                                @else
                                    <span class="text-xs text-slate-400 font-medium">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($item->status_pengajuan == 'diverifikasi')
                                    <span class="text-xs font-bold bg-amber-50 text-amber-600 px-3 py-1 rounded-full border border-amber-100">
                                        Diverifikasi
                                    </span>
                                @elseif($item->status_pengajuan == 'diterima')
                                    <span class="text-xs font-bold bg-green-50 text-green-600 px-3 py-1 rounded-full border border-green-100">
                                        Diterima
                                    </span>
                                @else
                                    <span class="text-xs font-bold bg-slate-50 text-slate-600 px-3 py-1 rounded-full border border-slate-100">
                                        {{ $item->status_pengajuan }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                @if($item->status_pengajuan == 'diverifikasi')
                                    <form action="{{ route('admin.validasi.update_status', $item->id_pengajuan) }}" method="POST" class="inline-block">
                                        @csrf
                                        <input type="hidden" name="status" value="diterima">
                                        <button type="submit"
                                                class="text-xs font-bold text-white bg-green-600 hover:bg-green-700 px-4 py-2 rounded-xl transition-colors">
                                            Terima Bantuan
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.validasi.update_status', $item->id_pengajuan) }}" method="POST" class="inline-block ml-1" onsubmit="return confirm('Apakah Anda yakin ingin menolak pengajuan ini?');">
                                        @csrf
                                        <input type="hidden" name="status" value="ditolak">
                                        <button type="submit"
                                                class="text-xs font-bold text-white bg-red-600 hover:bg-red-700 px-4 py-2 rounded-xl transition-colors">
                                            Tolak Bantuan
                                        </button>
                                    </form>
                                @elseif($item->status_pengajuan == 'diterima' || $item->status_pengajuan == 'ditolak')
                                    <form action="{{ route('admin.validasi.update_status', $item->id_pengajuan) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="status" value="diverifikasi">
                                        <button type="submit"
                                                class="text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 px-4 py-2 rounded-xl transition-colors">
                                            Batalkan
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-12 text-center text-slate-400 text-sm">
                                Tidak ada pengajuan yang telah terverifikasi untuk ditentukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection
