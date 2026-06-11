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
<<<<<<< Updated upstream
                <div class="mt-10 border-t border-slate-200 pt-6 space-y-4 text-sm text-slate-500">
                    <div class="flex items-center justify-between">
                        <span>Pusat Bantuan</span>
                        <span class="text-slate-900">08-800-100-101</span>
=======

                <nav class="space-y-1 flex-1">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 rounded-2xl bg-cyan-600 text-white px-4 py-3 shadow font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        Overview
                    </a>
                    <a href="{{ route('admin.validasi.index') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-600 hover:bg-slate-100 font-medium transition-colors">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Validasi Pengajuan
                        @if($sedangMengajukan > 0)
                            <span class="ml-auto bg-amber-100 text-amber-700 text-xs font-bold px-2 py-0.5 rounded-full">{{ $sedangMengajukan }}</span>
                        @endif
                    </a>
                    <a href="{{ route('admin.broadcast.index') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-600 hover:bg-slate-100 font-medium transition-colors">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        Broadcast Notifikasi
                    </a>
                    <a href="{{ route('admin.monitoring') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-600 hover:bg-slate-100 font-medium transition-colors">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        Monitoring Dana
                    </a>
                    <a href="{{ route('admin.laporan.index') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-600 hover:bg-slate-100 font-medium transition-colors">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        Laporan
                        @if($laporanPending > 0)
                            <span class="ml-auto bg-red-100 text-red-600 text-xs font-bold px-2 py-0.5 rounded-full">{{ $laporanPending }}</span>
                        @endif
                    </a>
                    <a href="{{ route('admin.feedback.index') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-600 hover:bg-slate-100 font-medium transition-colors">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                        Feedback
                        @if($feedbackBelumDitinjau > 0)
                            <span class="ml-auto bg-blue-100 text-blue-600 text-xs font-bold px-2 py-0.5 rounded-full">{{ $feedbackBelumDitinjau }}</span>
                        @endif
                    </a>
                </nav>

                <div class="mt-6 pt-6 border-t border-slate-200 space-y-4">
                    <div class="text-sm text-slate-500 space-y-1">
                        <div class="flex items-center justify-between">
                            <span>Pusat Bantuan</span>
                            <span class="text-slate-900 font-medium">08-800-100-101</span>
                        </div>
                        <p>Pelayanan distribusi bantuan dan pelaporan masalah.</p>
>>>>>>> Stashed changes
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
