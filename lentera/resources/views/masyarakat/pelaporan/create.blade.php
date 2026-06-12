<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lapor Penyalahgunaan Bantuan | LENTERA</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --surface: rgba(255, 255, 255, 0.85);
            --surface-border: rgba(255, 255, 255, 0.5);
            --text-dark: #1e293b;
            --text-light: #64748b;
            --error: #ef4444;
            --success: #10b981;
    <title>Lapor Penyalahgunaan Bantuan - LENTERA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-slate-50 text-slate-900 min-h-screen font-['Inter']">

<div class="min-h-screen">
    <div class="grid grid-cols-12 gap-6 p-6">

        {{-- ===== SIDEBAR ===== --}}
        <aside class="col-span-12 xl:col-span-3 bg-white rounded-3xl border border-slate-200 p-6 shadow-sm flex flex-col sticky top-6 h-max">
            <div class="flex items-center gap-3 mb-6">
                <div class="h-12 w-12 rounded-2xl bg-slate-900 text-white flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                <div>
                    <p class="text-slate-900 font-semibold uppercase tracking-wider text-xs">LENTERA</p>
                    <p class="text-slate-500 text-xs font-medium uppercase tracking-wider">Panel Transparansi</p>
                </div>
            </div>

            {{-- Profil User --}}
            <div class="flex items-center gap-3 mb-6 p-3 rounded-2xl border border-slate-100 bg-slate-50">
                <div class="h-10 w-10 rounded-full bg-orange-100 flex items-center justify-center flex-shrink-0">
                    <span class="text-orange-600 font-bold text-sm">{{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 2)) }}</span>
                </div>
                <div class="overflow-hidden">
                    <p class="font-semibold text-sm truncate">{{ Auth::user()->name ?? 'Pengguna' }}</p>
                    <p class="text-slate-500 text-xs">Verified Citizen</p>
                </div>
            </div>

            <nav class="space-y-1 flex-1">
                <a href="{{ route('masyarakat.dashboard') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-600 hover:bg-slate-100 font-medium transition-colors">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Overview
                </a>
                <a href="{{ route('masyarakat.pengajuan.index') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-600 hover:bg-slate-100 font-medium transition-colors">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Pengajuan Saya
                </a>
                <a href="{{ route('masyarakat.pengajuan.create') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-600 hover:bg-slate-100 hover:text-slate-900 font-medium transition-colors">
                    <svg class="w-5 h-5 text-slate-400 group-hover:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Ajukan Bantuan
                </a>
                <a href="{{ route('masyarakat.pelaporan.create') }}" class="flex items-center gap-3 rounded-2xl bg-white border border-slate-200 text-slate-900 px-4 py-3 shadow-sm font-medium">
                    <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    Laporkan Penyalahgunaan
                </a>
                <a href="{{ route('masyarakat.notifikasi.index') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-600 hover:bg-slate-100 font-medium transition-colors">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    Notifikasi & Pengingat
                    @if($unreadNotificationsCount > 0)
                        <span class="ml-auto bg-red-100 text-red-650 text-xs font-bold px-2 py-0.5 rounded-full">{{ $unreadNotificationsCount }}</span>
                    @endif
                </a>
                <a href="{{ route('masyarakat.feedback.create') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-600 hover:bg-slate-100 font-medium transition-colors">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                    Beri Feedback
                </a>
            </nav>

            <div class="mt-6 pt-6 border-t border-slate-200">
                <a href="{{ route('logout') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-red-500 hover:bg-red-50 font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Keluar
                </a>
            </div>
        </aside>

        {{-- ===== MAIN CONTENT ===== --}}
        <main class="col-span-12 xl:col-span-9 space-y-6">
            <header class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-extrabold text-slate-900 font-['Plus_Jakarta_Sans'] tracking-tight">Lapor Penyalahgunaan</h1>
                    <p class="text-sm text-slate-500 mt-1">Bantu kami memastikan distribusi bantuan tepat sasaran dengan melaporkan indikasi kecurangan.</p>
                </div>
            </header>

            {{-- ALERT SUCCESS --}}
            @if(session('success'))
                <div class="bg-green-50 text-green-600 text-sm p-4 rounded-xl border border-green-100 mb-6 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

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
            <form action="{{ route('masyarakat.pelaporan.store') }}" method="POST" enctype="multipart/form-data"
                class="bg-white rounded-3xl border border-slate-200 shadow-sm p-8 space-y-6">
                @csrf

                {{-- Jenis Bantuan --}}
                <div>
                    <label class="block text-[0.7rem] font-bold text-slate-600 uppercase tracking-widest mb-2">
                        Jenis Bantuan yang Disalahgunakan
                    </label>
                    <div class="relative">
                        <select name="jenis_bantuan" id="jenis_bantuan" required
                            class="appearance-none w-full px-4 py-3.5 bg-[#F0F2F5] rounded-xl text-sm font-medium text-slate-800 focus:ring-2 focus:ring-[#1E3A5F] focus:bg-white transition-all outline-none cursor-pointer">
                            <option value="" disabled selected>Pilih Jenis Bantuan...</option>
                            <option value="Bantuan Pendidikan" {{ old('jenis_bantuan') == 'Bantuan Pendidikan' ? 'selected' : '' }}>Bantuan Pendidikan</option>
                            <option value="Bantuan Kesehatan" {{ old('jenis_bantuan') == 'Bantuan Kesehatan' ? 'selected' : '' }}>Bantuan Kesehatan</option>
                            <option value="Infrastruktur Desa" {{ old('jenis_bantuan') == 'Infrastruktur Desa' ? 'selected' : '' }}>Infrastruktur Desa</option>
                            <option value="Bantuan Pangan" {{ old('jenis_bantuan') == 'Bantuan Pangan' ? 'selected' : '' }}>Bantuan Pangan</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-500">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" /></svg>
                        </div>
                    </div>
                    @error('jenis_bantuan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Deskripsi Kejadian --}}
                <div>
                    <label class="block text-[0.7rem] font-bold text-slate-600 uppercase tracking-widest mb-2">
                        Deskripsi Kejadian
                    </label>
                    <textarea name="deskripsi_kejadian" rows="4" required
                        class="w-full px-4 py-3.5 bg-[#F0F2F5] rounded-xl text-sm font-medium text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-[#1E3A5F] focus:bg-white transition-all outline-none resize-none"
                        placeholder="Jelaskan indikasi kecurangan yang Anda temui secara detail...">{{ old('deskripsi_kejadian') }}</textarea>
                    @error('deskripsi_kejadian')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Lokasi Kejadian --}}
                <div>
                    <label class="block text-[0.7rem] font-bold text-slate-600 uppercase tracking-widest mb-2">
                        Lokasi Kejadian
                    </label>
                    <input type="text" name="lokasi_kejadian" value="{{ old('lokasi_kejadian') }}" required
                        class="w-full px-4 py-3.5 bg-[#F0F2F5] rounded-xl text-sm font-medium text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-[#1E3A5F] focus:bg-white transition-all outline-none"
                        placeholder="Contoh: Desa Makmur, RT 01/RW 02">
                    @error('lokasi_kejadian')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Upload Bukti (Foto/Video) --}}
                <div>
                    <label class="block text-[0.7rem] font-bold text-slate-600 uppercase tracking-widest mb-2">
                        Unggah Bukti (Foto/Video)
                    </label>
                    <div class="border-2 border-dashed border-slate-200 rounded-xl p-6 text-center bg-[#F8F9FA] relative hover:border-[#1E3A5F] transition-all">
                        <svg class="w-8 h-8 text-slate-400 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                        <p class="text-xs text-slate-400 mb-3" id="file-text-instruction">Klik untuk unggah atau seret file ke sini (Max. 10MB)</p>
                        <p class="text-[10px] text-slate-400 mb-3">Format: JPG, PNG, MP4</p>
                        <input type="file" name="bukti" required accept="image/jpeg,image/png,video/mp4,video/quicktime" onchange="showFileName(this)"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" style="opacity: 0;">
                    </div>
                    <div id="file-name" class="mt-2 text-xs font-semibold text-slate-700 hidden">
                        File terpilih: <span id="file-name-text"></span>
                    </div>
                    @error('bukti')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tombol --}}
                <div class="flex gap-3 pt-2 border-t border-slate-100">
                    <a href="{{ route('masyarakat.dashboard') }}"
                        class="flex-1 flex items-center justify-center gap-2 py-3.5 rounded-xl text-sm font-bold text-slate-600 bg-[#F0F2F5] hover:bg-slate-200 transition-all">
                        ← Kembali ke Dashboard
                    </a>
                    <button type="submit"
                        class="flex-1 flex justify-center items-center gap-2 py-3.5 rounded-xl text-sm font-bold text-white bg-gradient-to-r from-[#172545] to-[#1F335C] shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all">
                        Kirim Laporan
                    </button>
                </div>
            </form>

            {{-- INFO BOX --}}
            <div class="bg-blue-50 border border-blue-100 rounded-3xl p-5 flex gap-4">
                <div class="text-blue-500 mt-1">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-slate-700 mb-1">Laporan Anda Rahasia</p>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Kami menjamin kerahasiaan identitas pelapor. Setiap laporan yang masuk akan ditindaklanjuti secara objektif oleh tim pengawas LENTERA.
                    </p>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    function showFileName(input) {
        const fileNameDisplay = document.getElementById('file-name');
        const fileNameText = document.getElementById('file-name-text');
        if (input.files && input.files[0]) {
            fileNameText.textContent = input.files[0].name;
            fileNameDisplay.classList.remove('hidden');
        } else {
            fileNameDisplay.classList.add('hidden');
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f0f9ff 0%, #cbebff 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            padding: 2rem;
            box-sizing: border-box;
        }

        .glass-container {
            background: var(--surface);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--surface-border);
            border-radius: 24px;
            padding: 3rem;
            width: 100%;
            max-width: 600px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05), 0 1px 3px rgba(0, 0, 0, 0.1);
            animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .header h1 {
            color: var(--text-dark);
            font-size: 1.875rem;
            font-weight: 700;
            margin: 0 0 0.5rem 0;
            letter-spacing: -0.025em;
        }

        .header p {
            color: var(--text-light);
            font-size: 1rem;
            margin: 0;
            line-height: 1.5;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .form-control {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-family: 'Inter', sans-serif;
            font-size: 1rem;
            color: var(--text-dark);
            background: rgba(255, 255, 255, 0.9);
            transition: all 0.2s ease;
            box-sizing: border-box;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }

        .file-upload {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            background: rgba(248, 250, 252, 0.5);
            cursor: pointer;
            transition: all 0.2s ease;
            text-align: center;
        }

        .file-upload:hover {
            border-color: var(--primary);
            background: rgba(239, 246, 255, 0.5);
        }

        .file-upload input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .file-icon {
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .file-text {
            color: var(--text-light);
            font-size: 0.95rem;
        }

        .file-text span {
            color: var(--primary);
            font-weight: 600;
        }

        .btn-submit {
            width: 100%;
            padding: 1rem;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.125rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.25);
            margin-top: 1rem;
        }

        .btn-submit:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.35);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .alert {
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
            font-weight: 500;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #34d399;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #f87171;
            margin-top: 0.5rem;
            padding: 0.5rem 1rem;
            font-size: 0.85rem;
            border-radius: 8px;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 1.5rem;
            color: var(--text-light);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .back-link:hover {
            color: var(--primary);
        }

        .file-name-display {
            margin-top: 0.5rem;
            font-size: 0.875rem;
            color: var(--text-dark);
            font-weight: 500;
            display: none;
        }

        @media (max-width: 640px) {
            .glass-container {
                padding: 2rem;
            }
        }
    </style>

</head>
<body class="bg-slate-50 text-slate-900 min-h-screen font-['Inter']">

<div class="min-h-screen">
    <div class="grid grid-cols-12 gap-6 p-6">

        {{-- ===== SIDEBAR ===== --}}
        <aside class="col-span-12 xl:col-span-3 bg-white rounded-3xl border border-slate-200 p-6 shadow-sm flex flex-col sticky top-6 h-max">
            <div class="flex items-center gap-3 mb-6">
                <div class="h-12 w-12 rounded-2xl bg-slate-900 text-white flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                <div>
                    <p class="text-slate-900 font-semibold uppercase tracking-wider text-xs">LENTERA</p>
                    <p class="text-slate-500 text-xs font-medium uppercase tracking-wider">Panel Transparansi</p>
                </div>
            </div>

            {{-- Profil User --}}
            <div class="flex items-center gap-3 mb-6 p-3 rounded-2xl border border-slate-100 bg-slate-50">
                <div class="h-10 w-10 rounded-full bg-orange-100 flex items-center justify-center flex-shrink-0">
                    <span class="text-orange-600 font-bold text-sm">{{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 2)) }}</span>
                </div>
                <div class="overflow-hidden">
                    <p class="font-semibold text-sm truncate">{{ Auth::user()->name ?? 'Pengguna' }}</p>
                    <p class="text-slate-500 text-xs">Verified Citizen</p>
                </div>
            </div>

            <nav class="space-y-1 flex-1">
                <a href="{{ route('masyarakat.dashboard') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-600 hover:bg-slate-100 font-medium transition-colors">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Overview
                </a>
                <a href="{{ route('masyarakat.pengajuan.index') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-600 hover:bg-slate-100 font-medium transition-colors">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Pengajuan Saya
                </a>
                <a href="{{ route('masyarakat.pengajuan.create') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-600 hover:bg-slate-100 hover:text-slate-900 font-medium transition-colors">
                    <svg class="w-5 h-5 text-slate-400 group-hover:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Ajukan Bantuan
                </a>
                <a href="{{ route('masyarakat.pelaporan.create') }}" class="flex items-center gap-3 rounded-2xl bg-white border border-slate-200 text-slate-900 px-4 py-3 shadow-sm font-medium">
                    <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    Laporkan Penyalahgunaan
                </a>
                <a href="{{ route('masyarakat.notifikasi.index') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-600 hover:bg-slate-100 font-medium transition-colors">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    Notifikasi & Pengingat
                    @if($unreadNotificationsCount > 0)
                        <span class="ml-auto bg-red-100 text-red-650 text-xs font-bold px-2 py-0.5 rounded-full">{{ $unreadNotificationsCount }}</span>
                    @endif
                </a>
                <a href="{{ url('/masyarakat/peta-bantuan') }}"
                        class="flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-600 hover:bg-slate-100 font-medium transition-colors">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Peta Bantuan
                        </a>

                        <a href="{{ url('/masyarakat/statistik-publik') }}"
                        class="flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-600 hover:bg-slate-100 font-medium transition-colors">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-6m4 6V7m4 10v-3"/>
                            </svg>
                            Statistik Bantuan
                        </a>
                <a href="{{ route('masyarakat.feedback.create') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-600 hover:bg-slate-100 font-medium transition-colors">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                    Beri Feedback
                </a>
            </nav>

            <div class="mt-6 pt-6 border-t border-slate-200">
                <a href="{{ route('logout') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-red-500 hover:bg-red-50 font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Keluar
                </a>
            </div>
        </aside>

        {{-- ===== MAIN CONTENT ===== --}}
        <main class="col-span-12 xl:col-span-9 space-y-6">
            <header class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-extrabold text-slate-900 font-['Plus_Jakarta_Sans'] tracking-tight">Lapor Penyalahgunaan</h1>
                    <p class="text-sm text-slate-500 mt-1">Bantu kami memastikan distribusi bantuan tepat sasaran dengan melaporkan indikasi kecurangan.</p>
                </div>
            </header>

            {{-- ALERT SUCCESS --}}
            @if(session('success'))
                <div class="bg-green-50 text-green-600 text-sm p-4 rounded-xl border border-green-100 mb-6 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

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
            <form action="{{ route('masyarakat.pelaporan.store') }}" method="POST" enctype="multipart/form-data"
                class="bg-white rounded-3xl border border-slate-200 shadow-sm p-8 space-y-6">
                @csrf

                {{-- Deskripsi Kejadian --}}
                <div>
                    <label class="block text-[0.7rem] font-bold text-slate-600 uppercase tracking-widest mb-2">
                        Deskripsi Kejadian
                    </label>
                    <textarea name="deskripsi_kejadian" rows="4" required
                        class="w-full px-4 py-3.5 bg-[#F0F2F5] rounded-xl text-sm font-medium text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-[#1E3A5F] focus:bg-white transition-all outline-none resize-none"
                        placeholder="Jelaskan indikasi kecurangan yang Anda temui secara detail...">{{ old('deskripsi_kejadian') }}</textarea>
                    @error('deskripsi_kejadian')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Lokasi Kejadian --}}
                <div>
                    <label class="block text-[0.7rem] font-bold text-slate-600 uppercase tracking-widest mb-2">
                        Lokasi Kejadian
                    </label>
                    <input type="text" name="lokasi_kejadian" value="{{ old('lokasi_kejadian') }}" required
                        class="w-full px-4 py-3.5 bg-[#F0F2F5] rounded-xl text-sm font-medium text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-[#1E3A5F] focus:bg-white transition-all outline-none"
                        placeholder="Contoh: Desa Makmur, RT 01/RW 02">
                    @error('lokasi_kejadian')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Upload Bukti (Foto/Video) --}}
                <div>
                    <label class="block text-[0.7rem] font-bold text-slate-600 uppercase tracking-widest mb-2">
                        Unggah Bukti (Foto/Video)
                    </label>
                    <div class="border-2 border-dashed border-slate-200 rounded-xl p-6 text-center bg-[#F8F9FA] relative hover:border-[#1E3A5F] transition-all">
                        <svg class="w-8 h-8 text-slate-400 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                        <p class="text-xs text-slate-400 mb-3" id="file-text-instruction">Klik untuk unggah atau seret file ke sini (Max. 10MB)</p>
                        <p class="text-[10px] text-slate-400 mb-3">Format: JPG, PNG, MP4</p>
                        <input type="file" name="bukti" required accept="image/jpeg,image/png,video/mp4,video/quicktime" onchange="showFileName(this)"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" style="opacity: 0;">
                    </div>
                    <div id="file-name" class="mt-2 text-xs font-semibold text-slate-700 hidden">
                        File terpilih: <span id="file-name-text"></span>
                    </div>
                    @error('bukti')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tombol --}}
                <div class="flex gap-3 pt-2 border-t border-slate-100">
                    <a href="{{ route('masyarakat.dashboard') }}"
                        class="flex-1 flex items-center justify-center gap-2 py-3.5 rounded-xl text-sm font-bold text-slate-600 bg-[#F0F2F5] hover:bg-slate-200 transition-all">
                        ← Kembali ke Dashboard
                    </a>
                    <button type="submit"
                        class="flex-1 flex justify-center items-center gap-2 py-3.5 rounded-xl text-sm font-bold text-white bg-gradient-to-r from-[#172545] to-[#1F335C] shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all">
                        Kirim Laporan
                    </button>
                </div>
            </form>

            {{-- INFO BOX --}}
            <div class="bg-blue-50 border border-blue-100 rounded-3xl p-5 flex gap-4">
                <div class="text-blue-500 mt-1">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-slate-700 mb-1">Laporan Anda Rahasia</p>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Kami menjamin kerahasiaan identitas pelapor. Setiap laporan yang masuk akan ditindaklanjuti secara objektif oleh tim pengawas LENTERA.
                    </p>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    function showFileName(input) {
        const fileNameDisplay = document.getElementById('file-name');
        const fileNameText = document.getElementById('file-name-text');
        if (input.files && input.files[0]) {
            fileNameText.textContent = input.files[0].name;
            fileNameDisplay.classList.remove('hidden');
        } else {
            fileNameDisplay.classList.add('hidden');
        }
    }
</script>

</body>
</html>