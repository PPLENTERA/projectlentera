@extends('layouts.admin')

@section('title', 'Kirim Feedback')

@section('content')
<div class="space-y-6">
    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-[#1C2C4E]">Kirim Feedback</h1>
        <p class="text-sm text-slate-500 mt-1">Gunakan formulir ini untuk mengirim saran dan masukan internal Anda.</p>
    </div>

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
        <div class="rounded-2xl bg-emerald-50 text-emerald-600 text-sm p-4 border border-emerald-100 shadow-sm mb-6">
            {{ session('success') }}
        </div>
    @endif

    {{-- ALERT ERROR --}}
    @if($errors->any())
        <div class="bg-red-50 text-red-600 text-sm p-4 rounded-2xl border border-red-100 mb-6">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
        <form action="{{ route('feedback.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', Auth::user()->name ?? '') }}" required
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-800 focus:ring-2 focus:ring-cyan-600 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Nomor Telepon</label>
                    <input type="text" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')" 
                           name="nomor_telepon" value="{{ old('nomor_telepon') }}" required
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-800 focus:ring-2 focus:ring-cyan-600 outline-none">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Kategori Masukan</label>
                <select name="kategori_masukan" required
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-800 focus:ring-2 focus:ring-cyan-600 outline-none">
                    <option value="" disabled selected>Pilih Kategori</option>
                    <option value="Saran" {{ old('kategori_masukan') === 'Saran' ? 'selected' : '' }}>Saran</option>
                    <option value="Laporan" {{ old('kategori_masukan') === 'Laporan' ? 'selected' : '' }}>Laporan</option>
                    <option value="Keluhan" {{ old('kategori_masukan') === 'Keluhan' ? 'selected' : '' }}>Keluhan</option>
                    <option value="Pertanyaan" {{ old('kategori_masukan') === 'Pertanyaan' ? 'selected' : '' }}>Pertanyaan</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Deskripsi Masukan</label>
                <textarea name="deskripsi_masukan" rows="6" required
                          class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-800 focus:ring-2 focus:ring-cyan-600 outline-none resize-none"
                          placeholder="Ceritakan masukan internal Anda secara detail di sini...">{{ old('deskripsi_masukan') }}</textarea>
            </div>

            <div class="pt-2 border-t border-slate-100 flex justify-end">
                <button type="submit" class="px-6 py-3 bg-[#1C2C4E] hover:bg-[#111A31] text-white rounded-xl text-sm font-bold transition-all shadow-md">
                    Kirim Feedback
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
