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
                    <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <p class="text-sm text-slate-500">Penyaluran Bantuan Bulanan</p>
                                <h2 class="text-xl font-semibold">Rekap penerima per wilayah</h2>
                            </div>
                        </div>
                        <div class="h-80">
                            <canvas id="wilayahChart"></canvas>
                        </div>
                    </div>
                    <div class="space-y-6">
                        <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
                            <div class="flex items-center justify-between mb-6">
                                <div>
                                    <p class="text-sm text-slate-500">Kategori Bantuan</p>
                                    <h2 class="text-xl font-semibold">Pembagian program</h2>
                                </div>
                                <a href="#" class="text-cyan-600 text-sm font-medium">Lihat semua</a>
                            </div>
                            <div class="h-60"><canvas id="programChart"></canvas></div>
                        </div>
                        <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
                            <div class="flex items-center justify-between mb-6">
                                <div>
                                    <p class="text-sm text-slate-500">Laporan Terkini</p>
                                    <h2 class="text-xl font-semibold">Update distribusi</h2>
                                </div>
                                <a href="#" class="text-slate-400 text-sm">Lihat semua</a>
                            </div>
                            <div class="space-y-4">
                                @foreach($recent as $item)
                                    <div class="rounded-3xl bg-slate-50 p-4">
                                        <p class="text-sm font-semibold">{{ $item['jenis_bantuan'] }} — {{ $item['user']['alamat'] }}</p>
                                        <p class="mt-1 text-sm text-slate-500">{{ $item['user']['nama'] }} / {{ $item['status_pengajuan'] }}</p>
                                        <p class="mt-2 text-xs text-slate-400">Pengajuan: {{ \Illuminate\Support\Carbon::parse($item['tanggal_pengajuan'])->format('d M Y') }}</p>
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

        const programLabels = @json($category->pluck('program'));
        const programData = @json($category->pluck('total'));

        new Chart(document.getElementById('wilayahChart'), {
            type: 'bar',
            data: {
                labels: wilayahLabels,
                datasets: [{
                    label: 'Jumlah Penerima',
                    data: wilayahData,
                    backgroundColor: 'rgba(34, 211, 238, 0.8)',
                    borderRadius: 12,
                    maxBarThickness: 40,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                },
                scales: {
                    y: { beginAtZero: true, ticks: { precision: 0 } }
                }
            }
        });

        new Chart(document.getElementById('programChart'), {
            type: 'doughnut',
            data: {
                labels: programLabels,
                datasets: [{
                    data: programData,
                    backgroundColor: ['#06b6d4', '#8b5cf6', '#f97316', '#22c55e'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });
    </script>
</body>
</html>
