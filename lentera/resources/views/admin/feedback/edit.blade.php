@extends('layouts.admin')

@section('title', 'Detail Feedback')

@section('content')

<div class="space-y-6">

    {{-- Back & Title --}}
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.feedback.index') }}"
            class="w-10 h-10 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-600 hover:bg-slate-200 transition-colors">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-[#1C2C4E]">Detail Feedback</h1>
            <p class="text-sm text-slate-500 mt-1">Tinjau deskripsi masukan dan perbarui status tindak lanjut admin.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Left: Informasi & Deskripsi (col-span-2) --}}
        <div class="lg:col-span-2 space-y-6">
            
            {{-- Informasi Pengirim --}}
            <div class="rounded-2xl bg-white p-6 shadow-sm border border-slate-200">
                <h2 class="text-sm font-bold text-slate-600 uppercase tracking-wider mb-6">Informasi Pengirim</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                    <div>
                        <p class="text-xs text-slate-400 uppercase font-semibold tracking-wider mb-1">Nama Lengkap</p>
                        <p class="font-semibold text-slate-900">{{ $feedback->nama_lengkap }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 uppercase font-semibold tracking-wider mb-1">Nomor Telepon</p>
                        <p class="font-semibold text-slate-900">{{ $feedback->nomor_telepon }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 uppercase font-semibold tracking-wider mb-1">Kategori Masukan</p>
                        <div>
                            <span class="inline-block px-3 py-1 bg-blue-50 text-blue-700 border border-blue-100 rounded-full text-xs font-semibold">
                                {{ $feedback->kategori_masukan }}
                            </span>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 uppercase font-semibold tracking-wider mb-1">Tanggal Dikirim</p>
                        <p class="font-semibold text-slate-800">{{ $feedback->created_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
            </div>

            {{-- Deskripsi Masukan --}}
            <div class="rounded-2xl bg-white p-6 shadow-sm border border-slate-200">
                <h2 class="text-sm font-bold text-slate-600 uppercase tracking-wider mb-4">Deskripsi Masukan</h2>
                <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                    <p class="text-slate-800 text-sm leading-relaxed whitespace-pre-wrap font-medium">{{ $feedback->deskripsi_masukan }}</p>
                </div>
            </div>

        </div>

        {{-- Right: Update Status Form & Info --}}
        <div class="space-y-6">

            {{-- Update Form --}}
            <div class="rounded-2xl bg-white p-6 shadow-sm border border-slate-200">
                <h2 class="text-sm font-bold text-slate-600 uppercase tracking-wider mb-6">Tindak Lanjut</h2>
                
                <form method="POST" action="{{ route('admin.feedback.update', $feedback) }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="status" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Status Peninjauan</label>
                        <select name="status" id="status" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-800 outline-none focus:ring-2 focus:ring-cyan-600 focus:border-cyan-600 transition-all">
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
                            <p class="text-red-600 text-xs mt-2 font-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="catatan_admin" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Catatan Admin</label>
                        <textarea name="catatan_admin" id="catatan_admin" rows="5" 
                                  placeholder="Masukkan catatan atau tindak lanjut yang dilakukan..."
                                  class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-cyan-600 focus:border-cyan-600 outline-none transition-all resize-none">{{ old('catatan_admin', $feedback->catatan_admin) }}</textarea>
                        @error('catatan_admin')
                            <p class="text-red-600 text-xs mt-2 font-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-3 pt-2">
                        <button type="submit" class="flex-1 py-3.5 rounded-xl text-xs font-bold text-white bg-cyan-600 hover:bg-cyan-700 transition-colors shadow-sm">
                            Simpan
                        </button>
                        <a href="{{ route('admin.feedback.index') }}" class="flex-1 py-3.5 rounded-xl text-xs font-bold text-center text-slate-700 bg-slate-100 hover:bg-slate-200 transition-colors">
                            Batal
                        </a>
                    </div>
                </form>
            </div>

            {{-- Info Status --}}
            <div class="rounded-2xl bg-white p-6 shadow-sm border border-slate-200">
                <h2 class="text-sm font-bold text-slate-600 uppercase tracking-wider mb-4">Metadata</h2>
                <div class="space-y-4 text-sm">
                    <div>
                        <p class="text-xs text-slate-400 font-semibold uppercase tracking-wider mb-1">Status Terakhir</p>
                        <div>
                            @if($feedback->status === 'belum_ditinjau')
                                <span class="inline-block px-3 py-1 bg-yellow-50 text-yellow-700 border border-yellow-100 rounded-full text-xs font-semibold">
                                    Belum Ditinjau
                                </span>
                            @elseif($feedback->status === 'sedang_ditinjau')
                                <span class="inline-block px-3 py-1 bg-blue-50 text-blue-700 border border-blue-100 rounded-full text-xs font-semibold">
                                    Sedang Ditinjau
                                </span>
                            @else
                                <span class="inline-block px-3 py-1 bg-green-50 text-green-700 border border-green-100 rounded-full text-xs font-semibold">
                                    Sudah Ditindaklanjuti
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="border-t border-slate-100 pt-3">
                        <p class="text-xs text-slate-400 font-semibold tracking-wider uppercase mb-1">Dibuat Pada</p>
                        <p class="font-semibold text-slate-800">{{ $feedback->created_at->format('d M Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 font-semibold tracking-wider uppercase mb-1">Terakhir Diperbarui</p>
                        <p class="font-semibold text-slate-800">{{ $feedback->updated_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

@endsection
