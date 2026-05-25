<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Masyarakat</title>
    @vite(['resources/css/app.css'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
</head>
<body class="bg-slate-50 text-slate-900">
    <div class="min-h-screen">
        <div class="grid grid-cols-12 gap-6 p-6">
            <aside class="col-span-12 xl:col-span-3 bg-white rounded-3xl border border-slate-200 p-6 shadow-sm">
                <div class="flex items-center gap-3 mb-8">
                    <div class="h-12 w-12 rounded-2xl bg-slate-900 text-white flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <div>
                        <p class="text-slate-900 font-semibold uppercase tracking-wider text-xs">LENTERA</p>
                        <p class="text-slate-500 text-xs font-medium uppercase tracking-wider">Panel Transparansi</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 mb-8 p-3 rounded-2xl border border-slate-100 bg-slate-50">
                    <div class="h-10 w-10 rounded-full bg-orange-100 flex items-center justify-center">
                        <span class="text-orange-500 font-semibold">VC</span>
                    </div>
                    <div>
                        <p class="font-semibold text-sm">Verified Citizen</p>
                        <p class="text-slate-500 text-xs">Jakarta Pusat</p>
                    </div>
                </div>
                <div class="space-y-2">
                    <a href="#" class="flex items-center gap-3 rounded-2xl bg-white border border-slate-200 text-slate-900 px-4 py-3 shadow-sm font-medium">
                        <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        Overview
                    </a>
                    <a href="#" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-600 hover:bg-slate-100 font-medium">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Pengajuan
                    </a>
                    <a href="#" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-600 hover:bg-slate-100 font-medium">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Riwayat
                    </a>
                    <a href="#" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-600 hover:bg-slate-100 font-medium">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        Monitoring
                    </a>
                    <a href="#" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-600 hover:bg-slate-100 font-medium">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        Statistik
                    </a>
                    <a href="#" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-600 hover:bg-slate-100 font-medium">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Laporan
                    </a>
                </div>
            </aside>

            <main class="col-span-12 xl:col-span-9 space-y-6">
                <header class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-xl font-bold text-slate-900">Dashboard Overview</h1>
                    </div>
                    <div class="flex items-center gap-6">
                        <button class="relative text-slate-400 hover:text-slate-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                            <span class="absolute top-0 right-0 w-2.5 h-2.5 bg-red-500 border-2 border-slate-50 rounded-full"></span>
                        </button>
                        <div class="flex items-center gap-3">
                            <div class="text-right hidden md:block">
                                <p class="text-sm font-semibold text-slate-900">Budi Santoso</p>
                                <p class="text-xs text-slate-400">ID: 982910</p>
                            </div>
                            <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center font-bold text-blue-600">
                                BS
                            </div>
                        </div>
                    </div>
                </header>

                <section class="grid gap-4 xl:grid-cols-4">
                    <article class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200 flex flex-col justify-between">
                        <div class="flex items-center justify-between mb-4">
                            <div class="h-10 w-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <span class="text-xs font-semibold text-emerald-600">+12%</span>
                        </div>
                        <p class="text-xs text-slate-500 font-medium uppercase tracking-wider mb-1">Total Bantuan</p>
                        <p class="text-2xl font-bold text-slate-900 mb-2">Rp {{ number_format($totalBantuan, 0, ',', '.') }}</p>
                        <p class="text-xs text-slate-400">Akumulasi periode 2023</p>
                    </article>

                    <article class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200 flex flex-col justify-between">
                        <div class="flex items-center justify-between mb-4">
                            <div class="h-10 w-10 rounded-full bg-amber-50 flex items-center justify-center text-amber-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                            </div>
                            <span class="text-xs font-medium text-slate-500">2 Aktif</span>
                        </div>
                        <p class="text-xs text-slate-500 font-medium uppercase tracking-wider mb-1">Pengajuan Pending</p>
                        <p class="text-2xl font-bold text-slate-900 mb-2">{{ str_pad($pengajuanPending, 2, '0', STR_PAD_LEFT) }} Unit</p>
                        <p class="text-xs text-slate-400">Menunggu verifikasi RT/RW</p>
                    </article>

                    <article class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200 flex flex-col justify-between">
                        <div class="flex items-center justify-between mb-4">
                            <div class="h-10 w-10 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <span class="text-xs font-semibold text-emerald-600">Clear</span>
                        </div>
                        <p class="text-xs text-slate-500 font-medium uppercase tracking-wider mb-1">Disetujui</p>
                        <p class="text-2xl font-bold text-slate-900 mb-2">{{ str_pad($disetujui, 2, '0', STR_PAD_LEFT) }} Program</p>
                        <p class="text-xs text-slate-400">Terverifikasi sistem pusat</p>
                    </article>

                    <article class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200 flex flex-col justify-between">
                        <div class="flex items-center justify-between mb-4">
                            <div class="h-10 w-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <span class="text-xs font-medium text-slate-500">0 Baru</span>
                        </div>
                        <p class="text-xs text-slate-500 font-medium uppercase tracking-wider mb-1">Ditolak</p>
                        <p class="text-2xl font-bold text-slate-900 mb-2">{{ str_pad($ditolak, 2, '0', STR_PAD_LEFT) }} Berkas</p>
                        <p class="text-xs text-slate-400">Perlu perbaikan data NIK</p>
                    </article>
                </section>
                <section class="grid gap-6 mt-6">
                    <div class="col-span-12 rounded-3xl bg-white p-6 shadow-sm border border-slate-200 flex flex-col">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h2 class="text-lg font-semibold text-slate-900">Penyaluran Bantuan Bulanan</h2>
                                <p class="text-sm text-slate-500">Data real-time penyaluran dana bansos wilayah Jakarta Pusat</p>
                            </div>
                            <div class="flex gap-4 items-center">
                                <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-slate-800"></span><span class="text-xs text-slate-600">Dana Tunai</span></div>
                                <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-emerald-500"></span><span class="text-xs text-slate-600">Sembako</span></div>
                            </div>
                        </div>
                        <div class="relative h-64 w-full">
                            <canvas id="penyaluranChart"></canvas>
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
                                <canvas id="kategoriChart"></canvas>
                                <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                                    <span class="text-3xl font-bold text-slate-900" id="kategoriTotal">{{ $categoriesList->sum('count') }}</span>
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
        const penyaluranBulanan = @json($penyaluranBulanan);

        // Penyaluran Chart
        const labelsPenyaluran = penyaluranBulanan.map(item => item.bulan);
        const dataTunai = penyaluranBulanan.map(item => item.dana_tunai);
        const dataSembako = penyaluranBulanan.map(item => item.sembako);

        new Chart(document.getElementById('penyaluranChart'), {
            type: 'bar',
            data: {
                labels: labelsPenyaluran,
                datasets: [
                    {
                        label: 'Dana Tunai',
                        data: dataTunai,
                        backgroundColor: '#1e293b', // slate-800
                        borderRadius: 4,
                        barPercentage: 0.6,
                        categoryPercentage: 0.4
                    },
                    {
                        label: 'Sembako',
                        data: dataSembako,
                        backgroundColor: '#10b981', // emerald-500
                        borderRadius: 4,
                        barPercentage: 0.6,
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
                        ticks: { font: { size: 12, weight: 'bold' }, color: '#64748b' }
                    },
                    y: {
                        display: false,
                        grid: { display: false }
                    }
                }
            }
        });

        // Kategori Bantuan Donut Chart
        const kategoriData = @json($categoriesList->filter(fn($i) => $i['percentage'] > 0)->values());
        const hasKategoriData = kategoriData.length > 0 && kategoriData.some(i => i.count > 0);

        if (hasKategoriData) {
            new Chart(document.getElementById('kategoriChart'), {
                type: 'doughnut',
                data: {
                    labels: kategoriData.map(i => i.name),
                    datasets: [{
                        data: kategoriData.map(i => i.count),
                        backgroundColor: kategoriData.map(i => i.hex),
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
                                label: ctx => ` ${ctx.label}: ${ctx.parsed} program (${kategoriData[ctx.dataIndex].percentage}%)`
                            }
                        }
                    }
                }
            });
        } else {
            // Empty state: show a light grey ring
            new Chart(document.getElementById('kategoriChart'), {
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
