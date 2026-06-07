<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validasi & Verifikasi - LENTERA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F3F4F6] min-h-screen p-6 font-['Inter']">

<div class="max-w-5xl mx-auto">

    <div class="mb-6 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-[#1C2C4E]">Validasi & Verifikasi</h1>
            <p class="text-sm text-slate-500 mt-1">Periksa dan validasi dokumen pengajuan bantuan masuk.</p>
        </div>
        <div>
            <button onclick="openExportModal()" class="flex items-center gap-2 bg-[#1C2C4E] hover:bg-[#111A31] text-white px-4 py-2.5 rounded-xl text-sm font-semibold transition-colors shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                Export Data
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 text-green-600 text-sm p-4 rounded-xl border border-green-100 mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-3 gap-4 mb-6">

        <div class="bg-white rounded-2xl shadow p-5">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Total Pengajuan</p>
            <p class="text-2xl font-bold text-[#1C2C4E]">{{ $pengajuan->count() }}</p>
        </div>

        <div class="bg-white rounded-2xl shadow p-5">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Pending</p>
            <p class="text-2xl font-bold text-yellow-500">{{ $pengajuan->where('status_pengajuan', 'pending')->count() }}</p>
        </div>

        <div class="bg-white rounded-2xl shadow p-5">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Diverifikasi</p>
            <p class="text-2xl font-bold text-green-500">{{ $pengajuan->where('status_pengajuan', 'diverifikasi')->count() }}</p>
        </div>

    </div>

    <div class="bg-white rounded-2xl shadow overflow-hidden">

        <div class="p-6 border-b border-slate-100">
            <h2 class="text-sm font-bold text-slate-600 uppercase tracking-widest">Daftar Pengajuan Masuk</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-[#F0F2F5] text-left">
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-widest">Nama</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-widest">Jenis Bantuan</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-widest">Tanggal</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-widest">Dokumen</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-widest">Status</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-widest">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($pengajuan as $item)
                        <tr class="hover:bg-[#F8F9FA] transition-colors">

                            <td class="px-6 py-4">
                                <p class="font-semibold text-slate-800">{{ $item->user->name }}</p>
                                <p class="text-xs text-slate-400">{{ $item->user->email }}</p>
                            </td>

                            <td class="px-6 py-4 font-medium text-slate-700">
                                {{ $item->jenis_bantuan }}
                            </td>

                            <td class="px-6 py-4 text-slate-500">
                                {{ $item->tanggal_pengajuan }}
                            </td>

                            <td class="px-6 py-4">
                                <span class="text-xs font-semibold bg-blue-50 text-blue-600 px-2 py-1 rounded-lg">
                                    {{ $item->dokumen->count() }} file
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                @if($item->status_pengajuan == 'pending')
                                    <span class="text-xs font-bold bg-yellow-50 text-yellow-600 px-3 py-1 rounded-full">
                                        Pending
                                    </span>
                                @elseif($item->status_pengajuan == 'diverifikasi')
                                    <span class="text-xs font-bold bg-green-50 text-green-600 px-3 py-1 rounded-full">
                                        Diverifikasi
                                    </span>
                                @elseif($item->status_pengajuan == 'ditolak')
                                    <span class="text-xs font-bold bg-red-50 text-red-600 px-3 py-1 rounded-full">
                                        Ditolak
                                    </span>
                                @else
                                    <span class="text-xs font-bold bg-slate-50 text-slate-600 px-3 py-1 rounded-full">
                                        {{ $item->status_pengajuan }}
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                <a href="{{ route('admin.validasi.show', $item->id_pengajuan) }}"
                                    class="text-xs font-bold text-white bg-[#1C2C4E] px-4 py-2 rounded-lg hover:bg-[#111A31] transition-colors">
                                    Periksa
                                </a>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-slate-400 text-sm">
                                Belum ada pengajuan masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>

<!-- Export Modal -->
<div id="exportModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" onclick="closeExportModal()"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-md bg-white rounded-3xl shadow-xl overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50">
            <div>
                <h3 class="font-bold text-[#1C2C4E] text-lg">Export Data Pengajuan</h3>
                <p class="text-xs text-slate-500 mt-0.5">Pilih periode tanggal untuk diekspor ke CSV</p>
            </div>
            <button onclick="closeExportModal()" class="text-slate-400 hover:text-slate-600 p-2 rounded-full hover:bg-slate-200 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <form action="{{ route('admin.validasi.export') }}" method="GET" class="p-6 space-y-5">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Dari Tanggal</label>
                    <input type="date" name="start_date" required class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#1C2C4E] focus:border-[#1C2C4E] outline-none transition-all">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Sampai Tanggal</label>
                    <input type="date" name="end_date" required class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#1C2C4E] focus:border-[#1C2C4E] outline-none transition-all">
                </div>
            </div>
            
            <div class="pt-4 flex gap-3 border-t border-slate-100">
                <button type="button" onclick="closeExportModal()" class="flex-1 px-4 py-2.5 border border-slate-200 text-slate-600 rounded-xl text-sm font-semibold hover:bg-slate-50 transition-colors">Batal</button>
                <button type="submit" class="flex-1 px-4 py-2.5 bg-[#1C2C4E] text-white rounded-xl text-sm font-semibold hover:bg-[#111A31] transition-colors shadow-sm">Export CSV</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openExportModal() {
        document.getElementById('exportModal').classList.remove('hidden');
    }
    function closeExportModal() {
        document.getElementById('exportModal').classList.add('hidden');
    }
</script>

</body>
</html>