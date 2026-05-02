<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Dokumen - LENTERA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F3F4F6] min-h-screen p-6 font-['Inter']">

<div class="max-w-2xl mx-auto">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-[#1C2C4E]">Upload Dokumen</h1>
        <p class="text-sm text-slate-500 mt-1">Langkah 2 dari 2 - Upload dokumen persyaratan.</p>
    </div>

    <div class="flex items-center mb-8">
        <div class="flex items-center justify-center w-8 h-8 rounded-full bg-green-500 text-white text-sm font-bold">✓</div>
        <div class="flex-1 h-1 bg-[#1C2C4E] mx-2"></div>
        <div class="flex items-center justify-center w-8 h-8 rounded-full bg-[#1C2C4E] text-white text-sm font-bold">2</div>
    </div>

    <div class="bg-white rounded-2xl shadow p-5 mb-6">
        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">Ringkasan Pengajuan</p>
        <div class="grid grid-cols-2 gap-3 text-sm">
            <div>
                <p class="text-xs text-slate-400 font-semibold uppercase tracking-widest mb-1">Jenis Bantuan</p>
                <p class="font-semibold text-slate-800">{{ $pengajuan->jenis_bantuan }}</p>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-semibold uppercase tracking-widest mb-1">Penghasilan</p>
                <p class="font-semibold text-slate-800">Rp {{ number_format($pengajuan->penghasilan, 0, ',', '.') }}</p>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-semibold uppercase tracking-widest mb-1">Tanggungan</p>
                <p class="font-semibold text-slate-800">{{ $pengajuan->jumlah_tanggungan }} orang</p>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-semibold uppercase tracking-widest mb-1">Status</p>
                <span class="text-xs font-bold bg-yellow-50 text-yellow-600 px-2 py-1 rounded-full">Pending</span>
            </div>
        </div>
    </div>

    @if($errors->any())
        <div class="bg-red-50 text-red-600 text-sm p-4 rounded-xl border border-red-100 mb-6">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('masyarakat.pengajuan.upload.dokumen', $pengajuan->id_pengajuan) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl shadow p-8 space-y-5">
        @csrf

        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Dokumen Persyaratan</p>
        <p class="text-xs text-slate-400 -mt-3">Format: PDF, JPG, PNG. Maks 2MB per file.</p>

        <div>
            <label class="block text-[0.7rem] font-bold text-slate-600 uppercase tracking-widest mb-2">
                KTP <span class="text-red-400">*</span>
            </label>
            <input type="file" name="dokumen[ktp]" accept=".pdf,.jpg,.jpeg,.png" required
                class="w-full text-sm text-slate-500 bg-[#F0F2F5] rounded-xl px-4 py-3 file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#1C2C4E] file:text-white hover:file:bg-[#111A31]">
        </div>

        <div>
            <label class="block text-[0.7rem] font-bold text-slate-600 uppercase tracking-widest mb-2">
                Kartu Keluarga (KK) <span class="text-red-400">*</span>
            </label>
            <input type="file" name="dokumen[kk]" accept=".pdf,.jpg,.jpeg,.png" required
                class="w-full text-sm text-slate-500 bg-[#F0F2F5] rounded-xl px-4 py-3 file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#1C2C4E] file:text-white hover:file:bg-[#111A31]">
        </div>

        <div>
            <label class="block text-[0.7rem] font-bold text-slate-600 uppercase tracking-widest mb-2">
                SKTM (Surat Keterangan Tidak Mampu) <span class="text-red-400">*</span>
            </label>
            <input type="file" name="dokumen[sktm]" accept=".pdf,.jpg,.jpeg,.png" required
                class="w-full text-sm text-slate-500 bg-[#F0F2F5] rounded-xl px-4 py-3 file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#1C2C4E] file:text-white hover:file:bg-[#111A31]">
        </div>

        <div class="pt-2 flex gap-3">
            <a href="{{ route('masyarakat.pengajuan.create') }}"
                class="flex-1 text-center py-4 rounded-xl text-sm font-bold text-slate-600 bg-[#F0F2F5] hover:bg-slate-200 transition-all">
                ← Kembali
            </a>
            <button type="submit"
                class="flex-1 flex justify-center items-center py-4 rounded-xl text-sm font-bold text-white bg-gradient-to-r from-[#172545] to-[#1F335C] shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all">
                Kirim Pengajuan
                <svg class="ml-2.5 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </button>
        </div>

    </form>

</div>

</body>
</html>