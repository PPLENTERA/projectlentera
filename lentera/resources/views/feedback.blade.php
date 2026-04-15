<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Layanan Publik</title>
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-900">
    <div class="mx-auto max-w-6xl px-6 py-10">
        <div class="grid gap-8 lg:grid-cols-[1.4fr_1fr]">
            <section class="rounded-4xl bg-white p-8 shadow-lg shadow-slate-200/60 border border-slate-200">
                <div class="mb-8 inline-flex items-center gap-3 rounded-full bg-cyan-600/10 px-4 py-2 text-sm text-cyan-700">
                    <span class="inline-flex h-2.5 w-2.5 rounded-full bg-cyan-600"></span>
                    SUARA ANDA
                </div>

                <div class="space-y-4">
                    <h1 class="text-4xl font-semibold tracking-tight text-slate-900">Saran & Masukan<br>Layanan Publik</h1>
                    <p class="max-w-xl text-slate-500">Setiap masukan Anda adalah lentera yang membimbing kami menuju pelayanan yang lebih transparan dan berintegritas.</p>
                </div>

                @if(session('success'))
                    <div class="mt-8 rounded-3xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('feedback.store') }}" method="POST" class="mt-8 space-y-6">
                    @csrf

                    <div class="space-y-4">
                        <div class="grid gap-4 sm:grid-cols-2">
                            <label class="flex flex-col gap-2">
                                <span class="text-sm font-medium text-slate-700">Nama Lengkap</span>
                                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" placeholder="Contoh: Budi Santoso" class="h-14 rounded-3xl border border-slate-200 bg-slate-50 px-4 text-slate-900 outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-100" />
                                @error('nama_lengkap')<span class="text-sm text-red-600">{{ $message }}</span>@enderror
                            </label>

                            <label class="flex flex-col gap-2">
                                <span class="text-sm font-medium text-slate-700">Nomor Telepon</span>
                                <input type="text" name="nomor_telepon" value="{{ old('nomor_telepon') }}" placeholder="+62 812 XXXX" class="h-14 rounded-3xl border border-slate-200 bg-slate-50 px-4 text-slate-900 outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-100" />
                                @error('nomor_telepon')<span class="text-sm text-red-600">{{ $message }}</span>@enderror
                            </label>
                        </div>

                        <label class="flex flex-col gap-2">
                            <span class="text-sm font-medium text-slate-700">Kategori Masukan</span>
                            <select name="kategori_masukan" class="h-14 rounded-3xl border border-slate-200 bg-slate-50 px-4 text-slate-900 outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-100">
                                <option value="">Pilih Kategori</option>
                                <option value="Saran" {{ old('kategori_masukan') === 'Saran' ? 'selected' : '' }}>Saran</option>
                                <option value="Laporan" {{ old('kategori_masukan') === 'Laporan' ? 'selected' : '' }}>Laporan</option>
                                <option value="Keluhan" {{ old('kategori_masukan') === 'Keluhan' ? 'selected' : '' }}>Keluhan</option>
                                <option value="Pertanyaan" {{ old('kategori_masukan') === 'Pertanyaan' ? 'selected' : '' }}>Pertanyaan</option>
                            </select>
                            @error('kategori_masukan')<span class="text-sm text-red-600">{{ $message }}</span>@enderror
                        </label>

                        <label class="flex flex-col gap-2">
                            <span class="text-sm font-medium text-slate-700">Deskripsi Masukan</span>
                            <textarea name="deskripsi_masukan" rows="6" placeholder="Ceritakan pengalaman Anda secara detail di sini..." class="rounded-[30px] border border-slate-200 bg-slate-50 px-4 py-4 text-slate-900 outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-100">{{ old('deskripsi_masukan') }}</textarea>
                            @error('deskripsi_masukan')<span class="text-sm text-red-600">{{ $message }}</span>@enderror
                        </label>
                    </div>

                    <button type="submit" class="inline-flex h-14 items-center justify-center rounded-[30px] bg-slate-900 px-8 text-base font-semibold text-white transition hover:bg-slate-800">Kirim Feedback</button>
                </form>
            </section>

            <aside class="space-y-6">
                <div class="rounded-4xl bg-slate-950 p-8 text-white shadow-xl shadow-slate-500/20">
                    <p class="text-sm uppercase tracking-[0.2em] text-cyan-300">Transparansi Tanpa Batas</p>
                    <h2 class="mt-4 text-2xl font-semibold">Kami percaya bahwa keterbukaan adalah fondasi kepercayaan.</h2>
                    <p class="mt-4 text-slate-300">Setiap laporan Anda akan diproses secara terbuka dan dapat dipantau melalui dashboard publik kami.</p>
                    <ul class="mt-6 space-y-3 text-sm text-slate-300">
                        <li class="flex items-start gap-3"><span class="mt-1 inline-flex h-2.5 w-2.5 rounded-full bg-cyan-400"></span>Verifikasi data otomatis dalam 24 jam</li>
                        <li class="flex items-start gap-3"><span class="mt-1 inline-flex h-2.5 w-2.5 rounded-full bg-cyan-400"></span>Privasi pelapor terlindungi sepenuhnya</li>
                    </ul>
                </div>

                <div class="rounded-4xl bg-white p-8 shadow-lg shadow-slate-200 border border-slate-200">
                    <p class="text-sm text-slate-500">Butuh Bantuan Segera?</p>
                    <h3 class="mt-3 text-xl font-semibold text-slate-900">Jika Anda memerlukan bantuan teknis terkait pengisian formulir, hubungi pusat layanan kami yang beroperasi 24/7.</h3>
                    <div class="mt-6 rounded-3xl bg-slate-950 p-6 text-white">
                        <p class="text-sm text-slate-300">Hotline 24 Jam</p>
                        <p class="mt-2 text-xl font-semibold">0800-1-LUMINOUS</p>
                    </div>
                </div>

                <div class="overflow-hidden rounded-4xl bg-linear-to-br from-cyan-600 via-slate-900 to-slate-950 p-8 text-white shadow-xl shadow-slate-700/20">
                    <p class="text-sm text-cyan-200">"Integritas adalah melakukan hal yang benar, bahkan ketika tidak ada orang yang melihat."</p>
                </div>
            </aside>
        </div>
    </div>
</body>
</html>
