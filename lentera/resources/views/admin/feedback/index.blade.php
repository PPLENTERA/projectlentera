@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 p-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Manajemen Feedback</h1>
            <p class="text-gray-600 mt-2">Pantau dan tindaklanjuti feedback dari pengguna</p>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="text-gray-500 text-sm font-medium">Total Feedback</div>
                <div class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total'] }}</div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="text-yellow-600 text-sm font-medium">Belum Ditinjau</div>
                <div class="text-3xl font-bold text-yellow-600 mt-2">{{ $stats['belum_ditinjau'] }}</div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="text-blue-600 text-sm font-medium">Sedang Ditinjau</div>
                <div class="text-3xl font-bold text-blue-600 mt-2">{{ $stats['sedang_ditinjau'] }}</div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="text-green-600 text-sm font-medium">Sudah Ditindaklanjuti</div>
                <div class="text-3xl font-bold text-green-600 mt-2">{{ $stats['sudah_ditindaklanjuti'] }}</div>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-800">
                {{ session('success') }}
            </div>
        @endif

        <!-- Filters -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <form method="GET" action="{{ route('admin.feedback.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Cari Nama/Telepon</label>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Cari..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Status</option>
                        <option value="belum_ditinjau" {{ request('status') === 'belum_ditinjau' ? 'selected' : '' }}>Belum Ditinjau</option>
                        <option value="sedang_ditinjau" {{ request('status') === 'sedang_ditinjau' ? 'selected' : '' }}>Sedang Ditinjau</option>
                        <option value="sudah_ditindaklanjuti" {{ request('status') === 'sudah_ditindaklanjuti' ? 'selected' : '' }}>Sudah Ditindaklanjuti</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                    <select name="kategori" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Kategori</option>
                        <option value="Saran" {{ request('kategori') === 'Saran' ? 'selected' : '' }}>Saran</option>
                        <option value="Laporan" {{ request('kategori') === 'Laporan' ? 'selected' : '' }}>Laporan</option>
                        <option value="Keluhan" {{ request('kategori') === 'Keluhan' ? 'selected' : '' }}>Keluhan</option>
                        <option value="Pertanyaan" {{ request('kategori') === 'Pertanyaan' ? 'selected' : '' }}>Pertanyaan</option>
                    </select>
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">
                        Terapkan Filter
                    </button>
                    <a href="{{ route('admin.feedback.index') }}" class="flex-1 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-medium text-center">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Feedback Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-100 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Nama</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Telepon</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Kategori</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Status</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Tanggal</th>
                        <th class="px-6 py-4 text-center text-sm font-medium text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($feedbacks as $feedback)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $feedback->nama_lengkap }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $feedback->nomor_telepon }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                <span class="inline-block px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-medium">
                                    {{ $feedback->kategori_masukan }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm">
                                @if($feedback->status === 'belum_ditinjau')
                                    <span class="inline-block px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-medium">
                                        Belum Ditinjau
                                    </span>
                                @elseif($feedback->status === 'sedang_ditinjau')
                                    <span class="inline-block px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-medium">
                                        Sedang Ditinjau
                                    </span>
                                @else
                                    <span class="inline-block px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">
                                        Sudah Ditindaklanjuti
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $feedback->created_at->format('d M Y H:i') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('admin.feedback.edit', $feedback) }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm mr-4">
                                    Lihat
                                </a>
                                <form method="POST" action="{{ route('admin.feedback.destroy', $feedback) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-sm" onclick="return confirm('Yakin ingin menghapus?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                Tidak ada feedback ditemukan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $feedbacks->links() }}
        </div>
    </div>
</div>
@endsection
