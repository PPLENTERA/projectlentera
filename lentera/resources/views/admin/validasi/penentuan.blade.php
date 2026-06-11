<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penentuan Penerima Bantuan - LENTERA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F3F4F6] min-h-screen p-6 font-['Inter']">

<div class="max-w-6xl mx-auto">

    <div class="mb-6 flex justify-between items-end">
        <div>
            <h1 class="text-2xl font-bold text-[#1C2C4E]">Penentuan Penerima Bantuan</h1>
            <p class="text-sm text-slate-500 mt-1">Bandingkan skor kelayakan pengajuan yang terverifikasi dan tentukan penerima bantuan.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="text-sm font-bold text-slate-500 hover:text-[#1C2C4E] transition-colors">
            &larr; Kembali ke Dashboard
        </a>
    </div>

    <!-- Sub-navigation -->
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
        <div class="bg-green-50 text-green-600 text-sm p-4 rounded-xl border border-green-100 mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- STATS -->
    <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-2xl shadow p-5">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Total Terverifikasi</p>
            <p class="text-2xl font-bold text-[#1C2C4E]">{{ $pengajuan->count() }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow p-5">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Diverifikasi (Menunggu Keputusan)</p>
            <p class="text-2xl font-bold text-yellow-500">{{ $pengajuan->where('status_pengajuan', 'diverifikasi')->count() }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow p-5">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Disetujui (Diterima)</p>
            <p class="text-2xl font-bold text-green-500">{{ $pengajuan->where('status_pengajuan', 'diterima')->count() }}</p>
        </div>
    </div>

    <!-- FILTER & SEARCH -->
    <div class="bg-white rounded-2xl shadow p-6 mb-6">
        <form action="{{ route('admin.validasi.penentuan') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
            <div class="flex-1 w-full">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Cari Pemohon</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email..."
                       class="w-full px-4 py-2.5 bg-[#F0F2F5] rounded-xl text-sm font-medium text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-[#1C2C4E] focus:bg-white transition-all outline-none">
            </div>

            <div class="w-full md:w-64">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Jenis Bantuan</label>
                <select name="jenis_bantuan"
                        class="w-full px-4 py-2.5 bg-[#F0F2F5] rounded-xl text-sm font-medium text-slate-800 focus:ring-2 focus:ring-[#1C2C4E] focus:bg-white transition-all outline-none">
                    <option value="">Semua Jenis Bantuan</option>
                    @foreach($jenisBantuanList as $type)
                        <option value="{{ $type }}" {{ request('jenis_bantuan') == $type ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex gap-2 w-full md:w-auto">
                <button type="submit"
                        class="flex-1 md:flex-none text-xs font-bold text-white bg-[#1C2C4E] px-6 py-3 rounded-xl hover:bg-[#111A31] transition-all">
                    Terapkan
                </button>
                @if(request()->anyFilled(['search', 'jenis_bantuan']))
                    <a href="{{ route('admin.validasi.penentuan') }}"
                       class="flex-1 md:flex-none text-center text-xs font-bold text-slate-600 bg-slate-100 px-6 py-3 rounded-xl hover:bg-slate-200 transition-all">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- COMPARISON TABLE -->
    <div class="bg-white rounded-2xl shadow overflow-hidden">
        <div class="p-6 border-b border-slate-100">
            <h2 class="text-sm font-bold text-slate-600 uppercase tracking-widest">Peringkat Kelayakan Pengajuan</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-[#F0F2F5] text-left">
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-widest text-center">Rank</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-widest">Nama Pemohon</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-widest">Jenis Bantuan</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-widest text-right">Penghasilan</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-widest text-center">Tanggungan</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-widest text-center">Skor Kelayakan</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-widest text-center">Tingkat</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-widest text-center">Status</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-widest text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($pengajuan as $index => $item)
                        @php
                            $rank = $index + 1;
                            $score = $item->skor_kelayakan;
                            $level = 'Kurang Layak';
                            $levelClass = 'bg-red-50 text-red-600 border-red-100';
                            if ($score >= 60) {
                                $level = 'Sangat Layak';
                                $levelClass = 'bg-green-50 text-green-600 border-green-100';
                            } elseif ($score >= 40) {
                                $level = 'Layak';
                                $levelClass = 'bg-yellow-50 text-yellow-600 border-yellow-100';
                            }
                        @endphp
                        <tr class="hover:bg-[#F8F9FA] transition-colors">
                            <td class="px-6 py-4 text-center font-bold text-slate-500">
                                #{{ str_pad($rank, 2, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-semibold text-slate-800">{{ $item->user->name }}</p>
                                <p class="text-xs text-slate-400">{{ $item->user->email }}</p>
                            </td>
                            <td class="px-6 py-4 font-medium text-slate-700">
                                {{ $item->jenis_bantuan }}
                            </td>
                            <td class="px-6 py-4 text-right font-semibold text-slate-600">
                                Rp {{ number_format($item->penghasilan, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-center text-slate-700">
                                {{ $item->jumlah_tanggungan }} orang
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($score !== null)
                                    <span class="text-sm font-extrabold text-slate-800">
                                        {{ $score }}
                                    </span>
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
                                    <span class="text-xs font-bold bg-yellow-50 text-yellow-600 px-3 py-1 rounded-full">
                                        Diverifikasi
                                    </span>
                                @elseif($item->status_pengajuan == 'diterima')
                                    <span class="text-xs font-bold bg-green-50 text-green-600 px-3 py-1 rounded-full">
                                        Diterima
                                    </span>
                                @else
                                    <span class="text-xs font-bold bg-slate-50 text-slate-600 px-3 py-1 rounded-full">
                                        {{ $item->status_pengajuan }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($item->status_pengajuan == 'diverifikasi')
                                    <form action="{{ route('admin.validasi.update_status', $item->id_pengajuan) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="status" value="diterima">
                                        <button type="submit"
                                                class="text-xs font-bold text-white bg-green-600 hover:bg-green-700 px-4 py-2 rounded-lg transition-colors">
                                            Terima Bantuan
                                        </button>
                                    </form>
                                @elseif($item->status_pengajuan == 'diterima')
                                    <form action="{{ route('admin.validasi.update_status', $item->id_pengajuan) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="status" value="diverifikasi">
                                        <button type="submit"
                                                class="text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 px-4 py-2 rounded-lg transition-colors">
                                            Batalkan
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-10 text-center text-slate-400 text-sm">
                                Tidak ada pengajuan yang telah terverifikasi untuk ditentukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

</body>
</html>
