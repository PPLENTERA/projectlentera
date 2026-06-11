<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Indikator Scoring - LENTERA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F3F4F6] min-h-screen p-6 font-['Inter']">

<div class="max-w-5xl mx-auto">

    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-[#1C2C4E]">Indikator Penilaian</h1>
            <p class="text-sm text-slate-500 mt-1">Tentukan kriteria penilaian dan aturan skor kelayakan secara terstruktur dan objektif.</p>
        </div>
        <a href="{{ route('admin.scoring_indicators.create') }}"
           class="text-xs font-bold text-white bg-linear-to-r from-[#172545] to-[#1F335C] px-5 py-3 rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all">
            + Tambah Indikator
        </a>
    </div>

    <!-- Sub-navigation -->
    <div class="flex gap-6 mb-6 border-b border-slate-200">
        <a href="{{ route('admin.validasi.index') }}" 
           class="text-sm font-semibold text-slate-500 hover:text-[#1C2C4E] pb-3 transition-all">
            Validasi & Verifikasi
        </a>
        <a href="{{ route('admin.scoring_indicators.index') }}" 
           class="text-sm font-bold text-[#1C2C4E] border-b-2 border-[#1C2C4E] pb-3 transition-all">
            Indikator Scoring
        </a>
        <a href="{{ route('admin.validasi.penentuan') }}" 
           class="text-sm font-semibold text-slate-500 hover:text-[#1C2C4E] pb-3 transition-all">
            Penentuan Penerima
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-50 text-green-600 text-sm p-4 rounded-xl border border-green-100 mb-6 shadow-xs">
            {{ session('success') }}
        </div>
    @endif

    <!-- Acuan Penilaian Default (Seeder) -->
    <div class="bg-blue-50/70 border border-blue-200 rounded-2xl p-6 mb-6">
        <h2 class="text-sm font-bold text-blue-800 uppercase tracking-widest mb-3 flex items-center gap-2">
            💡 Panduan Penilaian Default (Acuan Seeder)
        </h2>
        <p class="text-xs text-blue-600 mb-4">Berikut adalah acuan aturan penilaian bawaan sistem yang ada di seeder LENTERA:</p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-xs text-slate-700">
            <div class="bg-white rounded-xl p-4 shadow-sm border border-blue-100">
                <p class="font-bold text-blue-900 mb-2">1. Indikator Penghasilan (penghasilan)</p>
                <ul class="space-y-1.5 list-disc pl-4 font-medium text-slate-600">
                    <li>Kurang dari Rp 1.000.000 (&lt; 1.000.000) &rarr; <span class="font-bold text-green-600">+40 Poin</span></li>
                    <li>Rp 1.000.000 - Rp 3.000.000 (between) &rarr; <span class="font-bold text-green-600">+25 Poin</span></li>
                    <li>Lebih dari Rp 3.000.000 (&gt; 3.000.000) &rarr; <span class="font-bold text-green-600">+10 Poin</span></li>
                </ul>
            </div>
            <div class="bg-white rounded-xl p-4 shadow-sm border border-blue-100">
                <p class="font-bold text-blue-900 mb-2">2. Indikator Jumlah Tanggungan (jumlah_tanggungan)</p>
                <ul class="space-y-1.5 list-disc pl-4 font-medium text-slate-600">
                    <li>Lebih dari 3 orang (&gt; 3) &rarr; <span class="font-bold text-green-600">+30 Poin</span></li>
                    <li>2 - 3 orang (between) &rarr; <span class="font-bold text-green-600">+20 Poin</span></li>
                    <li>Kurang dari 2 orang (&lt; 2) &rarr; <span class="font-bold text-green-600">+10 Poin</span></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        @forelse($indicators as $indicator)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-md transition-all">
                <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                    <div>
                        <div class="flex items-center gap-2">
                            <h2 class="text-base font-bold text-slate-800">{{ $indicator->name }}</h2>
                            <span class="text-[0.65rem] font-bold bg-[#E8EDF9] text-[#1F54CE] px-2 py-0.5 rounded-full uppercase tracking-wider">
                                Kolom: {{ $indicator->column_name }}
                            </span>
                        </div>
                        <p class="text-xs text-slate-400 mt-1">Mengambil data field `{{ $indicator->column_name }}` pengajuan.</p>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('admin.scoring_indicators.edit', $indicator->id) }}"
                           class="text-xs font-bold text-[#1C2C4E] bg-slate-100 hover:bg-[#E8EDF9] hover:text-[#1F54CE] px-4 py-2 rounded-xl transition-all">
                            Ubah
                        </a>
                        <form action="{{ route('admin.scoring_indicators.destroy', $indicator->id) }}" method="POST"
                              class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus indikator ini? Semua aturan di dalamnya akan ikut dihapus.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-xs font-bold text-red-600 bg-red-50 hover:bg-red-100 px-4 py-2 rounded-xl transition-all">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-white border-b border-slate-100 text-left">
                                <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-widest">Kondisi / Aturan</th>
                                <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-widest">Operator</th>
                                <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-widest text-right">Nilai Pembanding</th>
                                <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-widest text-right">Skor Nilai</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @foreach($indicator->rules as $rule)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-6 py-4">
                                        <p class="font-medium text-slate-700">{{ $rule->label ?? '-' }}</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="font-mono text-xs bg-slate-100 text-slate-600 px-2 py-1 rounded-md font-semibold">
                                            {{ strtoupper($rule->operator) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right font-semibold text-slate-600">
                                        @if($rule->operator === 'between')
                                            {{ number_format($rule->value, 0, ',', '.') }} - {{ number_format($rule->value_max, 0, ',', '.') }}
                                        @else
                                            {{ number_format($rule->value, 0, ',', '.') }}
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <span class="text-xs font-bold bg-green-50 text-green-600 px-3 py-1.5 rounded-lg border border-green-100">
                                            +{{ $rule->score }} Poin
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-2xl shadow p-12 text-center border border-slate-100">
                <p class="text-slate-400 text-sm">Belum ada indikator scoring yang dikonfigurasi. Klik tombol "+ Tambah Indikator" untuk memulai.</p>
            </div>
        @endforelse
    </div>

</div>

</body>
</html>
