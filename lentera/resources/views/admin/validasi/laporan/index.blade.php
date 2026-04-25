<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Status Laporan - LENTERA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F3F4F6] min-h-screen p-6 font-['Inter']">

<div class="max-w-6xl mx-auto">

    <div class="mb-6 flex justify-between items-end">
        <div>
            <h1 class="text-2xl font-bold text-[#1C2C4E]">Manajemen Laporan Penyalahgunaan</h1>
            <p class="text-sm text-slate-500 mt-1">Kelola dan tindak lanjuti laporan dari masyarakat.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="text-sm font-bold text-slate-500 hover:text-[#1C2C4E] transition-colors">
            &larr; Kembali ke Dashboard
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-50 text-green-600 text-sm p-4 rounded-xl border border-green-100 mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-4 gap-4 mb-6">

        <div class="bg-white rounded-2xl shadow p-5 border-l-4 border-[#1C2C4E]">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Total Laporan</p>
            <p class="text-2xl font-bold text-[#1C2C4E]">{{ $laporan->count() }}</p>
        </div>

        <div class="bg-white rounded-2xl shadow p-5 border-l-4 border-yellow-400">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Menunggu</p>
            <p class="text-2xl font-bold text-yellow-500">{{ $laporan->where('status', 'menunggu_tindak_lanjut')->count() }}</p>
        </div>

        <div class="bg-white rounded-2xl shadow p-5 border-l-4 border-blue-400">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Diproses</p>
            <p class="text-2xl font-bold text-blue-500">{{ $laporan->where('status', 'diproses')->count() }}</p>
        </div>

        <div class="bg-white rounded-2xl shadow p-5 border-l-4 border-green-400">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Selesai</p>
            <p class="text-2xl font-bold text-green-500">{{ $laporan->where('status', 'selesai')->count() }}</p>
        </div>

    </div>

    <div class="bg-white rounded-2xl shadow overflow-hidden">

        <div class="p-6 border-b border-slate-100 flex justify-between items-center">
            <h2 class="text-sm font-bold text-slate-600 uppercase tracking-widest">Daftar Laporan Masuk</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-[#F0F2F5] text-left">
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-widest">Pelapor</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-widest">Deskripsi Kejadian</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-widest">Lokasi</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-widest">Tanggal</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-widest">Status</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-widest">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($laporan as $item)
                        <tr class="hover:bg-[#F8F9FA] transition-colors">

                            <td class="px-6 py-4">
                                <p class="font-semibold text-slate-800">{{ $item->user->name }}</p>
                                <p class="text-xs text-slate-400">{{ $item->user->email }}</p>
                            </td>

                            <td class="px-6 py-4">
                                <p class="text-slate-700 line-clamp-2" title="{{ $item->deskripsi_kejadian }}">
                                    {{ Str::limit($item->deskripsi_kejadian, 50) }}
                                </p>
                            </td>

                            <td class="px-6 py-4 text-slate-700">
                                {{ Str::limit($item->lokasi_kejadian, 30) }}
                            </td>

                            <td class="px-6 py-4 text-slate-500 whitespace-nowrap">
                                {{ $item->created_at->format('d M Y') }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($item->status == 'menunggu_tindak_lanjut')
                                    <span class="text-xs font-bold bg-yellow-50 text-yellow-600 px-3 py-1 rounded-full">
                                        Menunggu
                                    </span>
                                @elseif($item->status == 'diproses')
                                    <span class="text-xs font-bold bg-blue-50 text-blue-600 px-3 py-1 rounded-full">
                                        Diproses
                                    </span>
                                @elseif($item->status == 'selesai')
                                    <span class="text-xs font-bold bg-green-50 text-green-600 px-3 py-1 rounded-full">
                                        Selesai
                                    </span>
                                @elseif($item->status == 'ditolak')
                                    <span class="text-xs font-bold bg-red-50 text-red-600 px-3 py-1 rounded-full">
                                        Ditolak
                                    </span>
                                @else
                                    <span class="text-xs font-bold bg-slate-50 text-slate-600 px-3 py-1 rounded-full">
                                        {{ str_replace('_', ' ', $item->status) }}
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                <a href="{{ route('admin.laporan.show', $item->id) }}"
                                    class="text-xs font-bold text-white bg-[#1C2C4E] px-4 py-2 rounded-lg hover:bg-[#111A31] transition-colors inline-block">
                                    Periksa
                                </a>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-slate-400 text-sm">
                                Belum ada laporan penyalahgunaan masuk.
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