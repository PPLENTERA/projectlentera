@extends('layouts.admin')

@section('title', 'Detail Pengajuan')

@section('content')

<div class="space-y-6">

    {{-- Back & Title --}}
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.validasi.index') }}"
            class="w-10 h-10 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-600 hover:bg-slate-200 transition-colors">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-[#1C2C4E]">Detail Pengajuan</h1>
            <p class="text-sm text-slate-500 mt-1">Periksa data dan dokumen sebelum melakukan validasi bantuan.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Left: Data Pemohon & Dokumen (col-span-2) --}}
        <div class="lg:col-span-2 space-y-6">
            
            {{-- Data Pemohon --}}
            <div class="rounded-2xl bg-white p-6 shadow-sm border border-slate-200">
                <h2 class="text-sm font-bold text-slate-600 uppercase tracking-wider mb-6">Data Pemohon</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                    <div>
                        <p class="text-xs text-slate-400 uppercase font-semibold tracking-wider mb-1">Nama Lengkap</p>
                        <p class="font-semibold text-slate-955">{{ $pengajuan->user->name ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 uppercase font-semibold tracking-wider mb-1">Alamat Email</p>
                        <p class="font-semibold text-slate-955">{{ $pengajuan->user->email ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 uppercase font-semibold tracking-wider mb-1">Nomor Induk Kependudukan (NIK)</p>
                        <p class="font-semibold text-slate-955">{{ $pengajuan->nik ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 uppercase font-semibold tracking-wider mb-1">Jenis Bantuan</p>
                        <p class="font-semibold text-slate-955">{{ $pengajuan->jenis_bantuan }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 uppercase font-semibold tracking-wider mb-1">Penghasilan Bulanan</p>
                        <p class="font-semibold text-slate-955">Rp {{ number_format($pengajuan->penghasilan, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 uppercase font-semibold tracking-wider mb-1">Jumlah Tanggungan</p>
                        <p class="font-semibold text-slate-955">{{ $pengajuan->jumlah_tanggungan }} Orang</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 uppercase font-semibold tracking-wider mb-1">Tanggal Pengajuan</p>
                        <p class="font-semibold text-slate-955">{{ $pengajuan->tanggal_pengajuan }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 uppercase font-semibold tracking-wider mb-1">Status Pengajuan</p>
                        <div>
                            @if($pengajuan->status_pengajuan == 'pending')
                                <span class="bg-amber-100 text-amber-700 text-xs font-bold px-3 py-1 rounded-full">Pending</span>
                            @elseif($pengajuan->status_pengajuan == 'diverifikasi')
                                <span class="bg-emerald-100 text-emerald-700 text-xs font-bold px-3 py-1 rounded-full">Diverifikasi</span>
                            @elseif($pengajuan->status_pengajuan == 'ditolak')
                                <span class="bg-red-100 text-red-700 text-xs font-bold px-3 py-1 rounded-full">Ditolak</span>
                            @else
                                <span class="bg-slate-100 text-slate-700 text-xs font-bold px-3 py-1 rounded-full uppercase">{{ $pengajuan->status_pengajuan }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-span-1 md:col-span-2">
                        <p class="text-xs text-slate-400 uppercase font-semibold tracking-wider mb-1">Deskripsi Kebutuhan</p>
                        <p class="font-medium text-slate-700 leading-relaxed">{{ $pengajuan->deskripsi_kebutuhan ?? 'Tidak ada deskripsi kebutuhan yang dilampirkan.' }}</p>
                    </div>
                </div>
            </div>

            {{-- Dokumen Pendukung --}}
            <div class="rounded-2xl bg-white p-6 shadow-sm border border-slate-200">
                <h2 class="text-sm font-bold text-slate-600 uppercase tracking-wider mb-6">Dokumen Pendukung</h2>
                @if($pengajuan->dokumen && $pengajuan->dokumen->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($pengajuan->dokumen as $dok)
                            <div class="flex items-center justify-between bg-slate-50 rounded-xl p-4 border border-slate-100">
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <span class="text-sm font-semibold text-slate-700 uppercase">{{ $dok->jenis_dokumen }}</span>
                                </div>
                                <a href="{{ asset('storage/' . $dok->file_path) }}" target="_blank"
                                    class="text-xs font-bold text-cyan-600 hover:text-cyan-700">
                                    Buka File &rarr;
                                </a>
                            </div>
                        @endforeach
                    </div>
                @elseif($pengajuan->bukti_pendukung)
                    <div class="flex items-center justify-between bg-slate-50 rounded-xl p-4 border border-slate-100">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span class="text-sm font-semibold text-slate-700">Bukti Pendukung</span>
                        </div>
                        <a href="{{ asset('storage/' . $pengajuan->bukti_pendukung) }}" target="_blank"
                            class="text-xs font-bold text-cyan-600 hover:text-cyan-700">
                            Buka File &rarr;
                        </a>
                    </div>
                @else
                    <div class="text-center py-6">
                        <p class="text-sm text-slate-400 font-medium">Tidak ada berkas/dokumen pendukung yang diunggah.</p>
                    </div>
                @endif
            </div>

        </div>

        {{-- Right: Form Validasi & Riwayat --}}
        <div class="space-y-6">

            {{-- Form Validasi --}}
            <div class="rounded-2xl bg-white p-6 shadow-sm border border-slate-200">
                <h2 class="text-sm font-bold text-slate-600 uppercase tracking-wider mb-6">Hasil Validasi</h2>

                <form action="{{ route('admin.validasi.update', $pengajuan->id_pengajuan) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">
                            Status Validasi
                        </label>
                        <select name="status_validasi" required
                            class="w-full px-4 py-3 bg-slate-50 rounded-xl text-sm font-medium text-slate-800 border border-slate-200 focus:ring-2 focus:ring-cyan-600 focus:border-cyan-600 outline-none transition-all">
                            <option value="" disabled selected>Pilih status</option>
                            <option value="valid">Valid (Setujui Berkas)</option>
                            <option value="tidak_valid">Tidak Valid (Tolak)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">
                            Catatan Verifikasi
                        </label>
                        <textarea name="catatan" rows="4"
                            class="w-full px-4 py-3 bg-slate-50 rounded-xl text-sm font-medium text-slate-800 placeholder-slate-400 border border-slate-200 focus:ring-2 focus:ring-cyan-600 focus:border-cyan-600 outline-none transition-all resize-none"
                            placeholder="Tambahkan catatan/alasan penolakan jika berkas tidak valid..."></textarea>
                    </div>

                    <div class="border-t border-slate-100 pt-4">
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-3">Jadwal Pengambilan (Opsional)</p>
                        
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-[0.65rem] font-bold text-slate-500 uppercase tracking-wider mb-1">Tanggal</label>
                                <input type="date" name="tanggal_pengambilan" 
                                    class="w-full px-3 py-2 bg-slate-50 rounded-xl text-sm font-medium text-slate-800 border border-slate-200 focus:ring-2 focus:ring-cyan-600 focus:border-cyan-600 outline-none">
                            </div>
                            <div>
                                <label class="block text-[0.65rem] font-bold text-slate-500 uppercase tracking-wider mb-1">Waktu</label>
                                <input type="time" name="waktu_pengambilan" 
                                    class="w-full px-3 py-2 bg-slate-50 rounded-xl text-sm font-medium text-slate-800 border border-slate-200 focus:ring-2 focus:ring-cyan-600 focus:border-cyan-600 outline-none">
                            </div>
                        </div>

                        <div>
                            <label class="block text-[0.65rem] font-bold text-slate-500 uppercase tracking-wider mb-1">Lokasi Kantor</label>
                            <input type="text" name="lokasi_pengambilan" placeholder="misal: Kantor Kelurahan Lentera"
                                class="w-full px-3 py-2.5 bg-slate-50 rounded-xl text-sm font-medium text-slate-800 placeholder-slate-400 border border-slate-200 focus:ring-2 focus:ring-cyan-600 focus:border-cyan-600 outline-none">
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full py-3.5 rounded-xl text-sm font-bold text-white bg-cyan-600 hover:bg-cyan-700 transition-colors shadow-sm mt-4">
                        Simpan Validasi
                    </button>

                </form>
            </div>

            {{-- Riwayat Validasi --}}
            @if($pengajuan->validasi)
                <div class="rounded-2xl bg-white p-6 shadow-sm border border-slate-200">
                    <h2 class="text-sm font-bold text-slate-600 uppercase tracking-wider mb-4">Riwayat Validasi</h2>
                    <div class="space-y-3 text-sm">
                        <div>
                            <p class="text-xs text-slate-400 font-semibold uppercase tracking-wider mb-1">Status Terakhir</p>
                            <span class="inline-block text-xs font-bold px-3 py-1 rounded-full uppercase
                                {{ $pengajuan->validasi->status_validasi == 'valid' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $pengajuan->validasi->status_validasi == 'valid' ? 'VALID' : 'TIDAK VALID' }}
                            </span>
                        </div>
                        @if($pengajuan->validasi->catatan)
                            <div>
                                <p class="text-xs text-slate-400 font-semibold uppercase tracking-wider mb-1">Catatan</p>
                                <p class="text-slate-700 font-medium bg-slate-50 p-3 rounded-lg border border-slate-100">{{ $pengajuan->validasi->catatan }}</p>
                            </div>
                        @endif
                        <div>
                            <p class="text-xs text-slate-400 font-semibold uppercase tracking-wider mb-1">Tanggal Verifikasi</p>
                            <p class="text-slate-800 font-semibold">{{ $pengajuan->validasi->tanggal_verifikasi ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            @endif

        </div>

    </div>

</div>

@endsection