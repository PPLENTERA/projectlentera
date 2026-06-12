@extends('layouts.admin')

@section('title', 'Overview')

@section('content')

{{-- ===== MAIN CONTENT ===== --}}
<div class="space-y-6">
    <header class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <p class="text-sm text-slate-500 font-medium">Dashboard Overview</p>
            <h1 class="text-3xl font-bold text-slate-900">Monitoring Distribusi Bantuan</h1>
        </div>
        <div class="flex items-center gap-4 rounded-3xl bg-white p-3 shadow-sm border border-slate-200">
            <div class="text-right">
                <p class="text-sm text-slate-500">{{ $authUser->name ?? 'Admin' }}</p>
                <p class="text-xs font-semibold capitalize text-slate-700">{{ $authUser->role ?? 'Admin' }}</p>
            </div>
            <div class="relative">
                <div class="h-11 w-11 rounded-full bg-cyan-100 flex items-center justify-center font-bold text-cyan-700 text-sm">
                    {{ strtoupper(substr($authUser->name ?? 'A', 0, 2)) }}
                </div>
                <span class="absolute -bottom-1 -right-1 h-3 w-3 rounded-full bg-emerald-400 ring-2 ring-white"></span>
            </div>
        </div>
    </header>

    {{-- ===== STAT CARDS ROW 1 ===== --}}
    <section class="grid gap-4 xl:grid-cols-4">
        {{-- Total Pengajuan --}}
        <article class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200 flex flex-col justify-between hover:-translate-y-1 hover:shadow-md transition-all">
            <div class="flex items-center justify-between mb-4">
                <div class="h-10 w-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-650">
                    <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <span class="px-2.5 py-1 bg-slate-100 text-slate-700 text-[10px] font-bold rounded-full uppercase tracking-wider">Total</span>
            </div>
            <div>
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-1.5">Total Pengajuan</p>
                <p class="text-3xl font-extrabold text-slate-900 mb-2">{{ number_format($totalPengajuan, 0, ',', '.') }}</p>
                <p class="text-xs font-semibold text-slate-500">Pending: <span class="text-amber-600">{{ $sedangMengajukan }}</span> | Ditolak: <span class="text-red-500">{{ $totalDitolak }}</span></p>
            </div>
        </article>

        {{-- Total Disetujui --}}
        <article class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200 flex flex-col justify-between hover:-translate-y-1 hover:shadow-md transition-all">
            <div class="flex items-center justify-between mb-4">
                <div class="h-10 w-10 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <span class="px-2.5 py-1 bg-emerald-50 text-emerald-800 text-[10px] font-bold rounded-full uppercase tracking-wider">Approved</span>
            </div>
            <div>
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-1.5">Disetujui</p>
                <p class="text-3xl font-extrabold text-slate-900 mb-2">{{ number_format($totalDisetujui, 0, ',', '.') }}</p>
                <p class="text-xs font-semibold text-emerald-600">{{ $totalPengajuan > 0 ? round(($totalDisetujui / $totalPengajuan) * 100) : 0 }}% dari total pengajuan</p>
            </div>
        </article>

        {{-- Rata-rata Score --}}
        <article class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200 flex flex-col justify-between hover:-translate-y-1 hover:shadow-md transition-all">
            <div class="flex items-center justify-between mb-4">
                <div class="h-10 w-10 rounded-full bg-amber-50 flex items-center justify-center text-amber-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                </div>
                <span class="text-amber-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                </span>
            </div>
            <div>
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-1.5">Rata-Rata Score Kelayakan</p>
                <p class="text-3xl font-extrabold text-slate-900 mb-2">{{ number_format($rataRataScore, 1, ',', '.') }}</p>
                <p class="text-xs font-semibold text-slate-500">Kualitas penargetan bantuan</p>
            </div>
        </article>

        {{-- Total Pendaftaran --}}
        <article class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200 flex flex-col justify-between hover:-translate-y-1 hover:shadow-md transition-all">
            <div class="flex items-center justify-between mb-4">
                <div class="h-10 w-10 rounded-full bg-cyan-50 flex items-center justify-center text-cyan-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                @if($pendaftaranPending > 0)
                    <span class="px-2.5 py-1 bg-amber-100 text-amber-800 text-[10px] font-bold rounded-full uppercase tracking-wider">{{ $pendaftaranPending }} Baru</span>
                @else
                    <span class="px-2.5 py-1 bg-slate-100 text-slate-700 text-[10px] font-bold rounded-full uppercase tracking-wider">Terkini</span>
                @endif
            </div>
            <div>
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-1.5">Pendaftaran Warga</p>
                <p class="text-3xl font-extrabold text-slate-900 mb-2">{{ number_format($totalPendaftaran, 0, ',', '.') }}</p>
                <p class="text-xs font-semibold text-slate-500"><span class="text-amber-600 font-bold">{{ $pendaftaranPending }}</span> menunggu verifikasi</p>
            </div>
        </article>
    </section>

    {{-- ===== FEEDBACK & LAPORAN ===== --}}
    <section class="grid gap-4 xl:grid-cols-2">
        {{-- Widget Feedback --}}
        <a href="{{ route('admin.feedback.index') }}" class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200 flex items-center gap-5 hover:shadow-md hover:border-cyan-200 transition-all group">
            <div class="h-14 w-14 rounded-2xl bg-cyan-600 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform shadow-sm">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
            </div>
            <div class="flex-1">
                <p class="text-xs text-slate-500 font-bold uppercase tracking-wider mb-1">Masukan / Feedback</p>
                <p class="text-2xl font-bold text-slate-900">{{ $totalFeedback }} <span class="text-xs font-semibold text-slate-400 uppercase tracking-widest">Total</span></p>
                @if($feedbackBelumDitinjau > 0)
                    <p class="text-xs text-cyan-600 font-semibold mt-1">⚠ {{ $feedbackBelumDitinjau }} belum ditinjau</p>
                @else
                    <p class="text-xs text-emerald-600 font-semibold mt-1">✓ Semua masukan sudah ditinjau</p>
                @endif
            </div>
            <svg class="w-5 h-5 text-slate-300 group-hover:text-cyan-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </a>

        {{-- Widget Laporan Penyalahgunaan --}}
        <a href="{{ route('admin.laporan.index') }}" class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200 flex items-center gap-5 hover:shadow-md hover:border-red-200 transition-all group">
            <div class="h-14 w-14 rounded-2xl bg-rose-500 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform shadow-sm">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
            <div class="flex-1">
                <p class="text-xs text-slate-500 font-bold uppercase tracking-wider mb-1">Aduan Penyalahgunaan</p>
                <p class="text-2xl font-bold text-slate-900">{{ $totalLaporan }} <span class="text-xs font-semibold text-slate-400 uppercase tracking-widest">Total</span></p>
                @if($laporanPending > 0)
                    <p class="text-xs text-rose-600 font-semibold mt-1">⚠ {{ $laporanPending }} menunggu tindak lanjut</p>
                @else
                    <p class="text-xs text-emerald-600 font-semibold mt-1">✓ Tidak ada aduan aktif</p>
                @endif
            </div>
            <svg class="w-5 h-5 text-slate-300 group-hover:text-rose-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </a>
    </section>

    {{-- ===== CHART SECTION ===== --}}
    <section class="grid gap-6 xl:grid-cols-1">
        <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200 flex flex-col">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-lg font-semibold text-slate-900">Progres Verifikasi per Wilayah</h2>
                    <p class="text-xs text-slate-400 font-semibold">Data kumulatif pendaftaran regional desa</p>
                </div>
                <a href="{{ route('admin.validasi.export') }}" onclick="event.preventDefault(); document.getElementById('export-form').submit();" class="flex items-center gap-2 bg-slate-900 text-white px-3.5 py-2 rounded-xl text-sm font-medium hover:bg-slate-700 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Export CSV
                </a>
            </div>
            <div class="flex-1 relative min-h-75">
                <canvas id="wilayahChart"></canvas>
            </div>
        </div>
    </section>

    {{-- ===== CHART PENYALURAN BULANAN ===== --}}
    <section class="grid gap-6 xl:grid-cols-1">
        <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200 flex flex-col">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-lg font-semibold text-slate-900">Penyaluran Bantuan Bulanan</h2>
                    <p class="text-xs text-slate-400 font-semibold">Data penyaluran dana bansos per bulan</p>
                </div>
                <div class="flex gap-4 items-center">
                    <div class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full" style="background-color: #3b82f6;"></span><span class="text-xs text-slate-600 font-semibold">Pendidikan</span></div>
                    <div class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full" style="background-color: #10b981;"></span><span class="text-xs text-slate-600 font-semibold">Kesehatan</span></div>
                    <div class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full" style="background-color: #f59e0b;"></span><span class="text-xs text-slate-600 font-semibold">Pangan</span></div>
                    <div class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full" style="background-color: #8b5cf6;"></span><span class="text-xs text-slate-600 font-semibold">Perumahan</span></div>
                </div>
            </div>
            <div class="relative h-64 w-full">
                <canvas id="penyaluranChartAdmin"></canvas>
            </div>
        </div>
    </section>

    {{-- ===== BOTTOM SECTION ===== --}}
    <section class="grid gap-6 xl:grid-cols-12">
        {{-- Kategori Bantuan Donut Chart --}}
        <div class="col-span-12 xl:col-span-5 rounded-3xl bg-white p-6 shadow-sm border border-slate-200 flex flex-col">
            <h2 class="text-lg font-semibold text-slate-900 mb-4">Kategori Bantuan</h2>
            <div class="relative flex items-center justify-center my-2">
                <div class="relative w-44 h-44">
                    <canvas id="kategoriChartAdmin"></canvas>
                    <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                        <span class="text-3xl font-bold text-slate-900">{{ $categoriesList->sum('count') }}</span>
                        <span class="text-[10px] font-semibold text-slate-400 uppercase tracking-widest mt-0.5">Program</span>
                    </div>
                </div>
            </div>
            <div class="mt-4 space-y-2">
                @foreach($categoriesList->filter(fn($i) => $i['percentage'] > 0) as $item)
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full shrink-0" style="background-color: {{ $item['hex'] }}"></span>
                        <span class="text-sm text-slate-600">{{ $item['name'] }}</span>
                    </div>
                    <span class="text-sm font-semibold text-slate-800">{{ $item['percentage'] }}%</span>
                </div>
                @endforeach
                @if($categoriesList->filter(fn($i) => $i['percentage'] > 0)->isEmpty())
                <p class="text-xs text-slate-400 text-center py-4">Belum ada data pengajuan bantuan.</p>
                @endif
            </div>
        </div>

        {{-- Laporan Terkini --}}
        <div class="col-span-12 xl:col-span-7 rounded-3xl bg-white p-6 shadow-sm border border-slate-200 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-semibold text-slate-900">Laporan Terkini</h2>
                    <a href="{{ route('admin.laporan.index') }}" class="text-blue-600 text-sm font-semibold hover:underline">Lihat Semua</a>
                </div>
                <div class="space-y-4">
                    @foreach($recent as $item)
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
                    @endforeach
                    @if($recent->isEmpty())
                        <p class="text-sm text-slate-400 text-center py-4">Belum ada laporan terkini.</p>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>

{{-- Export Form (hidden) --}}
<form id="export-form" action="{{ route('admin.validasi.export') }}" method="GET" class="hidden">
    <input type="hidden" name="start_date" value="{{ now()->startOfMonth()->toDateString() }}">
    <input type="hidden" name="end_date" value="{{ now()->toDateString() }}">
</form>

@endsection

@push('scripts')
<script>
    const wilayahLabels = @json($perWilayah->map(fn($row) => $row['wilayah'] ?? 'Lainnya'));
    const wilayahData = @json($perWilayah->pluck('total'));

    new Chart(document.getElementById('wilayahChart'), {
        type: 'bar',
        data: {
            labels: wilayahLabels,
            datasets: [{
                label: 'Jumlah Penerima',
                data: wilayahData,
                backgroundColor: '#e2e8f0',
                hoverBackgroundColor: '#0f172a',
                borderRadius: 4,
                barPercentage: 0.5,
                categoryPercentage: 0.5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: { grid: { display: false }, ticks: { font: { size: 10, weight: 'bold' }, color: '#64748b' } },
                y: { display: false, beginAtZero: true }
            },
            onHover: (event, chartElement) => {
                event.native.target.style.cursor = chartElement[0] ? 'pointer' : 'default';
            }
        }
    });

    // Chart Penyaluran Bulanan
    const penyaluranBulanAdmin = @json($penyaluranBulanan);
    const labelsPenyaluran = penyaluranBulanAdmin.map(item => item.bulan);
    const dataPendidikanAdmin = penyaluranBulanAdmin.map(item => item.pendidikan);
    const dataKesehatanAdmin = penyaluranBulanAdmin.map(item => item.kesehatan);
    const dataPanganAdmin = penyaluranBulanAdmin.map(item => item.pangan);
    const dataPerumahanAdmin = penyaluranBulanAdmin.map(item => item.perumahan);

    new Chart(document.getElementById('penyaluranChartAdmin'), {
        type: 'bar',
        data: {
            labels: labelsPenyaluran,
            datasets: [
                { label: 'Pendidikan', data: dataPendidikanAdmin, backgroundColor: '#3b82f6', borderRadius: 4, barPercentage: 0.6, categoryPercentage: 0.4 },
                { label: 'Kesehatan', data: dataKesehatanAdmin, backgroundColor: '#10b981', borderRadius: 4, barPercentage: 0.6, categoryPercentage: 0.4 },
                { label: 'Pangan', data: dataPanganAdmin, backgroundColor: '#f59e0b', borderRadius: 4, barPercentage: 0.6, categoryPercentage: 0.4 },
                { label: 'Perumahan', data: dataPerumahanAdmin, backgroundColor: '#8b5cf6', borderRadius: 4, barPercentage: 0.6, categoryPercentage: 0.4 }
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

    const kategoriDataAdmin = @json($categoriesList->filter(fn($i) => $i['percentage'] > 0)->values());
    const hasKategoriDataAdmin = kategoriDataAdmin.length > 0 && kategoriDataAdmin.some(i => i.count > 0);

    if (hasKategoriDataAdmin) {
        new Chart(document.getElementById('kategoriChartAdmin'), {
            type: 'doughnut',
            data: {
                labels: kategoriDataAdmin.map(i => i.name),
                datasets: [{ data: kategoriDataAdmin.map(i => i.count), backgroundColor: kategoriDataAdmin.map(i => i.hex), borderWidth: 0, hoverOffset: 6 }]
            },
            options: {
                responsive: true, maintainAspectRatio: false, cutout: '72%',
                plugins: {
                    legend: { display: false },
                    tooltip: { callbacks: { label: ctx => ` ${ctx.label}: ${ctx.parsed} program (${kategoriDataAdmin[ctx.dataIndex].percentage}%)` } }
                }
            }
        });
    } else {
        new Chart(document.getElementById('kategoriChartAdmin'), {
            type: 'doughnut',
            data: { datasets: [{ data: [1], backgroundColor: ['#e2e8f0'], borderWidth: 0 }] },
            options: { responsive: true, maintainAspectRatio: false, cutout: '72%', plugins: { legend: { display: false }, tooltip: { enabled: false } } }
        });
    }
</script>
@endpush
