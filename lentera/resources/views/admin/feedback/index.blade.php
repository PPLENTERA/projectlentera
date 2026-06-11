@extends('layouts.admin')

@section('title', 'Manajemen Feedback')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-[#1C2C4E]">Manajemen Feedback</h1>
        <p class="text-sm text-slate-500 mt-1">Pantau dan tindaklanjuti feedback, masukan, serta keluhan dari masyarakat.</p>
    </div>

    {{-- Statistics Cards --}}
    <section class="grid gap-6 grid-cols-1 md:grid-cols-4">
        <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-200">
            <p class="text-xs text-slate-500 font-bold uppercase tracking-wider mb-1">Total Feedback</p>
            <p class="text-3xl font-extrabold text-slate-900">{{ $stats['total'] }}</p>
        </article>
        <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-200">
            <p class="text-xs text-slate-500 font-bold uppercase tracking-wider mb-1">Belum Ditinjau</p>
            <p class="text-3xl font-extrabold text-amber-600">{{ $stats['belum_ditinjau'] }}</p>
        </article>
        <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-200">
            <p class="text-xs text-slate-500 font-bold uppercase tracking-wider mb-1">Sedang Ditinjau</p>
            <p class="text-3xl font-extrabold text-blue-600">{{ $stats['sedang_ditinjau'] }}</p>
        </article>
        <article class="rounded-2xl bg-white p-6 shadow-sm border border-slate-200">
            <p class="text-xs text-slate-500 font-bold uppercase tracking-wider mb-1">Ditindaklanjuti</p>
            <p class="text-3xl font-extrabold text-emerald-600">{{ $stats['sudah_ditindaklanjuti'] }}</p>
        </article>
    </section>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="rounded-2xl bg-emerald-50 text-emerald-600 text-sm p-4 border border-emerald-100 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- Filters --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
        <form method="GET" action="{{ route('admin.feedback.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            <div class="flex flex-col gap-2">
                <label class="text-xs font-bold text-slate-600 uppercase tracking-wider">Cari Nama/Telepon</label>
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Cari..." class="px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-800 outline-none focus:ring-2 focus:ring-cyan-600">
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-xs font-bold text-slate-600 uppercase tracking-wider">Status</label>
                <select name="status" class="px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-800 outline-none focus:ring-2 focus:ring-cyan-600">
                    <option value="">Semua Status</option>
                    <option value="belum_ditinjau" {{ request('status') === 'belum_ditinjau' ? 'selected' : '' }}>Belum Ditinjau</option>
                    <option value="sedang_ditinjau" {{ request('status') === 'sedang_ditinjau' ? 'selected' : '' }}>Sedang Ditinjau</option>
                    <option value="sudah_ditindaklanjuti" {{ request('status') === 'sudah_ditindaklanjuti' ? 'selected' : '' }}>Sudah Ditindaklanjuti</option>
                </select>
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-xs font-bold text-slate-600 uppercase tracking-wider">Kategori</label>
                <select name="kategori" class="px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-800 outline-none focus:ring-2 focus:ring-cyan-600">
                    <option value="">Semua Kategori</option>
                    <option value="Saran" {{ request('kategori') === 'Saran' ? 'selected' : '' }}>Saran</option>
                    <option value="Laporan" {{ request('kategori') === 'Laporan' ? 'selected' : '' }}>Laporan</option>
                    <option value="Keluhan" {{ request('kategori') === 'Keluhan' ? 'selected' : '' }}>Keluhan</option>
                    <option value="Pertanyaan" {{ request('kategori') === 'Pertanyaan' ? 'selected' : '' }}>Pertanyaan</option>
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="flex-1 px-4 py-3 bg-[#1C2C4E] hover:bg-[#111A31] text-white rounded-xl text-xs font-bold transition-colors">
                    Filter
                </button>
                <a href="{{ route('admin.feedback.index') }}" class="flex-1 px-4 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-xs font-bold text-center transition-colors">
                    Reset
                </a>
            </div>
        </form>
    </div>

    {{-- Feedback Table --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-slate-500">
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Telepon</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($feedbacks as $feedback)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4 font-semibold text-slate-800">{{ $feedback->nama_lengkap }}</td>
                            <td class="px-6 py-4 font-medium text-slate-600">{{ $feedback->nomor_telepon }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-block px-3 py-1 bg-blue-50 text-blue-700 border border-blue-100 rounded-full text-xs font-medium">
                                    {{ $feedback->kategori_masukan }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($feedback->status === 'belum_ditinjau')
                                    <span class="inline-block px-3 py-1 bg-yellow-50 text-yellow-700 border border-yellow-100 rounded-full text-xs font-medium">
                                        Belum Ditinjau
                                    </span>
                                @elseif($feedback->status === 'sedang_ditinjau')
                                    <span class="inline-block px-3 py-1 bg-blue-50 text-blue-700 border border-blue-100 rounded-full text-xs font-medium">
                                        Sedang Ditinjau
                                    </span>
                                @else
                                    <span class="inline-block px-3 py-1 bg-green-50 text-green-700 border border-green-100 rounded-full text-xs font-medium">
                                        Sudah Ditindaklanjuti
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-slate-500">
                                {{ $feedback->created_at->format('d M Y H:i') }}
                            </td>
                            <td class="px-6 py-4 text-right flex justify-end gap-2">
                                <a href="{{ route('admin.feedback.edit', $feedback) }}" class="inline-block text-xs font-bold text-white bg-[#1C2C4E] px-4 py-2 rounded-xl hover:bg-[#111A31] transition-colors">
                                    Lihat
                                </a>
                                <form method="POST" action="{{ route('admin.feedback.destroy', $feedback) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-block text-xs font-bold text-red-600 bg-red-50 hover:bg-red-100 px-4 py-2 rounded-xl transition-colors" onclick="return confirm('Yakin ingin menghapus feedback ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-400 text-sm">
                                Tidak ada feedback ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $feedbacks->links() }}
    </div>

</div>

@endsection
