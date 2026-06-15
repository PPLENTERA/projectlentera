@extends('layouts.admin')

@section('title', 'Monitoring Dana')

@section('content')
<div class="flex flex-col gap-8">

    {{-- Top Header Section --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
        <div>
            <h1 class="text-3xl font-extrabold text-[#022448] font-['Plus_Jakarta_Sans'] tracking-tight">
                Monitoring Dana
            </h1>
            <p class="text-base text-slate-500 mt-1">Data real-time penyaluran bantuan di Jawa Barat.</p>
        </div>
        
        <div class="flex flex-wrap items-center gap-4">
            {{-- Search Bar --}}
            <div class="relative w-64">
                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
                <input type="text" placeholder="Cari wilayah atau kategori..." 
                    class="w-full pl-10 pr-4 py-2.5 bg-white border border-slate-200 rounded-full text-sm font-medium text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-cyan-600 outline-none shadow-sm transition-all">
            </div>

            {{-- Verified Status --}}
            <div class="flex items-center gap-2 px-4 py-2.5 bg-white border border-slate-200 rounded-full shadow-sm">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span class="text-xs font-bold text-cyan-700">Verified Admin</span>
            </div>
        </div>
    </div>

    @if($errors->any())
        <div class="bg-red-50 text-red-700 text-sm p-4 rounded-2xl border border-red-200 flex items-start gap-3 shadow-sm">
            <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <div>
                <h4 class="font-bold text-red-800 mb-1">Gagal menerapkan filter:</h4>
                <ul class="list-disc list-inside space-y-0.5 text-xs font-semibold">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    {{-- Filters & Summary Row --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
        {{-- Search & Audit Filter Form (Left, 9 Columns) --}}
        <form action="{{ route('admin.monitoring') }}" method="GET" class="lg:col-span-9 bg-white rounded-3xl p-6 border border-slate-100 shadow-sm space-y-4 flex flex-col justify-between">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#022448]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 8.293A1 1 0 013 7.586V4z" />
                    </svg>
                    <h3 class="font-extrabold text-sm text-[#022448] uppercase tracking-wider font-['Plus_Jakarta_Sans']">
                        Filter Audit Penggunaan Dana
                    </h3>
                </div>
                @if(request()->filled('start_date') || request()->filled('end_date') || request()->filled('jenis_bantuan') || request()->filled('wilayah'))
                    <span class="px-3 py-1 bg-amber-50 text-amber-700 text-[10px] font-bold rounded-full border border-amber-200 animate-pulse">
                        Filter Aktif
                    </span>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                {{-- Rentang Waktu: Mulai --}}
                <div class="flex flex-col gap-1.5">
                    <label for="start_date" class="text-[10px] font-extrabold text-slate-400 uppercase tracking-wider">Tanggal Mulai</label>
                    <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}"
                        class="bg-slate-50 border border-slate-200 text-slate-800 px-4 py-2.5 rounded-2xl text-xs font-bold focus:outline-none focus:ring-2 focus:ring-cyan-600 w-full">
                </div>

                {{-- Rentang Waktu: Selesai --}}
                <div class="flex flex-col gap-1.5">
                    <label for="end_date" class="text-[10px] font-extrabold text-slate-400 uppercase tracking-wider">Tanggal Selesai</label>
                    <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}"
                        class="bg-slate-50 border border-slate-200 text-slate-800 px-4 py-2.5 rounded-2xl text-xs font-bold focus:outline-none focus:ring-2 focus:ring-cyan-600 w-full">
                </div>

                {{-- Jenis Bantuan --}}
                <div class="flex flex-col gap-1.5">
                    <label for="jenis_bantuan" class="text-[10px] font-extrabold text-slate-400 uppercase tracking-wider">Jenis Bantuan</label>
                    <div class="relative">
                        <select id="jenis_bantuan" name="jenis_bantuan"
                            class="appearance-none bg-slate-50 border border-slate-200 text-slate-800 px-4 py-2.5 pr-8 rounded-2xl text-xs font-bold focus:outline-none focus:ring-2 focus:ring-cyan-600 w-full cursor-pointer">
                            <option value="">Semua Jenis Bantuan</option>
                            <option value="Bantuan Pendidikan" {{ request('jenis_bantuan') == 'Bantuan Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                            <option value="Bantuan Kesehatan" {{ request('jenis_bantuan') == 'Bantuan Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                            <option value="Infrastruktur Desa" {{ request('jenis_bantuan') == 'Infrastruktur Desa' ? 'selected' : '' }}>Infrastruktur Desa</option>
                            <option value="Bantuan Pangan" {{ request('jenis_bantuan') == 'Bantuan Pangan' ? 'selected' : '' }}>Subsidi Pangan</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-500">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" /></svg>
                        </div>
                    </div>
                </div>

                {{-- Wilayah --}}
                <div class="flex flex-col gap-1.5">
                    <label for="wilayah" class="text-[10px] font-extrabold text-slate-400 uppercase tracking-wider">Wilayah (Kec/Kel)</label>
                    <input type="text" id="wilayah" name="wilayah" value="{{ request('wilayah') }}" placeholder="Cari Kecamatan/Kelurahan..."
                        class="bg-slate-50 border border-slate-200 text-slate-800 px-4 py-2.5 rounded-2xl text-xs font-bold placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-cyan-600 w-full">
                </div>
            </div>

            <div class="flex flex-wrap items-center justify-between gap-4 pt-3 border-t border-slate-100 mt-2">
                <div class="flex items-center gap-1.5">
                    <span class="px-3.5 py-1.5 bg-cyan-600 text-white text-[10px] font-extrabold rounded-full">Mei 2026</span>
                    <span class="px-3.5 py-1.5 bg-slate-100 text-slate-500 text-[10px] font-bold rounded-full">vs April 2026</span>
                </div>

                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.monitoring') }}" 
                        class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold text-xs rounded-xl transition-all">
                        Reset
                    </a>
                    <button type="submit" 
                        class="px-5 py-2.5 bg-cyan-600 hover:bg-cyan-700 text-white font-bold text-xs rounded-xl shadow transition-all cursor-pointer">
                        Terapkan Filter
                    </button>
                </div>
            </div>
        </form>

        {{-- Total Summary Card (Right, 3 Columns) --}}
        <div class="lg:col-span-3 bg-white rounded-3xl p-6 border border-slate-100 shadow-sm flex flex-col justify-center">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest text-center lg:text-left">Total Dana Tersalurkan</p>
            <div class="flex flex-col mt-2 items-center lg:items-start">
                <span class="text-2xl sm:text-3xl font-extrabold text-[#022448] font-heading tracking-tight text-center lg:text-left">
                    {{ $totalDanaTersalurkanFormatted }}
                </span>
                <span class="inline-flex items-center text-xs font-bold text-emerald-600 mt-2 text-center lg:text-left">
                    ↗ +14,2% <span class="text-slate-400 font-medium ml-1">dari bulan lalu</span>
                </span>
            </div>
        </div>
    </div>

    {{-- Main Visualizations Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        {{-- Peta Penyerapan Jawa Barat (Left, 8 Columns) --}}
        <div class="lg:col-span-8 bg-white rounded-3xl p-8 border border-slate-100 shadow-sm flex flex-col justify-between">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-lg font-bold text-[#022448] font-['Plus_Jakarta_Sans']">Peta Penyerapan Jawa Barat</h2>
                    <p class="text-sm text-slate-500">Perbandingan realisasi anggaran per desa.</p>
                </div>
                {{-- Toggle View buttons --}}
                <div class="flex items-center bg-slate-50 border border-slate-200 p-1 rounded-xl">
                    <button onclick="toggleView('map')" id="map-view-btn" class="px-4 py-1.5 rounded-lg text-xs font-bold transition-all bg-white shadow text-[#022448]">
                        Map View
                    </button>
                    <button onclick="toggleView('list')" id="list-view-btn" class="px-4 py-1.5 rounded-lg text-xs font-bold transition-all text-slate-500 hover:text-[#022448]">
                        List View
                    </button>
                </div>
            </div>

            {{-- Map View Container --}}
            <div id="map-container" class="relative w-full h-[400px] bg-[#0F172A] rounded-2xl overflow-hidden flex items-center justify-center p-4">
                
                {{-- Vektor Peta Jawa Barat --}}
                <svg class="w-full h-full text-[#1E293B] max-h-[350px]" viewBox="0 0 800 400" fill="currentColor">
                    <path d="M 80,180 
                             C 100,170 120,180 140,165 
                             C 160,150 180,160 200,160 
                             C 220,160 240,150 260,155 
                             C 280,160 300,140 320,145 
                             C 340,150 360,135 380,140 
                             C 400,145 420,120 440,125 
                             C 460,130 480,130 500,120
                             C 520,110 540,115 560,110
                             C 580,105 600,115 620,110
                             L 650,115 
                             C 670,110 690,125 710,130 
                             C 730,135 740,150 750,170
                             L 750,210
                             C 740,230 720,240 700,250
                             C 680,260 670,270 650,280
                             C 630,290 610,295 590,300
                             C 570,305 550,295 530,290
                             C 510,285 490,290 470,295
                             C 450,300 430,310 410,315
                             C 390,320 370,315 350,310
                             C 330,305 310,300 290,295
                             C 270,290 250,295 230,290
                             C 210,285 190,280 170,280
                             C 150,280 130,270 110,265
                             C 90,260 85,250 80,240
                             Z" 
                          fill="#1E293B" stroke="#334155" stroke-width="2" opacity="0.8" />
                </svg>

                {{-- Pin Markers --}}
                @foreach($wilayahData as $w)
                    @php
                        // Hitung posisi pin koordinat pada peta Jawa Barat
                        $coords = [
                            'Desa Bojongsoang' => ['x' => '38%', 'y' => '56%', 'color' => 'bg-blue-500', 'text' => 'Rp 210M (94%)', 'open' => true],
                            'Desa Lengkong' => ['x' => '34%', 'y' => '48%', 'color' => 'bg-amber-500', 'text' => 'Rp 150M (88%)'],
                            'Desa Cipagalo' => ['x' => '42%', 'y' => '52%', 'color' => 'bg-blue-500', 'text' => 'Rp 190M (92%)'],
                            'Desa Bojongsari' => ['x' => '48%', 'y' => '58%', 'color' => 'bg-amber-500', 'text' => 'Rp 120M (78%)'],
                            'Desa Buahbatu' => ['x' => '40%', 'y' => '45%', 'color' => 'bg-red-500', 'text' => 'Rp 70M (45%)', 'open' => true],
                            'Desa Tegalluar' => ['x' => '46%', 'y' => '50%', 'color' => 'bg-amber-500', 'text' => 'Rp 80M (82%)']
                        ];
                        $coord = $coords[$w['desa']] ?? ['x' => '50%', 'y' => '50%', 'color' => 'bg-slate-500', 'text' => 'Data'];
                    @endphp

                    <div class="absolute group" style="left: {{ $coord['x'] }}; top: {{ $coord['y'] }}; transform: translate(-50%, -100%);" data-region-slug="{{ Str::slug($w['desa']) }}">
                        {{-- Tooltip info --}}
                        <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 bg-white text-[#022448] text-[10px] font-extrabold px-3 py-1.5 rounded-xl border border-slate-100 shadow-lg whitespace-nowrap z-20 
                            {{ isset($coord['open']) ? 'block' : 'hidden group-hover:block transition-all' }}">
                            <p class="uppercase text-slate-400 text-[8px] tracking-wider mb-0.5">{{ $w['desa'] }}</p>
                            <p>{{ $coord['text'] }}</p>
                            {{-- Arrow --}}
                            <div class="absolute top-full left-1/2 -translate-x-1/2 -mt-1 w-2 h-2 bg-white rotate-40 border-r border-b border-slate-100"></div>
                        </div>

                        {{-- Pin Pointer --}}
                        <div class="relative flex items-center justify-center">
                            <span class="absolute inline-flex h-6 w-6 rounded-full opacity-40 animate-ping {{ $coord['color'] }}"></span>
                            <div class="w-4.5 h-4.5 rounded-full border-2 border-white shadow flex items-center justify-center {{ $coord['color'] }}">
                                <div class="w-1.5 h-1.5 rounded-full bg-white"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
                
                {{-- Jawa Barat water watermark --}}
                <div class="absolute bottom-4 left-1/2 -translate-x-1/2 text-[10px] text-slate-600 font-extrabold tracking-widest uppercase opacity-40">
                    Provinsi Jawa Barat
                </div>
            </div>

            {{-- List View Container (Hidden by default) --}}
            <div id="list-container" class="hidden w-full h-[400px] border border-slate-100 rounded-2xl overflow-y-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100 text-slate-500 font-bold text-xs uppercase tracking-wider">
                            <th class="px-6 py-4">Desa</th>
                            <th class="px-6 py-4">Kabupaten/Kota</th>
                            <th class="px-6 py-4">Pagu Anggaran</th>
                            <th class="px-6 py-4">Realisasi Dana</th>
                            <th class="px-6 py-4 text-center">Penyerapan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 font-semibold text-[#022448]">
                        @foreach($wilayahData as $w)
                            <tr class="hover:bg-slate-50/50" data-region-row="{{ Str::slug($w['desa']) }}">
                                <td class="px-6 py-4">{{ $w['desa'] }}</td>
                                <td class="px-6 py-4 text-slate-400 text-xs uppercase tracking-wider">{{ $w['kabupaten'] }}</td>
                                <td class="px-6 py-4">Rp {{ number_format($w['pagu'] / 1000000000, 1, ',', '.') }} Miliar</td>
                                <td class="px-6 py-4">Rp {{ number_format($w['realisasi'] / 1000000000, 1, ',', '.') }} Miliar</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-24 bg-slate-100 rounded-full h-2 overflow-hidden flex-shrink-0">
                                            <div class="h-full rounded-full 
                                                @if($w['persentase'] >= 80) bg-blue-500
                                                @elseif($w['persentase'] >= 50) bg-amber-500
                                                @else bg-red-500
                                                @endif" 
                                                style="width: {{ $w['persentase'] }}%">
                                            </div>
                                        </div>
                                        <span class="text-xs font-bold whitespace-nowrap">{{ $w['persentase'] }}%</span>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Legend --}}
            <div class="flex flex-wrap items-center justify-between gap-4 mt-6 pt-4 border-t border-slate-100">
                <div class="flex items-center gap-6 text-xs font-bold text-slate-500 uppercase tracking-widest">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-blue-500"></span>
                        Optimal (>80%)
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-amber-500"></span>
                        Moderat (50-80%)
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-red-500"></span>
                        Rendah (<50%)
                    </div>
                </div>
                <a href="#" onclick="toggleView('list'); event.preventDefault();" class="text-xs font-bold text-blue-600 hover:underline">
                    Lihat Detail Semua Wilayah →
                </a>
            </div>

        </div>

        {{-- Alokasi Per Kategori (Right, 4 Columns) --}}
        <div class="lg:col-span-4 bg-white rounded-3xl p-8 border border-slate-100 shadow-sm flex flex-col justify-between h-full min-h-[496px]">
            <div>
                <h2 class="text-lg font-bold text-[#022448] font-['Plus_Jakarta_Sans'] pb-1">Alokasi Per Kategori</h2>
                <p class="text-sm text-slate-500 border-b border-slate-50 pb-4 mb-6">Persentase penggunaan pagu anggaran.</p>

                <div class="space-y-6">
                    @foreach($kategoriData as $key => $kat)
                        @php
                            $colorHex = '#3b82f6';
                            if ($key === 'Kesehatan') $colorHex = '#10b981';
                            if ($key === 'Infrastruktur Desa') $colorHex = '#8b5cf6';
                            if ($key === 'Subsidi Pangan') $colorHex = '#f59e0b';
                        @endphp
                        <div class="space-y-2">
                            <div class="flex items-center justify-between text-sm">
                                <span class="font-bold text-[#022448]">{{ $kat['nama'] }}</span>
                                <span class="font-extrabold" style="color: {{ $colorHex }}">{{ $kat['persentase'] }}%</span>
                            </div>
                            
                            {{-- Custom styled Progress bar --}}
                            <div class="w-full bg-slate-100 rounded-full h-3 overflow-hidden">
                                <div class="h-full rounded-full" style="background-color: {{ $colorHex }}; width: {{ $kat['persentase'] }}%"></div>
                            </div>

                            <div class="flex items-center justify-between text-[10px] font-bold text-slate-400 uppercase tracking-wider pt-0.5">
                                <span>RP {{ number_format($kat['pagu'] / 1000000000000, 1, ',', '.') }}T Pagu</span>
                                <span>Sisa: RP {{ number_format($kat['sisa'] / 1000000000, 0, ',', '.') }}M</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <button onclick="window.location.href='{{ route('admin.validasi.export') }}'"
                class="w-full mt-8 py-4 bg-cyan-600 hover:bg-cyan-700 text-white font-bold text-sm rounded-2xl shadow-lg transition-all hover:-translate-y-0.5 duration-200 cursor-pointer">
                Unduh Laporan Sektoral
            </button>
        </div>

    </div>

    {{-- Chart & Analysis Row --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        {{-- Perbandingan Bulanan (Left, 5 Columns) --}}
        <div class="lg:col-span-5 bg-white rounded-3xl p-8 border border-slate-100 shadow-sm flex flex-col justify-between">
            <div>
                <h2 class="text-lg font-bold text-[#022448] font-['Plus_Jakarta_Sans'] pb-1">Perbandingan Bulanan</h2>
                <p class="text-sm text-slate-500 border-b border-slate-50 pb-4 mb-6">Trend penyaluran bulan ini vs sebelumnya.</p>
                
                {{-- Chart canvas --}}
                <div class="relative w-full h-[220px]">
                    <canvas id="perbandinganChart"></canvas>
                </div>
            </div>

            <div class="flex items-center justify-between text-xs font-bold text-slate-500 uppercase tracking-widest mt-6 pt-4 border-t border-slate-100">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-cyan-600"></span>
                    Mei 2026: {{ $totalMeiFormatted }}
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-slate-200"></span>
                    April 2026: {{ $totalAprilFormatted }}
                </div>
            </div>
        </div>

        {{-- Transparency Index & Efficiency Analysis (Right, 7 Columns) --}}
        <div class="lg:col-span-7 bg-[#F8FAFC] rounded-3xl p-8 border border-slate-200/60 shadow-sm flex flex-col sm:flex-row gap-8 items-center h-full min-h-[352px]">
            
            {{-- Circular Gauge --}}
            <div class="w-full sm:w-1/3 bg-white rounded-2xl p-6 border border-slate-100 shadow-sm flex flex-col items-center justify-center text-center">
                <p class="text-[9px] font-extrabold text-slate-400 uppercase tracking-widest mb-4">Indeks Transparansi</p>
                
                {{-- Circular dial meter --}}
                <div class="relative w-28 h-28 flex items-center justify-center">
                    {{-- Circular SVG border progress --}}
                    <svg class="absolute inset-0 w-full h-full transform -rotate-90">
                        <circle cx="56" cy="56" r="46" stroke="#E2E8F0" stroke-width="8" fill="transparent" />
                        <circle cx="56" cy="56" r="46" stroke="#0891b2" stroke-width="8" fill="transparent" 
                            stroke-dasharray="289" stroke-dashoffset="{{ 289 - (289 * $transparencyIndex / 100) }}" stroke-linecap="round" />
                    </svg>
                    <span class="text-3xl font-extrabold text-[#022448]">{{ $transparencyIndex }}</span>
                </div>
                
                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider mt-4">{{ $transparencyStatus }}</p>
            </div>

            {{-- Text Analysis --}}
            <div class="flex-1 space-y-6">
                <div class="space-y-2">
                    <h3 class="text-lg font-bold text-[#022448] font-['Plus_Jakarta_Sans']">Analisis Efisiensi Distribusi</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">
                        Berdasarkan data bulan Mei, sistem LENTERA mencatat peningkatan kecepatan distribusi dana sebesar 18% berkat optimalisasi verifikasi biometrik di wilayah remote.
                    </p>
                </div>
                
                <div class="flex flex-wrap items-center gap-3">
                    <span class="inline-flex items-center gap-1.5 px-4 py-2 bg-emerald-50 text-emerald-700 text-xs font-bold rounded-full">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                        99.8% Tepat Sasaran
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-4 py-2 bg-blue-50 text-blue-700 text-xs font-bold rounded-full">
                        <svg class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
                        Avg 2.4 Hari Cair
                    </span>
                </div>
            </div>

        </div>

    </div>

</div>

{{-- Chart JS Initialization --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    // Toggle View Map vs List
    function toggleView(view) {
        const mapContainer = document.getElementById('map-container');
        const listContainer = document.getElementById('list-container');
        const mapBtn = document.getElementById('map-view-btn');
        const listBtn = document.getElementById('list-view-btn');

        if (view === 'map') {
            mapContainer.classList.remove('hidden');
            listContainer.classList.add('hidden');
            mapBtn.className = "px-4 py-1.5 rounded-lg text-xs font-bold transition-all bg-white shadow text-cyan-600";
            listBtn.className = "px-4 py-1.5 rounded-lg text-xs font-bold transition-all text-slate-500 hover:text-cyan-600";
        } else {
            mapContainer.classList.add('hidden');
            listContainer.classList.remove('hidden');
            mapBtn.className = "px-4 py-1.5 rounded-lg text-xs font-bold transition-all text-slate-500 hover:text-cyan-600";
            listBtn.className = "px-4 py-1.5 rounded-lg text-xs font-bold transition-all bg-white shadow text-cyan-600";
        }
    }

    // Filter Region Interactive
    function filterRegion(slug) {
        const pins = document.querySelectorAll('[data-region-slug]');
        const rows = document.querySelectorAll('[data-region-row]');

        pins.forEach(pin => {
            if (slug === 'all' || pin.getAttribute('data-region-slug') === slug) {
                pin.style.display = 'block';
            } else {
                pin.style.display = 'none';
            }
        });

        rows.forEach(row => {
            if (slug === 'all' || row.getAttribute('data-region-row') === slug) {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Chart.js perbandingan bulanan
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('perbandinganChart').getContext('2d');
        const chartData = @json($chartBulanan);
        
        const labels = ['W1', 'W2', 'W3', 'W4'];
        const dataMei = [
            chartData.Mei.W1 / {{ $chartScale }}, 
            chartData.Mei.W2 / {{ $chartScale }}, 
            chartData.Mei.W3 / {{ $chartScale }}, 
            chartData.Mei.W4 / {{ $chartScale }}
        ];
        const dataApril = [
            chartData.April.W1 / {{ $chartScale }}, 
            chartData.April.W2 / {{ $chartScale }}, 
            chartData.April.W3 / {{ $chartScale }}, 
            chartData.April.W4 / {{ $chartScale }}
        ];
 
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Mei 2026',
                        data: dataMei,
                        backgroundColor: '#0891b2',
                        borderRadius: 4,
                        barPercentage: 0.5,
                        categoryPercentage: 0.4
                    },
                    {
                        label: 'April 2026',
                        data: dataApril,
                        backgroundColor: '#E2E8F0',
                        borderRadius: 4,
                        barPercentage: 0.5,
                        categoryPercentage: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { font: { size: 10, weight: 'bold' }, color: '#94a3b8' }
                    },
                    y: {
                        grid: { borderDash: [4, 4], color: '#f1f5f9' },
                        ticks: { font: { size: 10 }, color: '#94a3b8', callback: value => 'Rp ' + value + '{{ $chartUnit }}' }
                    }
                }
            }
        });
    });
</script>
@endsection