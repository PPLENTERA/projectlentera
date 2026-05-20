<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Bantuan - LENTERA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F3F4F6] min-h-screen font-['Inter']">

    {{-- NAVBAR --}}
    <nav class="bg-white shadow-sm px-8 py-4 flex items-center justify-between">
        <div class="text-xl font-extrabold text-[#1C2C4E]">LENTERA</div>
        <div class="flex gap-6 text-sm font-medium text-slate-600">
            <a href="#" class="hover:text-[#1C2C4E]">Home</a>
            <a href="#" class="hover:text-[#1C2C4E]">Dashboard</a>
            <a href="#" class="font-bold text-[#1C2C4E] border-b-2 border-[#1C2C4E]">Bantuan</a>
            <a href="#" class="hover:text-[#1C2C4E]">Pelaporan</a>
        </div>
        <div class="flex items-center gap-3">
            <div class="text-right">
                <p class="text-sm font-bold text-slate-800">{{ Auth::user()->name }}</p>
                <p class="text-xs text-slate-400">ID: {{ Auth::user()->id }}</p>
            </div>
            <div class="w-9 h-9 rounded-full bg-[#1C2C4E] flex items-center justify-center text-white text-sm font-bold">
                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
            </div>
        </div>
    </nav>

    <div class="max-w-3xl mx-auto py-10 px-4">

        {{-- HEADER --}}
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-[#1C2C4E]">Pengajuan Bantuan</h1>
            <p class="text-sm text-slate-500 mt-2">
                Silakan lengkapi formulir di bawah ini dengan data yang sebenar-benarnya<br>
                untuk mempercepat proses verifikasi tim LENTERA.
            </p>
        </div>

        {{-- ALERT ERROR --}}
        @if($errors->any())
            <div class="bg-red-50 text-red-600 text-sm p-4 rounded-xl border border-red-100 mb-6">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- FORM --}}
        <form action="{{ route('masyarakat.pengajuan.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white rounded-2xl shadow p-8 space-y-6">
            @csrf

            {{-- Nama Lengkap & NIK --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[0.7rem] font-bold text-slate-600 uppercase tracking-widest mb-2">
                        Nama Lengkap
                    </label>
                    <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required
                        class="w-full px-4 py-3.5 bg-[#F0F2F5] rounded-xl text-sm font-medium text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-[#1C2C4E] focus:bg-white transition-all outline-none"
                        placeholder="Sesuai KTP">
                </div>
                <div>
                    <label class="block text-[0.7rem] font-bold text-slate-600 uppercase tracking-widest mb-2">
                        NIK (Nomor Induk Kependudukan)
                    </label>
                    <input type="text" name="nik" value="{{ old('nik') }}" required maxlength="16"
                        class="w-full px-4 py-3.5 bg-[#F0F2F5] rounded-xl text-sm font-medium text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-[#1C2C4E] focus:bg-white transition-all outline-none"
                        placeholder="16 Digit Nomor KTP">
                </div>
            </div>

            {{-- Jenis Bantuan --}}
            <div>
                <label class="block text-[0.7rem] font-bold text-slate-600 uppercase tracking-widest mb-2">
                    Jenis Bantuan
                </label>
                <select name="jenis_bantuan" required
                    class="w-full px-4 py-3.5 bg-[#F0F2F5] rounded-xl text-sm font-medium text-slate-800 focus:ring-2 focus:ring-[#1C2C4E] focus:bg-white transition-all outline-none">
                    <option value="" disabled selected>Pilih kategori bantuan</option>
                    <option value="Bantuan Pangan" {{ old('jenis_bantuan') == 'Bantuan Pangan' ? 'selected' : '' }}>Bantuan Pangan</option>
                    <option value="Bantuan Kesehatan" {{ old('jenis_bantuan') == 'Bantuan Kesehatan' ? 'selected' : '' }}>Bantuan Kesehatan</option>
                    <option value="Bantuan Pendidikan" {{ old('jenis_bantuan') == 'Bantuan Pendidikan' ? 'selected' : '' }}>Bantuan Pendidikan</option>
                    <option value="Bantuan Perumahan" {{ old('jenis_bantuan') == 'Bantuan Perumahan' ? 'selected' : '' }}>Bantuan Perumahan</option>
                </select>
            </div>

            {{-- Deskripsi Kebutuhan --}}
            <div>
                <label class="block text-[0.7rem] font-bold text-slate-600 uppercase tracking-widest mb-2">
                    Deskripsi Kebutuhan
                </label>
                <textarea name="deskripsi_kebutuhan" rows="4"
                    class="w-full px-4 py-3.5 bg-[#F0F2F5] rounded-xl text-sm font-medium text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-[#1C2C4E] focus:bg-white transition-all outline-none resize-none"
                    placeholder="Ceritakan kondisi Anda dan alasan mengajukan bantuan ini...">{{ old('deskripsi_kebutuhan') }}</textarea>
            </div>

            {{-- Upload Bukti Pendukung (Opsional) --}}
            <div>
                <label class="block text-[0.7rem] font-bold text-slate-600 uppercase tracking-widest mb-2">
                    Unggah Bukti Pendukung <span class="text-slate-400 normal-case font-normal">(Opsional)</span>
                </label>
                <div class="border-2 border-dashed border-slate-200 rounded-xl p-6 text-center bg-[#F8F9FA]">
                    <svg class="w-8 h-8 text-slate-400 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                    <p class="text-xs text-slate-400 mb-3">Klik atau seret file foto/PDF bukti kondisi (Max. 5MB)</p>
                    <input type="file" name="bukti_pendukung" accept=".pdf,.jpg,.jpeg,.png"
                        class="text-sm text-slate-500 file:mr-4 file:py-1.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#1C2C4E] file:text-white hover:file:bg-[#111A31]">
                </div>
            </div>

            {{-- Tombol --}}
            <div class="flex gap-3 pt-2 border-t border-slate-100">
                <a href="{{ route('masyarakat.pengajuan.index') }}"
                    class="flex-1 flex items-center justify-center gap-2 py-3.5 rounded-xl text-sm font-bold text-slate-600 bg-[#F0F2F5] hover:bg-slate-200 transition-all">
                    ← Sebelumnya
                </a>
                <button type="submit"
                    class="flex-1 flex justify-center items-center gap-2 py-3.5 rounded-xl text-sm font-bold text-white bg-gradient-to-r from-[#172545] to-[#1F335C] shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all">
                    Selanjutnya →
                </button>
            </div>

        </form>

        {{-- BANTUAN BOX --}}
        <div class="mt-6 bg-yellow-50 border border-yellow-100 rounded-2xl p-5 flex gap-4">
            <div class="text-yellow-400 mt-1">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-bold text-slate-700 mb-1">Butuh Bantuan Mengisi?</p>
                <p class="text-xs text-slate-500 leading-relaxed">
                    Jika Anda kesulitan mengisi formulir ini, silakan hubungi relawan LENTERA terdekat atau kunjungi pusat bantuan masyarakat di kecamatan Anda.
                </p>
                <a href="#" class="text-xs font-bold text-[#1F54CE] mt-2 inline-block hover:underline">Lihat Lokasi Relawan</a>
            </div>
        </div>

    </div>

    {{-- FOOTER --}}
    <footer class="bg-[#1C2C4E] text-white mt-16 py-10 px-8">
        <div class="max-w-5xl mx-auto grid grid-cols-3 gap-8">
            <div>
                <p class="text-lg font-extrabold mb-3">LENTERA</p>
                <p class="text-xs text-[#8A99BA] leading-relaxed">
                    Menyinari jalan menuju keadilan sosial. Platform transparansi bantuan rakyat yang akuntabel dan berintegritas.
                </p>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-widest mb-3">Navigasi Cepat</p>
                <ul class="space-y-2 text-xs text-[#8A99BA]">
                    <li><a href="#" class="hover:text-white">Tentang Kami</a></li>
                    <li><a href="#" class="hover:text-white">Kebijakan Privasi</a></li>
                    <li><a href="#" class="hover:text-white">Syarat & Ketentuan</a></li>
                    <li><a href="#" class="hover:text-white">Kontak</a></li>
                </ul>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-widest mb-3">Kontak Kami</p>
                <div class="space-y-2 text-xs text-[#8A99BA]">
                    <p>info@lentera.go.id</p>
                    <p>1500-LENTERA</p>
                </div>
            </div>
        </div>
        <div class="border-t border-[#2E4A7A] mt-8"></div>
    </footer>

</body>
</html>