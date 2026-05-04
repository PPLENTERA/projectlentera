<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan Penyalahgunaan - LENTERA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F3F4F6] min-h-screen p-6 font-['Inter']">

    <div class="max-w-3xl mx-auto">
        <div class="mb-6 flex justify-between items-end">
            <div>
                <h1 class="text-2xl font-bold text-[#1C2C4E]">Detail Laporan</h1>
                <p class="text-sm text-slate-500 mt-1">Periksa informasi dan bukti sebelum mengubah status tindak lanjut.</p>
            </div>
            <a href="{{ route('admin.laporan.index') }}" class="text-sm font-bold text-slate-500 hover:text-[#1C2C4E] transition-colors">
                &larr; Kembali
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow p-6 mb-4 border-t-4 border-[#1C2C4E]">
            <h2 class="text-sm font-bold text-slate-600 uppercase tracking-widest mb-4">Informasi Laporan</h2>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-slate-400 text-xs font-semibold uppercase tracking-widest mb-1">Nama Pelapor</p>
                    <p class="font-semibold text-slate-800">{{ $laporan->user->name }}</p>
                </div>
                <div>
                    <p class="text-slate-400 text-xs font-semibold uppercase tracking-widest mb-1">Email Pelapor</p>
                    <p class="font-semibold text-slate-800">{{ $laporan->user->email }}</p>
                </div>
                <div>
                    <p class="text-slate-400 text-xs font-semibold uppercase tracking-widest mb-1">Tanggal Laporan</p>
                    <p class="font-semibold text-slate-800">{{ $laporan->created_at->format('d M Y, H:i') }}</p>
                </div>
                <div>
                    <p class="text-slate-400 text-xs font-semibold uppercase tracking-widest mb-1">Status Saat Ini</p>
                    @if($laporan->status == 'menunggu_tindak_lanjut')
                        <span class="text-xs font-bold bg-yellow-50 text-yellow-600 px-3 py-1 rounded-full inline-block mt-1">Menunggu</span>
                    @elseif($laporan->status == 'diproses')
                        <span class="text-xs font-bold bg-blue-50 text-blue-600 px-3 py-1 rounded-full inline-block mt-1">Diproses</span>
                    @elseif($laporan->status == 'selesai')
                        <span class="text-xs font-bold bg-green-50 text-green-600 px-3 py-1 rounded-full inline-block mt-1">Selesai</span>
                    @elseif($laporan->status == 'ditolak')
                        <span class="text-xs font-bold bg-red-50 text-red-600 px-3 py-1 rounded-full inline-block mt-1">Ditolak</span>
                    @else
                        <span class="text-xs font-bold bg-slate-50 text-slate-600 px-3 py-1 rounded-full inline-block mt-1">{{ $laporan->status }}</span>
                    @endif
                </div>
                <div class="col-span-2 mt-2">
                    <p class="text-slate-400 text-xs font-semibold uppercase tracking-widest mb-1">Lokasi Kejadian</p>
                    <p class="font-semibold text-slate-800">{{ $laporan->lokasi_kejadian }}</p>
                </div>
                <div class="col-span-2 mt-2">
                    <p class="text-slate-400 text-xs font-semibold uppercase tracking-widest mb-1">Deskripsi Kejadian</p>
                    <div class="font-medium text-slate-700 bg-[#F8F9FA] p-4 rounded-xl mt-1 leading-relaxed">
                        {{ $laporan->deskripsi_kejadian }}
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow p-6 mb-4 border-t-4 border-blue-500">
            <h2 class="text-sm font-bold text-slate-600 uppercase tracking-widest mb-4">Bukti Kejadian</h2>
            @if($laporan->bukti_path)
                <div class="bg-[#F0F2F5] rounded-xl p-4 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                        </svg>
                        <div>
                            <p class="text-sm font-semibold text-slate-800">Lampiran Bukti</p>
                            <p class="text-xs text-slate-500">Klik untuk melihat secara penuh</p>
                        </div>
                    </div>
                    <a href="{{ asset('storage/' . $laporan->bukti_path) }}" target="_blank" class="px-4 py-2 bg-white text-blue-600 text-xs font-bold rounded-lg shadow-sm hover:shadow hover:text-blue-700 transition-all">
                        Buka File
                    </a>
                </div>
                
                @php
                    $extension = pathinfo($laporan->bukti_path, PATHINFO_EXTENSION);
                    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                    $videoExtensions = ['mp4', 'mov', 'avi'];
                @endphp
                
                @if(in_array(strtolower($extension), $imageExtensions))
                    <div class="mt-4 rounded-xl overflow-hidden border border-slate-200">
                        <img src="{{ asset('storage/' . $laporan->bukti_path) }}" alt="Bukti Kejadian" class="w-full h-auto object-cover max-h-96">
                    </div>
                @elseif(in_array(strtolower($extension), $videoExtensions))
                    <div class="mt-4 rounded-xl overflow-hidden border border-slate-200 bg-black">
                        <video controls class="w-full max-h-96">
                            <source src="{{ asset('storage/' . $laporan->bukti_path) }}" type="video/{{ $extension }}">
                            Browser Anda tidak mendukung tag video.
                        </video>
                    </div>
                @endif
                
            @else
                <p class="text-sm text-slate-400 p-4 bg-[#F8F9FA] rounded-xl text-center">Tidak ada bukti yang dilampirkan.</p>
            @endif
        </div>

        <div class="bg-white rounded-2xl shadow p-6 border-t-4 border-green-500">
            <h2 class="text-sm font-bold text-slate-600 uppercase tracking-widest mb-4">Tindak Lanjut Laporan</h2>
            
            <form action="{{ route('admin.laporan.update', $laporan->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-[0.7rem] font-bold text-slate-600 uppercase tracking-widest mb-2">
                        Status Tindak Lanjut
                    </label>
                    <select name="status" required
                        class="w-full px-4 py-3.5 bg-[#F0F2F5] rounded-xl text-sm font-medium text-slate-800 focus:ring-2 focus:ring-green-500 focus:bg-white transition-all outline-none">
                        <option value="menunggu_tindak_lanjut" {{ $laporan->status == 'menunggu_tindak_lanjut' ? 'selected' : '' }}>Menunggu Tindak Lanjut</option>
                        <option value="diproses" {{ $laporan->status == 'diproses' ? 'selected' : '' }}>Sedang Diproses</option>
                        <option value="selesai" {{ $laporan->status == 'selesai' ? 'selected' : '' }}>Selesai / Ditindaklanjuti</option>
                        <option value="ditolak" {{ $laporan->status == 'ditolak' ? 'selected' : '' }}>Laporan Ditolak (Tidak Valid)</option>
                    </select>
                </div>

                <div class="flex gap-3 pt-4 border-t border-slate-100">
                    <button type="submit"
                        class="w-full flex justify-center items-center py-3.5 rounded-xl text-sm font-bold text-white bg-linear-to-r from-green-500 to-green-600 shadow-lg shadow-green-500/30 hover:shadow-xl hover:shadow-green-500/40 hover:-translate-y-0.5 transition-all">
                        Simpan Perubahan Status
                    </button>
                </div>
            </form>
        </div>

    </div>

</body>
</html>