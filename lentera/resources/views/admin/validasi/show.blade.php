@extends('layouts.admin')

@section('title', 'Detail Pengajuan')

@section('content')

<div class="flex flex-col gap-8">

    <div class="flex items-center gap-4">
        <a href="{{ route('admin.validasi.index') }}"
            class="w-10 h-10 rounded-full bg-[#E7E8E9] flex items-center justify-center hover:bg-slate-200 transition-all">
            <svg class="w-5 h-5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
        <div>
            <h1 class="text-3xl font-extrabold text-[#022448] font-['Plus_Jakarta_Sans'] tracking-tight">
                Detail Pengajuan
            </h1>
            <p class="text-base text-slate-500 mt-1">Periksa data dan dokumen sebelum divalidasi.</p>
        </div>
    </div>

    <div class="grid grid-cols-3 gap-6">

        <div class="col-span-2 flex flex-col gap-6">

            <div class="bg-white rounded-3xl p-8">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-6">Data Pemohon</p>
                <div class="grid grid-cols-2 gap-6 text-sm">
                    <div>
                        <p class="text-xs text-slate-400 uppercase tracking-widest font-bold mb-1">Nama</p>
                        <p class="font-semibold text-[#022448]">{{ $pengajuan->user->name ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 uppercase tracking-widest font-bold mb-1">Email</p>
                        <p class="font-semibold text-[#022448]">{{ $pengajuan->user->email ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 uppercase tracking-widest font-bold mb-1">NIK</p>
                        <p class="font-semibold text-[#022448]">{{ $pengajuan->nik ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 uppercase tracking-widest font-bold mb-1">Jenis Bantuan</p>
                        <p class="font-semibold text-[#022448]">{{ $pengajuan->jenis_bantuan }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 uppercase tracking-widest font-bold mb-1">Tanggal Pengajuan</p>
                        <p class="font-semibold text-[#022448]">{{ $pengajuan->tanggal_pengajuan }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 uppercase tracking-widest font-bold mb-1">Status</p>
                        <span class="text-xs font-bold bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full uppercase">
                            {{ $pengajuan->status_pengajuan }}
                        </span>
                    </div>
                    <div class="col-span-2">
                        <p class="text-xs text-slate-400 uppercase tracking-widest font-bold mb-1">Deskripsi Kebutuhan</p>
                        <p class="font-semibold text-[#022448]">{{ $pengajuan->deskripsi_kebutuhan ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-8">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-6">Dokumen Pendukung</p>
                @if($pengajuan->dokumen && $pengajuan->dokumen->count() > 0)
                    <div class="space-y-3">
                        @foreach($pengajuan->dokumen as $dok)
                            <div class="flex items-center justify-between bg-[#F8F9FA] rounded-2xl px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-[#022448]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <span class="text-sm font-semibold text-slate-700 uppercase">{{ $dok->jenis_dokumen }}</span>
                                </div>
                                <a href="{{ asset('storage/' . $dok->file_path) }}" target="_blank"
                                    class="text-xs font-bold text-[#1F54CE] hover:underline">
                                    Lihat Dokumen
                                </a>
                            </div>
                        @endforeach
                    </div>
                @elseif($pengajuan->bukti_pendukung)
                    <div class="flex items-center justify-between bg-[#F8F9FA] rounded-2xl px-5 py-4">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-[#022448]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span class="text-sm font-semibold text-slate-700">Bukti Pendukung</span>
                        </div>
                        <a href="{{ asset('storage/' . $pengajuan->bukti_pendukung) }}" target="_blank"
                            class="text-xs font-bold text-[#1F54CE] hover:underline">
                            Lihat Dokumen
                        </a>
                    </div>
                @else
                    <p class="text-sm text-slate-400">Tidak ada dokumen yang diupload.</p>
                @endif
            </div>

        </div>

        <div class="flex flex-col gap-6">

            <div class="bg-white rounded-3xl p-8">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-6">Hasil Validasi</p>

                <form action="{{ route('admin.validasi.update', $pengajuan->id_pengajuan) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-[0.7rem] font-bold text-slate-600 uppercase tracking-widest mb-2">
                            Status Validasi
                        </label>
                        <select name="status_validasi" required
                            class="w-full px-4 py-3 bg-[#F0F2F5] rounded-xl text-sm font-medium text-slate-800 focus:ring-2 focus:ring-[#022448] focus:bg-white transition-all outline-none">
                            <option value="" disabled selected>Pilih status</option>
                            <option value="valid">Valid</option>
                            <option value="tidak_valid">Tidak Valid</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[0.7rem] font-bold text-slate-600 uppercase tracking-widest mb-2">
                            Catatan
                        </label>
                        <textarea name="catatan" rows="4"
                            class="w-full px-4 py-3 bg-[#F0F2F5] rounded-xl text-sm font-medium text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-[#022448] focus:bg-white transition-all outline-none resize-none"
                            placeholder="Tambahkan catatan..."></textarea>
                    </div>

                    <button type="submit"
                        class="w-full flex justify-center items-center py-3.5 rounded-2xl text-sm font-bold text-white bg-gradient-to-br from-[#022448] to-[#1E3A5F] shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all">
                        Simpan Validasi
                    </button>

                </form>
            </div>

            @if($pengajuan->validasi)
                <div class="bg-white rounded-3xl p-8">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Riwayat Validasi</p>
                    <div class="space-y-2 text-sm">
                        <div>
                            <p class="text-xs text-slate-400 font-bold uppercase tracking-widest mb-1">Status</p>
                            <span class="text-xs font-bold px-3 py-1 rounded-full uppercase
                                {{ $pengajuan->validasi->status_validasi == 'valid' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $pengajuan->validasi->status_validasi }}
                            </span>
                        </div>
                        @if($pengajuan->validasi->catatan)
                            <div>
                                <p class="text-xs text-slate-400 font-bold uppercase tracking-widest mb-1">Catatan</p>
                                <p class="text-slate-700">{{ $pengajuan->validasi->catatan }}</p>
                            </div>
                        @endif
                        <div>
                            <p class="text-xs text-slate-400 font-bold uppercase tracking-widest mb-1">Tanggal</p>
                            <p class="text-slate-700">{{ $pengajuan->validasi->tanggal_verifikasi ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            @endif

        </div>

    </div>

</div>

@endsection