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
<body class="bg-[#F3F4F6] min-h-screen p-6 font-['Inter']">

    <div class="max-w-2xl mx-auto">

        <div class="mb-6">
            <h1 class="text-2xl font-bold text-[#1C2C4E]">Pengajuan Bantuan</h1>
             <p class="text-sm text-slate-500 mt-1">Langkah 1 dari 2 - Isi data pengajuan Anda.</p>
        </div>

        <div class="flex items-center mb-8">
            <div class="flex items-center justify-center w-8 h-8 rounded-full bg-[#1C2C4E] text-white text-sm font-bold">1</div>
            <div class="flex-1 h-1 bg-[#1C2C4E] mx-2"></div>
            <div class="flex items-center justify-center w-8 h-8 rounded-full bg-slate-200 text-slate-400 text-sm font-bold">2</div>
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

        <form action="{{ route('masyarakat.pengajuan.store') }}" method="POST" class="bg-white rounded-2xl shadow p-8 space-y-6">
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
                                            placeholder="0">
            </div>
        </div> 

        <div>
            <label class="block text-[0.7rem] font-bold text-slate-600 uppercase tracking-widest mb-2">
                Jumlah Tanggungan
            </label>
            <input type="number" name="jumlah_tanggungan" value="{{ old('jumlah_tanggungan') }}" required min="0"
                class="w-full px-4 py-3.5 bg-[#F0F2F5] rounded-xl text-sm font-medium text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-[#1C2C4E] focus:bg-white transition-all outline-none"
                placeholder="Contoh: 3">
        </div>

        <div>
            <label class="block text-[0.7rem] font-bold text-slate-600 uppercase tracking-widest mb-2">
                Deskripsi Kebutuhan
            </label>
            <textarea name="deskripsi_kebutuhan" rows="4"
                class="w-full px-4 py-3.5 bg-[#F0F2F5] rounded-xl text-sm font-medium text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-[#1C2C4E] focus:bg-white transition-all outline-none resize-none"
                placeholder="Jelaskan kondisi dan kebutuhan Anda...">{{ old('deskripsi_kebutuhan') }}</textarea>
        </div>

        <div class="pt-2">
            <button type="submit"
                class="w-full flex justify-center items-center py-4 px-4 rounded-xl text-[0.95rem] font-bold text-white bg-linear-to-r from-[#172545] to-[#1F335C] shadow-lg shadow-[#172545]/25 hover:shadow-xl hover:-translate-y-0.5 active:translate-y-0 active:shadow-md transition-all outline-none">
                Selanjutnya
                <svg class="ml-2.5 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </button>
        </div>

    </form>

</div>

</body>
</html>