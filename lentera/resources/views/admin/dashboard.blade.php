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
                    <article class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
                        <p class="text-sm text-slate-500">Total Bantuan</p>
                        <p class="mt-3 text-3xl font-semibold">Rp {{ number_format($summary['total_bantuan'], 0, ',', '.') }}</p>
                        <p class="mt-2 text-sm text-emerald-600">+12% sejak bulan lalu</p>
                    </article>
                    <article class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
                        <p class="text-sm text-slate-500">Pengajuan Pending</p>
                        <p class="mt-3 text-3xl font-semibold">{{ $summary['pending'] }}</p>
                    </article>
                    <article class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
                        <p class="text-sm text-slate-500">Jenis Program</p>
                        <p class="mt-3 text-3xl font-semibold">{{ $summary['program_count'] }}</p>
                    </article>
                    <article class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
                        <p class="text-sm text-slate-500">Jumlah Wilayah</p>
                        <p class="mt-3 text-3xl font-semibold">{{ $summary['wilayah_count'] }}</p>
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
