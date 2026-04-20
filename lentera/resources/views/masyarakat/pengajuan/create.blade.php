<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Bantuan - LENTERA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F3F4F6] min-h-screen p-6 font-['Inter']">

    <div class="max-w-2xl mx-auto">

        <div class="mb-6">
            <h1 class="text-2xl font-bold text-[#1C2C4E]">Pengajuan Bantuan</h1>
            <p class="text-sm text-slate-500 mt-1">Isi formulir di bawah ini dengan data yang benar dan lengkap.</p>
        </div>

        @if(session('success'))
            <div class="bg-green-50 text-green-600 text-sm p-4 rounded-xl border border-green-100 mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-50 text-red-600 text-sm p-4 rounded-xl border border-red-100 mb-6">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('masyarakat.pengajuan.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl shadow p-8 space-y-6">
            @csrf
            
            <div>
                <label class="block text-[0.7rem] font-bold text-slate-600 uppercase tracking-widest mb-2">
                    Jenis Bantuan
                </label>
                <select name="jenis_bantuan" required
                    class="w-full px-4 py-3.5 bg-[#F0F2F5] rounded-xl text-sm font-medium text-slate-800 focus:ring-2 focus:ring-[#1C2C4E] focus:bg-white transition-all outline-none">
                    <option value="" disabled selected>Pilih jenis bantuan</option>
                    <option value="Bantuan Pangan" {{ old('jenis_bantuan') == 'Bantuan Pangan' ? 'selected' : '' }}>Bantuan Pangan</option>
                    <option value="Bantuan Kesehatan" {{ old('jenis_bantuan') == 'Bantuan Kesehatan' ? 'selected' : '' }}>Bantuan Kesehatan</option>
                    <option value="Bantuan Pendidikan" {{ old('jenis_bantuan') == 'Bantuan Pendidikan' ? 'selected' : '' }}>Bantuan Pendidikan</option>
                    <option value="Bantuan Perumahan" {{ old('jenis_bantuan') == 'Bantuan Perumahan' ? 'selected' : '' }}>Bantuan Perumahan</option>
                </select>
            </div>
            <div>
                <label class="block text-[0.7rem] font-bold text-slate-600 uppercase tracking-widest mb-2">
                    Penghasilan Per Bulan (Rp)
                </label>
                <div class="relative flex items-center">
                    <span class="absolute pl-4 text-slate-400 text-sm font-medium">Rp</span>
                    <input type="number" name="penghasilan" value="{{ old('penghasilan') }}" required min="0"
                        class="w-full pl-10 pr-4 py-3.5 bg-[#F0F2F5] rounded-xl text-sm font-medium text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-[#1C2C4E] focus:bg-white transition-all outline