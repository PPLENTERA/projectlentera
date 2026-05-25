<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    @vite(['resources/css/app.css'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
</head>
<body class="bg-slate-50 text-slate-900">
    <div class="min-h-screen">
        <div class="grid grid-cols-12 gap-6 p-6">
            <aside class="col-span-12 xl:col-span-3 bg-white rounded-3xl border border-slate-200 p-6 shadow-sm">
                <div class="flex items-center gap-3 mb-8">
                    <div class="h-12 w-12 rounded-2xl bg-cyan-600 text-white flex items-center justify-center text-lg font-semibold">L</div>
                    <div>
                        <p class="text-slate-500 text-sm">LENTERA</p>
                        <p class="font-semibold">Panel Transparansi</p>
                    </div>
                </div>
                <div class="space-y-4">
                    <a href="#" class="block rounded-2xl bg-cyan-600 text-white px-4 py-3 shadow">Overview</a>
                    <a href="#" class="block rounded-2xl px-4 py-3 text-slate-600 hover:bg-slate-100">Pengajuan</a>
                    <a href="#" class="block rounded-2xl px-4 py-3 text-slate-600 hover:bg-slate-100">Riwayat</a>
                    <a href="#" class="block rounded-2xl px-4 py-3 text-slate-600 hover:bg-slate-100">Monitoring</a>
                    <a href="#" class="block rounded-2xl px-4 py-3 text-slate-600 hover:bg-slate-100">Statistik</a>
                    <a href="#" class="block rounded-2xl px-4 py-3 text-slate-600 hover:bg-slate-100">Laporan</a>
                </div>
                <div class="mt-10 border-t border-slate-200 pt-6 space-y-4 text-sm text-slate-500">
                    <div class="flex items-center justify-between">
                        <span>Pusat Bantuan</span>
                        <span class="text-slate-900">08-800-100-101</span>
                    </div>
                    <p>Pelayanan distribusi bantuan dan pelaporan masalah.</p>
                </div>
            </aside>

            <main class="col-span-12 xl:col-span-9 space-y-6">
                <header class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <p class="text-sm text-slate-500">Dashboard Overview</p>
                        <h1 class="text-3xl font-semibold">Monitoring Distribusi Bantuan</h1>
                    </div>
                    <div class="flex items-center gap-4 rounded-3xl bg-white p-4 shadow-sm border border-slate-200">
                        <div class="text-right">
                            <p class="text-sm text-slate-500">Budi Santoso</p>
                            <p class="font-semibold">Admin</p>
                        </div>
                        <div class="h-12 w-12 rounded-full bg-slate-200 flex items-center justify-center">BS</div>
                    </div>
                </header>

                <section class="grid gap-4 xl:grid-cols-4">
                    <article class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200 flex flex-col justify-between">
                        <div class="flex items-center justify-between mb-4">
                            <div class="h-10 w-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <span class="px-2 py-1 bg-emerald-100 text-emerald-700 text-xs font-semibold rounded-full">+12%</span>
                        </div>
                        <p class="text-xs text-slate-500 font-medium uppercase tracking-wider mb-1">Total Pengajuan</p>
                        <p class="text-3xl font-bold text-slate-900 mb-2">{{ number_format($totalPengajuan, 0, ',', '.') }}</p>
                        <p class="text-xs text-slate-400">Update terakhir 5 menit yang lalu</p>
                    </article>

                    <article class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200 flex flex-col justify-between">
                        <div class="flex items-center justify-between mb-4">
                            <div class="h-10 w-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <span class="px-2 py-1 bg-emerald-100 text-emerald-700 text-xs font-semibold rounded-full">+8%</span>
                        </div>
                        <p class="text-xs text-slate-500 font-medium uppercase tracking-wider mb-1">Total Disetujui</p>
                        <p class="text-3xl font-bold text-slate-900 mb-2">{{ number_format($totalDisetujui, 0, ',', '.') }}</p>
                        <p class="text-xs text-slate-400">74% Target tercapai</p>
                    </article>

                    <article class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200 flex flex-col justify-between">
                        <div class="flex items-center justify-between mb-4">
                            <div class="h-10 w-10 rounded-full bg-amber-50 flex items-center justify-center text-amber-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                            </div>
                            <span class="text-amber-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                            </span>
                        </div>
                        <p class="text-xs text-slate-500 font-medium uppercase tracking-wider mb-1">Rata-Rata Score</p>
                        <p class="text-3xl font-bold text-slate-900 mb-2">{{ number_format($rataRataScore, 1, ',', '.') }}</p>
                        <p class="text-xs text-slate-400">Kualitas pendaftar meningkat</p>
                    </article>

                    <article class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200 flex flex-col justify-between">
                        <div class="flex items-center justify-between mb-4">
                            <div class="h-10 w-10 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <span class="text-xs font-bold text-slate-600">Rp</span>
                        </div>
                        <p class="text-xs text-slate-500 font-medium uppercase tracking-wider mb-1">Total Bantuan</p>
                        <p class="text-3xl font-bold text-slate-900 mb-2">4.2B</p>
                        <p class="text-xs text-slate-400">Penyaluran dana Tahap III</p>
                    </article>
                </section>

                <section class="grid gap-6 xl:grid-cols-[2fr_1fr]">
                    <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200 flex flex-col">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h2 class="text-lg font-semibold text-slate-900">Progres Verifikasi per Wilayah</h2>
                                <p class="text-sm text-slate-500">Data kumulatif berdasarkan provinsi terpilih</p>
                            </div>
                            <button class="flex items-center gap-2 bg-slate-50 border border-slate-200 px-3 py-1.5 rounded-xl text-sm font-medium text-slate-700 hover:bg-slate-100">
                                Provinsi Jawa Barat
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                        </div>
                        <div class="flex-1 relative min-h-[300px]">
                            <canvas id="wilayahChart"></canvas>
                        </div>
                    </div>
                    <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200 flex flex-col">
                        <h2 class="text-lg font-semibold text-slate-900 mb-6">Status Pendaftaran</h2>
                        <div class="space-y-4 mb-8">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                                    <span class="text-sm font-medium text-slate-700">Selesai Verifikasi</span>
                                </div>
                                <span class="font-bold text-slate-900">7.204</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <span class="w-2.5 h-2.5 rounded-full bg-amber-400"></span>
                                    <span class="text-sm font-medium text-slate-700">Dalam Proses</span>
                                </div>
                                <span class="font-bold text-slate-900">3.120</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <span class="w-2.5 h-2.5 rounded-full bg-red-500"></span>
                                    <span class="text-sm font-medium text-slate-700">Ditolak / Revisi</span>
                                </div>
                                <span class="font-bold text-slate-900">2.518</span>
                            </div>
                        </div>
                        <div class="rounded-2xl bg-slate-50 p-5 mt-auto">
                            <h3 class="text-sm font-bold text-slate-900 mb-2">Pemberitahuan Sistem</h3>
                            <p class="text-xs text-slate-500 leading-relaxed mb-3">Integrasi data NIK Dukcapil telah diperbarui otomatis. Silakan periksa dashboard sinkronisasi untuk detail lebih lanjut.</p>
                            <a href="#" class="text-blue-600 text-xs font-semibold hover:underline flex items-center gap-1">Lihat Selengkapnya <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a>
                        </div>
                    </div>
                </section>

                <section class="grid gap-6 xl:grid-cols-12 mt-6">
                    <!-- Kategori Bantuan Donut Chart Card -->
                    <div class="col-span-12 xl:col-span-5 rounded-3xl bg-white p-6 shadow-sm border border-slate-200 flex flex-col">
                        <h2 class="text-lg font-semibold text-slate-900 mb-4">Kategori Bantuan</h2>

                        <!-- Donut Chart -->
                        <div class="relative flex items-center justify-center my-2">
                            <div class="relative w-44 h-44">
                                <canvas id="kategoriChartAdmin"></canvas>
                                <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                                    <span class="text-3xl font-bold text-slate-900">{{ $categoriesList->sum('count') }}</span>
                                    <span class="text-[10px] font-semibold text-slate-400 uppercase tracking-widest mt-0.5">Program</span>
                                </div>
                            </div>
                        </div>

                        <!-- Legend -->
                        <div class="mt-4 space-y-2">
                            @foreach($categoriesList->filter(fn($i) => $i['percentage'] > 0) as $item)
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full flex-shrink-0" style="background-color: {{ $item['hex'] }}"></span>
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

                    <!-- Laporan Terkini Card -->
                    <div class="col-span-12 xl:col-span-7 rounded-3xl bg-white p-6 shadow-sm border border-slate-200 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="text-lg font-semibold text-slate-900">Laporan Terkini</h2>
                                <a href="#" class="text-blue-600 text-sm font-semibold hover:underline">Lihat Semua</a>
                            </div>
                            <div class="space-y-4">
                                @foreach($recent as $item)
                                    <div class="flex items-start gap-4">
                                        <div class="h-12 w-12 rounded-2xl bg-slate-900 text-white flex items-center justify-center flex-shrink-0">
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
                            </div>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </div>

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
                    backgroundColor: '#e2e8f0', // slate-200 for inactive
                    hoverBackgroundColor: '#0f172a', // slate-900 for active/hover
                    borderRadius: 4,
                    barPercentage: 0.5,
                    categoryPercentage: 0.5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                },
                scales: {
                    x: { 
                        grid: { display: false },
                        ticks: { font: { size: 10, weight: 'bold' }, color: '#64748b' }
                    },
                    y: { 
                        display: false,
                        beginAtZero: true 
                    }
                },
                onHover: (event, chartElement) => {
                    event.native.target.style.cursor = chartElement[0] ? 'pointer' : 'default';
                }
            }
        });

        // Kategori Bantuan Donut Chart (Admin)
        const kategoriDataAdmin = @json($categoriesList->filter(fn($i) => $i['percentage'] > 0)->values());
        const hasKategoriDataAdmin = kategoriDataAdmin.length > 0 && kategoriDataAdmin.some(i => i.count > 0);

        if (hasKategoriDataAdmin) {
            new Chart(document.getElementById('kategoriChartAdmin'), {
                type: 'doughnut',
                data: {
                    labels: kategoriDataAdmin.map(i => i.name),
                    datasets: [{
                        data: kategoriDataAdmin.map(i => i.count),
                        backgroundColor: kategoriDataAdmin.map(i => i.hex),
                        borderWidth: 0,
                        hoverOffset: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '72%',
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: ctx => ` ${ctx.label}: ${ctx.parsed} program (${kategoriDataAdmin[ctx.dataIndex].percentage}%)`
                            }
                        }
                    }
                }
            });
        } else {
            new Chart(document.getElementById('kategoriChartAdmin'), {
                type: 'doughnut',
                data: {
                    datasets: [{ data: [1], backgroundColor: ['#e2e8f0'], borderWidth: 0 }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '72%',
                    plugins: { legend: { display: false }, tooltip: { enabled: false } }
                }
            });
        }
    </script>
</body>
</html>
