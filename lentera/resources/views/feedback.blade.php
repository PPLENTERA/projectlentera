<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Pelayanan - LENTERA</title>
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
                    <span class="text-orange-600 font-bold text-sm">{{ strtoupper(substr(Auth::user()?->name ?? 'U', 0, 2)) }}</span>
                </div>
                <div class="overflow-hidden">
                    <p class="font-semibold text-sm truncate">{{ Auth::user()?->name ?? 'Pengguna' }}</p>
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
                <a href="{{ route('masyarakat.pelaporan.create') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-600 hover:bg-slate-100 font-medium transition-colors">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
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
                <a href="{{ route('masyarakat.feedback.create') }}" class="flex items-center gap-3 rounded-2xl bg-white border border-slate-200 text-slate-900 px-4 py-3 shadow-sm font-medium">
                    <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
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
                    <h1 class="text-3xl font-extrabold text-slate-900 font-['Plus_Jakarta_Sans'] tracking-tight">Saran & Masukan</h1>
                    <p class="text-sm text-slate-500 mt-1">Setiap masukan Anda adalah lentera yang membimbing kami menuju pelayanan yang lebih transparan dan berintegritas.</p>
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

            <div class="grid grid-cols-12 gap-6">
                {{-- Form Section --}}
                <div class="col-span-12 lg:col-span-8">
                    <form action="{{ route('masyarakat.feedback.store') }}" method="POST"
                        class="bg-white rounded-3xl border border-slate-200 shadow-sm p-8 space-y-6">
                        @csrf

                        {{-- Nama Lengkap & Nomor Telepon --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[0.7rem] font-bold text-slate-600 uppercase tracking-widest mb-2">
                                    Nama Lengkap
                                </label>
                                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required
                                    class="w-full px-4 py-3.5 bg-[#F0F2F5] rounded-xl text-sm font-medium text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-[#1E3A5F] focus:bg-white transition-all outline-none"
                                    placeholder="Contoh: Budi Santoso">
                                @error('nama_lengkap')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-[0.7rem] font-bold text-slate-600 uppercase tracking-widest mb-2">
                                    Nomor Telepon
                                </label>
                                <input type="text" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')" name="nomor_telepon" value="{{ old('nomor_telepon') }}" required
                                    class="w-full px-4 py-3.5 bg-[#F0F2F5] rounded-xl text-sm font-medium text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-[#1E3A5F] focus:bg-white transition-all outline-none"
                                    placeholder="0812XXXX">
                                @error('nomor_telepon')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Kategori Masukan --}}
                        <div>
                            <label class="block text-[0.7rem] font-bold text-slate-600 uppercase tracking-widest mb-2">
                                Kategori Masukan
                            </label>
                            <select name="kategori_masukan" required
                                class="w-full px-4 py-3.5 bg-[#F0F2F5] rounded-xl text-sm font-medium text-slate-800 focus:ring-2 focus:ring-[#1E3A5F] focus:bg-white transition-all outline-none">
                                <option value="" disabled selected>Pilih Kategori</option>
                                <option value="Saran" {{ old('kategori_masukan') === 'Saran' ? 'selected' : '' }}>Saran</option>
                                <option value="Laporan" {{ old('kategori_masukan') === 'Laporan' ? 'selected' : '' }}>Laporan</option>
                                <option value="Keluhan" {{ old('kategori_masukan') === 'Keluhan' ? 'selected' : '' }}>Keluhan</option>
                                <option value="Pertanyaan" {{ old('kategori_masukan') === 'Pertanyaan' ? 'selected' : '' }}>Pertanyaan</option>
                            </select>
                            @error('kategori_masukan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Deskripsi Masukan --}}
                        <div>
                            <label class="block text-[0.7rem] font-bold text-slate-600 uppercase tracking-widest mb-2">
                                Deskripsi Masukan
                            </label>
                            <textarea name="deskripsi_masukan" rows="6" required
                                class="w-full px-4 py-3.5 bg-[#F0F2F5] rounded-xl text-sm font-medium text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-[#1E3A5F] focus:bg-white transition-all outline-none resize-none"
                                placeholder="Ceritakan pengalaman Anda secara detail di sini...">{{ old('deskripsi_masukan') }}</textarea>
                            @error('deskripsi_masukan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tombol --}}
                        <div class="pt-2 border-t border-slate-100">
                            <button type="submit"
                                class="w-full flex justify-center items-center gap-2 py-3.5 rounded-xl text-sm font-bold text-white bg-gradient-to-r from-[#172545] to-[#1F335C] shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all">
                                Kirim Feedback
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Aside Info Card --}}
                <div class="col-span-12 lg:col-span-4 space-y-6">
                    <div class="bg-gradient-to-br from-[#022448] to-[#1E3A5F] rounded-3xl p-6 text-white shadow-sm relative overflow-hidden">
                        <div class="absolute -right-16 -bottom-16 w-40 h-40 bg-blue-500/20 rounded-full blur-2xl"></div>
                        <h3 class="text-lg font-bold font-['Plus_Jakarta_Sans'] mb-3">Transparansi Tanpa Batas</h3>
                        <p class="text-xs text-blue-200 leading-relaxed mb-4">
                            Kami percaya bahwa keterbukaan adalah fondasi kepercayaan. Setiap laporan Anda akan diproses secara terbuka dan dapat dipantau melalui dashboard publik kami.
                        </p>
                        <ul class="text-xs space-y-2 text-blue-100">
                            <li class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-amber-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                                </svg>
                                Verifikasi data otomatis 24 jam
                            </li>
                            <li class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-amber-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                                </svg>
                                Privasi pelapor terlindungi sepenuhnya
                            </li>
                        </ul>
                    </div>

                    <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm">
                        <h3 class="text-sm font-bold text-[#1E3A5F] mb-2 font-['Plus_Jakarta_Sans']">Butuh Bantuan Segera?</h3>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            Jika Anda memerlukan bantuan teknis terkait pengisian formulir, hubungi pusat layanan kami yang beroperasi 24/7.
                        </p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

</body>
</html>
