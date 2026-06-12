@extends('layouts.admin')

@section('title', 'Broadcast Notifikasi')

@section('content')
<div class="flex flex-col gap-8">
    
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-extrabold text-[#022448] font-['Plus_Jakarta_Sans'] tracking-tight">
                Broadcast Notifikasi
            </h1>
            <p class="text-base text-slate-500 mt-1">
                Kirim pesan pemberitahuan bantuan baru secara tepat sasaran kepada calon penerima.
            </p>
        </div>
        <div class="bg-white rounded-3xl px-6 py-4 shadow-sm border border-slate-100 flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-cyan-100 flex items-center justify-center font-bold text-cyan-700">
                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
            </div>
            <div>
                <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Total Pendaftar</p>
                <p class="text-lg font-bold text-[#022448]">{{ $totalRegistered }} Calon Penerima</p>
            </div>
        </div>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="bg-emerald-50 text-emerald-700 text-sm p-4 rounded-2xl border border-emerald-100 shadow-sm flex items-center gap-2">
            <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 text-red-700 text-sm p-4 rounded-2xl border border-red-100 shadow-sm flex items-center gap-2">
            <svg class="w-5 h-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        {{-- Form Broadcast --}}
        <form action="{{ route('admin.broadcast.send') }}" method="POST" class="lg:col-span-7 bg-white rounded-3xl p-8 border border-slate-100 shadow-sm space-y-6">
            @csrf

            <h2 class="text-lg font-bold text-[#022448] font-['Plus_Jakarta_Sans'] border-b border-slate-100 pb-4 mb-2">
                Buat Broadcast Baru
            </h2>

            {{-- Judul Notifikasi --}}
            <div class="space-y-2">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest">Judul Notifikasi</label>
                <input type="text" name="title" required value="{{ old('title', 'Program Bantuan Baru Dibuka') }}"
                    class="w-full px-4 py-3.5 bg-[#F0F2F5] rounded-xl text-sm font-medium text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-[#022448] focus:bg-white transition-all outline-none"
                    placeholder="Contoh: Bantuan Pangan Mandiri Dibuka">
                @error('title')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Isi Pesan --}}
            <div class="space-y-2">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest">Isi Pesan Broadcast</label>
                <textarea name="message" rows="4" required
                    class="w-full px-4 py-3.5 bg-[#F0F2F5] rounded-xl text-sm font-medium text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-[#022448] focus:bg-white transition-all outline-none resize-none"
                    placeholder="Tuliskan detail mengenai program bantuan baru dan ajakan untuk mengajukan..."></textarea>
                @error('message')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kategori Bantuan --}}
            <div class="space-y-2">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest">Kategori Program Bantuan</label>
                <select name="jenis_bantuan" required
                    class="w-full px-4 py-3.5 bg-[#F0F2F5] rounded-xl text-sm font-medium text-slate-800 focus:ring-2 focus:ring-[#022448] focus:bg-white transition-all outline-none">
                    <option value="Bantuan Pangan" {{ old('jenis_bantuan') == 'Bantuan Pangan' ? 'selected' : '' }}>Bantuan Pangan</option>
                    <option value="Bantuan Kesehatan" {{ old('jenis_bantuan') == 'Bantuan Kesehatan' ? 'selected' : '' }}>Bantuan Kesehatan</option>
                    <option value="Bantuan Pendidikan" {{ old('jenis_bantuan') == 'Bantuan Pendidikan' ? 'selected' : '' }}>Bantuan Pendidikan</option>
                    <option value="Bantuan Perumahan" {{ old('jenis_bantuan') == 'Bantuan Perumahan' ? 'selected' : '' }}>Bantuan Perumahan</option>
                </select>
                @error('jenis_bantuan')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kriteria Penyaringan --}}
            <div class="border-t border-slate-100 pt-6 mt-6">
                <h3 class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-4">Penyaringan Calon Penerima</h3>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="block text-[0.65rem] font-bold text-slate-500 uppercase tracking-wider">Maksimal Penghasilan Bulanan</label>
                        <div class="relative">
                            <span class="absolute left-4 top-3 text-sm font-semibold text-slate-400">Rp</span>
                            <input type="number" name="max_income" required value="{{ old('max_income', '2000000') }}"
                                class="w-full pl-10 pr-4 py-3 bg-[#F0F2F5] rounded-xl text-sm font-medium text-slate-800 focus:ring-2 focus:ring-[#022448] focus:bg-white transition-all outline-none">
                        </div>
                        @error('max_income')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[0.65rem] font-bold text-slate-500 uppercase tracking-wider">Minimal Jumlah Tanggungan</label>
                        <div class="relative">
                            <input type="number" name="min_dependents" required value="{{ old('min_dependents', '2') }}"
                                class="w-full px-4 py-3 bg-[#F0F2F5] rounded-xl text-sm font-medium text-slate-800 focus:ring-2 focus:ring-[#022448] focus:bg-white transition-all outline-none">
                            <span class="absolute right-4 top-3 text-sm font-semibold text-slate-400">Orang</span>
                        </div>
                        @error('min_dependents')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <button type="submit"
                class="w-full py-4 bg-gradient-to-br from-[#022448] to-[#1E3A5F] text-white font-bold text-sm rounded-2xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all">
                Kirim Broadcast Notifikasi
            </button>

        </form>

        {{-- Riwayat Broadcast --}}
        <div class="lg:col-span-5 bg-white rounded-3xl p-8 border border-slate-100 shadow-sm space-y-6">
            <h2 class="text-lg font-bold text-[#022448] font-['Plus_Jakarta_Sans'] border-b border-slate-100 pb-4 mb-2">
                Riwayat Broadcast Terkini
            </h2>

            <div class="space-y-4 max-h-[500px] overflow-y-auto pr-2">
                @forelse($pastBroadcasts as $broadcast)
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 space-y-2">
                        <div class="flex justify-between items-start">
                            <h3 class="font-bold text-sm text-[#022448]">{{ $broadcast->title }}</h3>
                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-wider">{{ $broadcast->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-xs text-slate-500 leading-relaxed">{{ $broadcast->message }}</p>
                        <div class="pt-1">
                            <span class="px-2 py-0.5 bg-blue-100 text-blue-700 text-[8px] font-extrabold rounded-full uppercase tracking-widest">
                                Program Baru
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8 text-slate-400 text-sm">
                        Belum ada riwayat broadcast dikirim.
                    </div>
                @endforelse
            </div>
        </div>

    </div>

</div>
@endsection
