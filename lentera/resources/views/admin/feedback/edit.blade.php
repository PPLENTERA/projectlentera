@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 p-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('admin.feedback.index') }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm mb-4 inline-block">
                ← Kembali ke Daftar Feedback
            </a>
            <h1 class="text-3xl font-bold text-gray-900">Detail Feedback</h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Informasi Pengguna</h2>
                    
                    <div class="grid grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">Nama Lengkap</label>
                            <p class="text-gray-900 font-medium">{{ $feedback->nama_lengkap }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">Nomor Telepon</label>
                            <p class="text-gray-900 font-medium">{{ $feedback->nomor_telepon }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">Kategori Masukan</label>
                            <p class="inline-block px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                                {{ $feedback->kategori_masukan }}
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">Tanggal Masukan</label>
                            <p class="text-gray-900 font-medium">{{ $feedback->created_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Feedback Content -->
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Deskripsi Masukan</h2>
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <p class="text-gray-900 whitespace-pre-wrap">{{ $feedback->deskripsi_masukan }}</p>
                    </div>
                </div>

                <!-- Update Form -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Update Status & Catatan Admin</h2>
                    
                    <form method="POST" action="{{ route('admin.feedback.update', $feedback) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select name="status" id="status" class="w-full px-4 py-2 border {{ $errors->has('status') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="belum_ditinjau" {{ $feedback->status === 'belum_ditinjau' ? 'selected' : '' }}>
                                    Belum Ditinjau
                                </option>
                                <option value="sedang_ditinjau" {{ $feedback->status === 'sedang_ditinjau' ? 'selected' : '' }}>
                                    Sedang Ditinjau
                                </option>
                                <option value="sudah_ditindaklanjuti" {{ $feedback->status === 'sudah_ditindaklanjuti' ? 'selected' : '' }}>
                                    Sudah Ditindaklanjuti
                                </option>
                            </select>
                            @error('status')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="catatan_admin" class="block text-sm font-medium text-gray-700 mb-2">Catatan Admin</label>
                            <textarea name="catatan_admin" id="catatan_admin" rows="6" 
                                      placeholder="Masukkan catatan atau tindaklanjut yang telah dilakukan..."
                                      class="w-full px-4 py-2 border {{ $errors->has('catatan_admin') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('catatan_admin', $feedback->catatan_admin) }}</textarea>
                            @error('catatan_admin')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex gap-4">
                            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">
                                Simpan Perubahan
                            </button>
                            <a href="{{ route('admin.feedback.index') }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-medium">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow p-6 sticky top-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Status Saat Ini</h3>
                    
                    <div class="mb-6">
                        @if($feedback->status === 'belum_ditinjau')
                            <span class="inline-block px-3 py-2 bg-yellow-100 text-yellow-800 rounded-lg text-sm font-medium">
                                ⚠️ Belum Ditinjau
                            </span>
                        @elseif($feedback->status === 'sedang_ditinjau')
                            <span class="inline-block px-3 py-2 bg-blue-100 text-blue-800 rounded-lg text-sm font-medium">
                                🔄 Sedang Ditinjau
                            </span>
                        @else
                            <span class="inline-block px-3 py-2 bg-green-100 text-green-800 rounded-lg text-sm font-medium">
                                ✓ Sudah Ditindaklanjuti
                            </span>
                        @endif
                    </div>

                    @if($feedback->catatan_admin)
                        <div class="mb-6">
                            <h4 class="font-medium text-gray-700 mb-2">Catatan Terakhir</h4>
                            <p class="text-sm text-gray-600 whitespace-pre-wrap">{{ $feedback->catatan_admin }}</p>
                        </div>
                    @endif

                    <div class="pt-4 border-t border-gray-200">
                        <p class="text-xs text-gray-500">
                            <strong>Dibuat:</strong> {{ $feedback->created_at->format('d M Y H:i') }}
                        </p>
                        <p class="text-xs text-gray-500 mt-2">
                            <strong>Diperbarui:</strong> {{ $feedback->updated_at->format('d M Y H:i') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
