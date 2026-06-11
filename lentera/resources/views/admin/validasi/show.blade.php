<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Validasi - LENTERA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F3F4F6] min-h-screen p-6 font-['Inter']">

<<<<<<< Updated upstream
    <div class="max-w-3xl mx-auto">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-[#1C2C4E]">Detail Pengajuan</h1>
            <p class="text-sm text-slate-500 mt-1">Periksa data dan dokumen pengajuan sebelum divalidasi.</p>
=======
@section('title', 'Detail Pengajuan')

@section('content')

<div class="flex flex-col gap-8">

    <div class="flex items-center gap-4">
        <a href="{{ route('admin.validasi.index') }}"
            class="w-10 h-10 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-600 hover:bg-slate-200 transition-colors">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
        <div>
            <h1 class="text-3xl font-semibold text-slate-900">
                Detail Pengajuan
            </h1>
            <p class="text-sm text-slate-500 mt-1">Periksa data dan dokumen sebelum divalidasi.</p>
>>>>>>> Stashed changes
        </div>

<<<<<<< Updated upstream
        <div class="bg-white rounded-2xl shadow p-6 mb-4">
            <h2 class="text-sm font-bold text-slate-600 uppercase tracking-widest mb-4">Data Pemohon</h2>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-slate-400 text-xs font-semibold uppercase tracking-widest mb-1">Nama</p>
                    <p class="font-semibold text-slate-800">{{ $pengajuan->user->name }}</p>
                </div>
                <div>
                    <p class="text-slate-400 text-xs font-semibold uppercase tracking-widest mb-1">Email</p>
                    <p class="font-semibold text-slate-800">{{ $pengajuan->user->email }}</p>
                </div>
                <div>
                    <p class="text-slate-400 text-xs font-semibold uppercase tracking-widest mb-1">Jenis Bantuan</p>
                    <p class="font-semibold text-slate-800">{{ $pengajuan->jenis_bantuan }}</p>
                </div>
                <div>
                    <p class="text-slate-400 text-xs font-semibold uppercase tracking-widest mb-1">Penghasilan</p>
                    <p class="font-semibold text-slate-800">Rp {{ number_format($pengajuan->penghasilan, 0, ',', '.') }}</p>
                </div>
                <div>
                    <p class="text-slate-400 text-xs font-semibold uppercase tracking-widest mb-1">Jumlah Tanggungan</p>
                    <p class="font-semibold text-slate-800">{{ $pengajuan->jumlah_tanggungan }} orang</p>
                </div>
                <div>
                    <p class="text-slate-400 text-xs font-semibold uppercase tracking-widest mb-1">Tanggal Pengajuan</p>
                    <p class="font-semibold text-slate-800">{{ $pengajuan->tanggal_pengajuan }}</p>
                </div>
                <div class="col-span-2">
                    <p class="text-slate-400 text-xs font-semibold uppercase tracking-widest mb-1">Deskripsi Kebutuhan</p>
                    <p class="font-semibold text-slate-800">{{ $pengajuan->deskripsi_kebutuhan ?? '-' }}</p>
                </div>
            </div>
=======
    <div class="grid grid-cols-3 gap-6">

        <div class="col-span-2 flex flex-col gap-6">

            <div class="rounded-3xl bg-white p-8 shadow-sm border border-slate-200">
                <p class="text-xs text-slate-500 font-bold uppercase tracking-wider mb-6">Data Pemohon</p>
                <div class="grid grid-cols-2 gap-6 text-sm">
                    <div>
                        <p class="text-xs text-slate-400 uppercase tracking-widest font-bold mb-1">Nama</p>
                        <p class="font-semibold text-slate-900">{{ $pengajuan->user->name ?? '-' }}</p>
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

            <div class="rounded-3xl bg-white p-8 shadow-sm border border-slate-200">
                <p class="text-xs text-slate-500 font-bold uppercase tracking-wider mb-6">Dokumen Pendukung</p>
                @if($pengajuan->dokumen && $pengajuan->dokumen->count() > 0)
                    <div class="space-y-3">
                        @foreach($pengajuan->dokumen as $dok)
                            <div class="flex items-center justify-between bg-slate-50 rounded-2xl px-5 py-4">
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

>>>>>>> Stashed changes
        </div>

        <div class="bg-white rounded-2xl shadow p-6 mb-4">
            <h2 class="text-sm font-bold text-slate-600 uppercase tracking-widest mb-4">Dokumen Pendukung</h2>
            @if($pengajuan->dokumen->count() > 0)
                <div class="space-y-3">
                    @foreach($pengajuan->dokumen as $dokumen)
                        <div class="flex items-center justify-between bg-[#F0F2F5] rounded-xl px-4 py-3">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-[#1C2C4E]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span class="text-sm font-semibold text-slate-700 uppercase">{{ $dokumen->jenis_dokumen }}</span>
                            </div>
                            <a href="{{ asset('storage/' . $dokumen->file_path) }}" target="_blank"
                                class="text-xs font-bold text-[#1F54CE] hover:text-[#11389A]">
                                Lihat Dokumen
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-slate-400">Tidak ada dokumen yang diupload.</p>
            @endif
        </div>

<<<<<<< Updated upstream
        <div class="bg-white rounded-2xl shadow p-6">
            <h2 class="text-sm font-bold text-slate-600 uppercase tracking-widest mb-4">Hasil Validasi</h2>
            
            <form action="{{ route('admin.validasi.update', $pengajuan->id_pengajuan) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
=======
            <div class="rounded-3xl bg-white p-8 shadow-sm border border-slate-200">
                <p class="text-xs text-slate-500 font-bold uppercase tracking-wider mb-6">Hasil Validasi</p>
>>>>>>> Stashed changes

                <div>
                    <label class="block text-[0.7rem] font-bold text-slate-600 uppercase tracking-widest mb-2">
                        Status Validasi
                    </label>
                    <select name="status_validasi" required
                        class="w-full px-4 py-3.5 bg-[#F0F2F5] rounded-xl text-sm font-medium text-slate-800 focus:ring-2 focus:ring-[#1C2C4E] focus:bg-white transition-all outline-none">
                        <option value="" disabled selected>Pilih status</option>
                        <option value="valid">Valid</option>
                        <option value="tidak_valid">Tidak Valid</option>
                    </select>
                </div>

<<<<<<< Updated upstream
                <div>
                    <label class="block text-[0.7rem] font-bold text-slate-600 uppercase tracking-widest mb-2">
                        Catatan (Opsional)
                    </label>
                    <textarea name="catatan" rows="3"
                        class="w-full px-4 py-3.5 bg-[#F0F2F5] rounded-xl text-sm font-medium text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-[#1C2C4E] focus:bg-white transition-all outline-none resize-none"
                        placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                </div>

                <div class="flex gap-3 pt-2">
                    <a href="{{ route('admin.validasi.index') }}"
                        class="flex-1 text-center py-3.5 rounded-xl text-sm font-bold text-slate-600 bg-[#F0F2F5] hover:bg-slate-200 transition-all">
                        Kembali
                    </a>
                    <button type="submit"
                        class="flex-1 flex justify-center items-center py-3.5 rounded-xl text-sm font-bold text-white bg-linear-to-r from-[#172545] to-[#1F335C] shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all">
                        Simpan Validasi
                    </button>
=======
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">
                            Status Validasi
                        </label>
                        <select name="status_validasi" required
                            class="w-full px-4 py-3 bg-slate-50 rounded-xl text-sm font-medium text-slate-800 border border-slate-200 focus:ring-2 focus:ring-cyan-600 focus:border-cyan-600 outline-none transition-all">
                            <option value="" disabled selected>Pilih status</option>
                            <option value="valid">Valid</option>
                            <option value="tidak_valid">Tidak Valid</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">
                            Catatan
                        </label>
                        <textarea name="catatan" rows="4"
                            class="w-full px-4 py-3 bg-slate-50 rounded-xl text-sm font-medium text-slate-800 placeholder-slate-400 border border-slate-200 focus:ring-2 focus:ring-cyan-600 focus:border-cyan-600 outline-none transition-all resize-none"
                            placeholder="Tambahkan catatan..."></textarea>
                    </div>

                    <div class="border-t border-slate-100 pt-4 mt-4">
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-3">Jadwal Pengambilan (Opsional)</p>
                        
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-[0.65rem] font-bold text-slate-500 uppercase tracking-wider mb-1">Tanggal</label>
                                <input type="date" name="tanggal_pengambilan" 
                                    class="w-full px-3 py-2.5 bg-[#F0F2F5] rounded-xl text-sm font-medium text-slate-800 focus:ring-2 focus:ring-[#022448] focus:bg-white transition-all outline-none">
                            </div>
                            <div>
                                <label class="block text-[0.65rem] font-bold text-slate-500 uppercase tracking-wider mb-1">Waktu</label>
                                <input type="time" name="waktu_pengambilan" 
                                    class="w-full px-3 py-2.5 bg-[#F0F2F5] rounded-xl text-sm font-medium text-slate-800 focus:ring-2 focus:ring-[#022448] focus:bg-white transition-all outline-none">
                            </div>
                        </div>

                        <div>
                            <label class="block text-[0.65rem] font-bold text-slate-500 uppercase tracking-wider mb-1">Lokasi Pengambilan</label>
                            <input type="text" name="lokasi_pengambilan" placeholder="Kantor Pos terdekat"
                                class="w-full px-3 py-2.5 bg-[#F0F2F5] rounded-xl text-sm font-medium text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-[#022448] focus:bg-white transition-all outline-none">
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full flex justify-center items-center py-3.5 rounded-2xl text-sm font-medium text-white bg-cyan-600 hover:bg-cyan-700 transition-colors">
                        Simpan Validasi
                    </button>

                </form>
            </div>

            @if($pengajuan->validasi)
                <div class="rounded-3xl bg-white p-8 shadow-sm border border-slate-200">
                    <p class="text-xs text-slate-500 font-bold uppercase tracking-wider mb-4">Riwayat Validasi</p>
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
>>>>>>> Stashed changes
                </div>
            </form>
        </div>

    </div>

</body>
</html>