@section('title', 'Validasi & Verifikasi')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <header class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <p class="text-sm text-slate-500">Validasi & Verifikasi</p>
            <h1 class="text-3xl font-semibold">Validasi Pengajuan Bantuan</h1>
        </div>
        <button onclick="openExportModal()" class="flex items-center gap-2 bg-slate-900 text-white px-4 py-2.5 rounded-2xl text-sm font-medium hover:bg-slate-700 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
            Export CSV
        </button>
    </header>

    {{-- Stat Cards --}}
    <section class="grid gap-4 grid-cols-3">
        <article class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
            <p class="text-xs text-slate-500 font-bold uppercase tracking-wider mb-1">Total Pengajuan</p>
            <p class="text-3xl font-extrabold text-slate-900">{{ $pengajuan->count() }}</p>
        </article>
        <article class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
            <p class="text-xs text-slate-500 font-bold uppercase tracking-wider mb-1">Pending</p>
            <p class="text-3xl font-extrabold text-amber-600">{{ $pengajuan->where('status_pengajuan', 'pending')->count() }}</p>
        </article>
        <article class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
            <p class="text-xs text-slate-500 font-bold uppercase tracking-wider mb-1">Diverifikasi</p>
            <p class="text-3xl font-extrabold text-emerald-600">{{ $pengajuan->where('status_pengajuan', 'diverifikasi')->count() }}</p>
        </article>
    </section>

    {{-- Filter Form --}}
    <form action="{{ route('admin.validasi.index') }}" method="GET" class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200 flex flex-wrap gap-4 items-end">
        <div class="flex flex-col gap-2 flex-1 min-w-[200px]">
            <label class="text-xs font-bold text-slate-600 uppercase tracking-wider">Jenis Bantuan</label>
            <select name="jenis_bantuan" class="px-4 py-2.5 bg-slate-50 rounded-lg text-sm font-medium text-slate-800 outline-none border border-slate-200 focus:ring-2 focus:ring-cyan-600">
                <option value="">Semua Bantuan</option>
                <option value="Bantuan Pangan" {{ request('jenis_bantuan') == 'Bantuan Pangan' ? 'selected' : '' }}>Bantuan Pangan</option>
                <option value="Bantuan Kesehatan" {{ request('jenis_bantuan') == 'Bantuan Kesehatan' ? 'selected' : '' }}>Bantuan Kesehatan</option>
                <option value="Bantuan Pendidikan" {{ request('jenis_bantuan') == 'Bantuan Pendidikan' ? 'selected' : '' }}>Bantuan Pendidikan</option>
                <option value="Bantuan Perumahan" {{ request('jenis_bantuan') == 'Bantuan Perumahan' ? 'selected' : '' }}>Bantuan Perumahan</option>
            </select>
        </div>
        <div class="flex flex-col gap-2 flex-1 min-w-[200px]">
            <label class="text-xs font-bold text-slate-600 uppercase tracking-wider">Status Verifikasi</label>
            <select name="status" class="px-4 py-2.5 bg-slate-50 rounded-lg text-sm font-medium text-slate-800 outline-none border border-slate-200 focus:ring-2 focus:ring-cyan-600">
                <option value="">Semua</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Belum Diverifikasi</option>
                <option value="diverifikasi" {{ request('status') == 'diverifikasi' ? 'selected' : '' }}>Sudah Diverifikasi</option>
                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </div>
        <button type="submit" class="bg-cyan-600 text-white text-sm font-medium px-6 py-2.5 rounded-2xl hover:bg-cyan-700 transition-colors">
            Terapkan
        </button>
        @if(request('status') || request('jenis_bantuan'))
            <a href="{{ route('admin.validasi.index') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900 px-4 py-2.5">
                Reset
            </a>
        @endif
    </form>

    @if(session('success'))
        <div class="rounded-3xl bg-emerald-50 text-emerald-600 text-sm p-4 border border-emerald-100">
            {{ session('success') }}
        </div>
    @endif

    {{-- List Items --}}
    <div class="space-y-4">
        @forelse($pengajuan as $item)
            <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200 flex items-center justify-between overflow-hidden hover:shadow-md transition-shadow">

                {{-- Status Indicator Bar --}}
                @if($item->status_pengajuan == 'pending')
                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-amber-400"></div>
                @elseif($item->status_pengajuan == 'diverifikasi')
                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-emerald-400"></div>
                @elseif($item->status_pengajuan == 'ditolak')
                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-red-400"></div>
                @endif

                {{-- Content --}}
                <div class="flex items-center gap-6 pl-4 flex-1">
                    <div class="w-12 h-12 rounded-2xl bg-cyan-100 flex items-center justify-center text-sm font-bold text-cyan-700 flex-shrink-0">
                        {{ strtoupper(substr($item->user->name ?? 'U', 0, 2)) }}
                    </div>
                    <div class="min-w-0">
                        <p class="font-semibold text-slate-900">{{ $item->user->name ?? '-' }}</p>
                        <p class="text-xs text-slate-500 uppercase tracking-wider">{{ $item->jenis_bantuan }} • {{ $item->tanggal_pengajuan }}</p>
                    </div>
                </div>

                {{-- Status & Action --}}
                <div class="flex items-center gap-4">
                    @if($item->status_pengajuan == 'pending')
                        <span class="bg-amber-100 text-amber-700 text-xs font-bold px-3 py-1.5 rounded-full">Pending</span>
                    @elseif($item->status_pengajuan == 'diverifikasi')
                        <span class="bg-emerald-100 text-emerald-700 text-xs font-bold px-3 py-1.5 rounded-full">Diverifikasi</span>
                    @elseif($item->status_pengajuan == 'ditolak')
                        <span class="bg-red-100 text-red-700 text-xs font-bold px-3 py-1.5 rounded-full">Ditolak</span>
                    @endif

                    <a href="{{ route('admin.validasi.show', $item->id_pengajuan) }}" class="bg-cyan-600 text-white text-sm font-medium px-6 py-2.5 rounded-2xl hover:bg-cyan-700 transition-colors">
                        Periksa
                    </a>
                </div>
            </div>
        @empty
            <div class="rounded-3xl bg-white p-12 shadow-sm border border-slate-200 text-center">
                <p class="text-slate-500 text-sm">Belum ada pengajuan masuk.</p>
            </div>
        @endforelse
    </div>

    <div class="flex items-center justify-between border-t border-slate-200 pt-6">
        <p class="text-sm text-slate-600">
            Menampilkan <span class="font-semibold text-slate-900">{{ $pengajuan->count() }}</span> pengajuan
        </p>
    </div>

</div>

{{-- Export Modal --}}
<div id="exportModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" onclick="closeExportModal()"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-md bg-white rounded-3xl shadow-xl overflow-hidden">
        <div class="p-6 border-b border-slate-200 flex justify-between items-center bg-slate-50">
            <div>
                <h3 class="font-semibold text-slate-900 text-lg">Export Data Pengajuan</h3>
                <p class="text-xs text-slate-500 mt-0.5">Pilih periode tanggal untuk diekspor ke CSV</p>
            </div>
            <button onclick="closeExportModal()" class="text-slate-400 hover:text-slate-600 p-2 rounded-xl hover:bg-slate-200 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <form action="{{ route('admin.validasi.export') }}" method="GET" class="p-6 space-y-4">
            <div class="space-y-3">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Dari Tanggal</label>
                    <input type="date" name="start_date" required class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-cyan-600 focus:border-cyan-600 outline-none transition-all">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Sampai Tanggal</label>
                    <input type="date" name="end_date" required class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-cyan-600 focus:border-cyan-600 outline-none transition-all">
                </div>
            </div>

            <div class="pt-4 flex gap-3 border-t border-slate-200">
                <button type="button" onclick="closeExportModal()" class="flex-1 px-4 py-2.5 border border-slate-200 text-slate-600 rounded-xl text-sm font-medium hover:bg-slate-50 transition-colors">Batal</button>
                <button type="submit" class="flex-1 px-4 py-2.5 bg-cyan-600 text-white rounded-xl text-sm font-medium hover:bg-cyan-700 transition-colors">Export CSV</button>
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

@endsection
