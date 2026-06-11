@extends('layouts.admin')

@section('title', 'Indikator Scoring')

@section('content')

<div class="space-y-6">

    {{-- Title Block --}}
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-[#1C2C4E]">Indikator Penilaian</h1>
            <p class="text-sm text-slate-500 mt-1">Tentukan kriteria penilaian dan aturan skor kelayakan secara terstruktur dan objektif.</p>
        </div>
        <a href="{{ route('admin.scoring_indicators.create') }}"
           class="text-xs font-bold text-white bg-linear-to-r from-[#172545] to-[#1F335C] px-5 py-3 rounded-xl shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all">
            + Tambah Indikator
        </a>
    </div>

    {{-- Sub-navigation --}}
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
        <div class="bg-green-50 text-green-600 text-sm p-4 rounded-xl border border-green-100 mb-6 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- Panduan Penilaian Default --}}
    <div class="bg-blue-50/70 border border-blue-200 rounded-2xl p-6 mb-6">
        <h2 class="text-sm font-bold text-blue-800 uppercase tracking-widest mb-3 flex items-center gap-2">
            💡 Panduan Penilaian Default 
        </h2>
        <p class="text-xs text-blue-600 mb-4">Berikut adalah acuan aturan penilaian bantuan:</p>
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

    {{-- Rules list --}}
    <div class="space-y-6">
        @forelse($indicators as $indicator)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-all">
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
                
                {{-- Rules Table --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead>
                            <tr class="bg-slate-50/30 text-slate-400 border-b border-slate-100">
                                <th class="px-6 py-3.5 text-xs font-bold uppercase tracking-wider">Kriteria Deskripsi (Label)</th>
                                <th class="px-6 py-3.5 text-xs font-bold uppercase tracking-wider text-center">Aturan Logika</th>
                                <th class="px-6 py-3.5 text-xs font-bold uppercase tracking-wider text-right">Skor Poin</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                            @forelse($indicator->rules as $rule)
                                <tr class="hover:bg-slate-50/30 transition-all">
                                    <td class="px-6 py-4">
                                        {{ $rule->label }}
                                    </td>
                                    <td class="px-6 py-4 text-center text-xs font-mono font-bold text-slate-500">
                                        @if($rule->operator == 'between')
                                            {{ $indicator->column_name }} BETWEEN {{ number_format($rule->value, 0, ',', '.') }} AND {{ number_format($rule->value_max, 0, ',', '.') }}
                                        @else
                                            {{ $indicator->column_name }} {{ $rule->operator }} {{ number_format($rule->value, 0, ',', '.') }}
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right font-extrabold text-emerald-600">
                                        +{{ $rule->score }} Poin
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-8 text-center text-slate-400 text-xs">
                                        Belum ada aturan penilaian ditambahkan untuk indikator ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-2xl p-12 border border-slate-200 text-center shadow-sm">
                <p class="text-slate-500 text-sm">Belum ada indikator scoring aktif.</p>
            </div>
        @endforelse
    </div>

</div>

@endsection
