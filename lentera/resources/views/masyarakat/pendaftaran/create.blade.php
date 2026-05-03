<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Bantuan - LENTERA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .step-hidden { display: none; }
        .step-active { display: block; animation: fadeIn 0.4s ease-out; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-[#F3F4F6] min-h-screen text-slate-800 font-['Inter']">

    <!-- Navbar Sederhana -->
    <nav class="bg-white shadow-sm border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <span class="text-xl font-extrabold text-[#1C2C4E] tracking-tight">LENTERA</span>
                    <span class="ml-2 text-sm text-slate-500 font-medium">Bantuan Sosial</span>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('masyarakat.dashboard') }}" class="text-sm font-semibold text-[#1C2C4E] hover:text-[#1F54CE] transition-colors">
                        Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-4 py-10">
        
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold tracking-tight text-slate-900">Formulir Pendaftaran Bantuan</h1>
            <p class="mt-2 text-sm text-slate-500">Lengkapi data di bawah ini dengan valid dan benar.</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 text-red-600 text-sm p-4 rounded-xl border border-red-100 mb-6 font-medium">
                <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
            
            <!-- Stepper Indicator -->
            <div class="bg-[#1C2C4E] px-8 py-4 flex justify-between items-center text-white relative">
                <!-- Line background -->
                <div class="absolute top-1/2 left-10 right-10 h-0.5 bg-[#394B6E] -z-0 -translate-y-1/2"></div>
                
                <div class="relative z-10 flex flex-col items-center step-indicator" id="ind-1">
                    <div class="w-8 h-8 rounded-full bg-[#1F54CE] border-4 border-[#1C2C4E] flex items-center justify-center font-bold text-xs ring-4 ring-[#1C2C4E]">1</div>
                    <span class="text-[0.65rem] font-bold mt-2 uppercase tracking-wide">Data Diri</span>
                </div>
                <div class="relative z-10 flex flex-col items-center step-indicator opacity-50 transition-opacity" id="ind-2">
                    <div class="w-8 h-8 rounded-full bg-[#394B6E] border-4 border-[#1C2C4E] flex items-center justify-center font-bold text-xs ring-4 ring-[#1C2C4E]">2</div>
                    <span class="text-[0.65rem] font-bold mt-2 uppercase tracking-wide">Ekonomi</span>
                </div>
                <div class="relative z-10 flex flex-col items-center step-indicator opacity-50 transition-opacity" id="ind-3">
                    <div class="w-8 h-8 rounded-full bg-[#394B6E] border-4 border-[#1C2C4E] flex items-center justify-center font-bold text-xs ring-4 ring-[#1C2C4E]">3</div>
                    <span class="text-[0.65rem] font-bold mt-2 uppercase tracking-wide">Dokumen</span>
                </div>
            </div>

            <!-- Form -->
            <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data" class="p-8" id="pendaftaranForm">
                @csrf

                <!-- TAHAP 1: DATA DIRI -->
                <div id="step-1" class="step-active">
                    <h2 class="text-xl font-bold mb-6 text-slate-800 border-b pb-2">1. Informasi Data Diri</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="col-span-2">
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="w-full px-4 py-3 bg-[#F0F2F5] rounded-xl border-none focus:ring-2 focus:ring-[#1C2C4E] text-sm" value="{{ old('nama_lengkap') }}" required placeholder="Sesuai KTP">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="w-full px-4 py-3 bg-[#F0F2F5] rounded-xl border-none focus:ring-2 focus:ring-[#1C2C4E] text-sm" value="{{ old('tanggal_lahir') }}" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="w-full px-4 py-3 bg-[#F0F2F5] rounded-xl border-none focus:ring-2 focus:ring-[#1C2C4E] text-sm" required>
                                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-Laki</option>
                                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">NIK (Nomor Induk Kependudukan)</label>
                            <input type="text" name="nik" maxlength="16" minlength="16" class="w-full px-4 py-3 bg-[#F0F2F5] rounded-xl border-none focus:ring-2 focus:ring-[#1C2C4E] text-sm" value="{{ old('nik') }}" required placeholder="16 Digit NIK">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">Nomor KK (Kartu Keluarga)</label>
                            <input type="text" name="nomor_kk" maxlength="16" minlength="16" class="w-full px-4 py-3 bg-[#F0F2F5] rounded-xl border-none focus:ring-2 focus:ring-[#1C2C4E] text-sm" value="{{ old('nomor_kk') }}" required placeholder="16 Digit No. KK">
                        </div>
                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">Nomor HP / WhatsApp Aktif</label>
                            <input type="text" name="nomor_hp" class="w-full px-4 py-3 bg-[#F0F2F5] rounded-xl border-none focus:ring-2 focus:ring-[#1C2C4E] text-sm" value="{{ old('nomor_hp') }}" required placeholder="08xxxxxxxxxx">
                        </div>
                        <div class="col-span-2">
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">Alamat Lengkap</label>
                            <textarea name="alamat_lengkap" rows="3" class="w-full px-4 py-3 bg-[#F0F2F5] rounded-xl border-none focus:ring-2 focus:ring-[#1C2C4E] text-sm" required placeholder="Jalan, RT/RW, Desa/Kelurahan, Kecamatan">{{ old('alamat_lengkap') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- TAHAP 2: DATA EKONOMI -->
                <div id="step-2" class="step-hidden">
                     <h2 class="text-xl font-bold mb-6 text-slate-800 border-b pb-2">2. Data Kondisi Ekonomi</h2>
                     <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="col-span-2">
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">Pekerjaan Utama</label>
                            <input type="text" name="pekerjaan" class="w-full px-4 py-3 bg-[#F0F2F5] rounded-xl border-none focus:ring-2 focus:ring-[#1C2C4E] text-sm" value="{{ old('pekerjaan') }}" required placeholder="Contoh: Buruh Tani, Karyawan Swasta, Tidak Bekerja">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">Penghasilan Per Bulan (Rp)</label>
                            <input type="number" name="penghasilan_per_bulan" class="w-full px-4 py-3 bg-[#F0F2F5] rounded-xl border-none focus:ring-2 focus:ring-[#1C2C4E] text-sm" value="{{ old('penghasilan_per_bulan') }}" required placeholder="Angka saja (Misal: 1500000)">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">Total Pengeluaran Bulanan (Rp)</label>
                            <input type="number" name="pengeluaran_bulanan" class="w-full px-4 py-3 bg-[#F0F2F5] rounded-xl border-none focus:ring-2 focus:ring-[#1C2C4E] text-sm" value="{{ old('pengeluaran_bulanan') }}" required placeholder="Angka saja">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">Jumlah Tanggungan Keluarga</label>
                            <input type="number" name="jumlah_tanggungan" class="w-full px-4 py-3 bg-[#F0F2F5] rounded-xl border-none focus:ring-2 focus:ring-[#1C2C4E] text-sm" value="{{ old('jumlah_tanggungan') }}" required placeholder="Jumlah jiwa">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">Status Kepemilikan Rumah</label>
                            <select name="status_rumah" class="w-full px-4 py-3 bg-[#F0F2F5] rounded-xl border-none focus:ring-2 focus:ring-[#1C2C4E] text-sm" required>
                                <option value="" disabled selected>Pilih Status Rumah</option>
                                <option value="Milik Sendiri" {{ old('status_rumah') == 'Milik Sendiri' ? 'selected' : '' }}>Milik Sendiri</option>
                                <option value="Sewa/Kontrak" {{ old('status_rumah') == 'Sewa/Kontrak' ? 'selected' : '' }}>Sewa/Kontrak</option>
                                <option value="Numpang" {{ old('status_rumah') == 'Numpang' ? 'selected' : '' }}>Menumpang (Keluarga/Orang Tua)</option>
                            </select>
                        </div>
                     </div>
                </div>

                <!-- TAHAP 3: DOKUMEN PENDUKUNG -->
                <div id="step-3" class="step-hidden">
                     <h2 class="text-xl font-bold mb-6 text-slate-800 border-b pb-2">3. Upload Dokumen Pendukung</h2>
                     <p class="text-xs text-slate-500 mb-6">Unggah dokumen dalam format gambar (JPG/PNG) atau PDF. Maksimal ukuran 2MB per file.</p>
                     
                     <div class="space-y-6">
                         <!-- KTP -->
                         <div class="border-2 border-dashed border-slate-300 rounded-xl p-5 hover:border-[#1C2C4E] transition-colors">
                             <label class="block text-sm font-bold text-slate-700 mb-2">1. Pas Foto KTP Asli</label>
                             <input type="file" name="dokumen_ktp" accept=".jpg,.jpeg,.png,.pdf" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-[#F0F2F5] file:text-[#1F54CE] hover:file:bg-blue-50 transition-all" required>
                         </div>
                         <!-- KK -->
                         <div class="border-2 border-dashed border-slate-300 rounded-xl p-5 hover:border-[#1C2C4E] transition-colors">
                             <label class="block text-sm font-bold text-slate-700 mb-2">2. Foto Kartu Keluarga (KK)</label>
                             <input type="file" name="dokumen_kk" accept=".jpg,.jpeg,.png,.pdf" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-[#F0F2F5] file:text-[#1F54CE] hover:file:bg-blue-50 transition-all" required>
                         </div>
                         <!-- Rumah -->
                         <div class="border-2 border-dashed border-slate-300 rounded-xl p-5 hover:border-[#1C2C4E] transition-colors">
                             <label class="block text-sm font-bold text-slate-700 mb-2">3. Foto Kondisi Rumah Tampak Depan</label>
                             <input type="file" name="dokumen_rumah" accept=".jpg,.jpeg,.png,.pdf" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-[#F0F2F5] file:text-[#1F54CE] hover:file:bg-blue-50 transition-all" required>
                         </div>
                         <!-- SKTM -->
                         <div class="border-2 border-dashed border-slate-300 rounded-xl p-5 hover:border-[#1C2C4E] transition-colors">
                             <label class="block text-sm font-bold text-slate-700 mb-2">4. Surat Keterangan Tidak Mampu (SKTM)</label>
                             <p class="text-[0.65rem] text-slate-500 mb-2">Dikeluarkan oleh pihak Desa / Kelurahan setempat.</p>
                             <input type="file" name="dokumen_sktm" accept=".jpg,.jpeg,.png,.pdf" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-[#F0F2F5] file:text-[#1F54CE] hover:file:bg-blue-50 transition-all" required>
                         </div>
                     </div>
                </div>

                <!-- Form Controls -->
                <div class="mt-10 pt-6 border-t border-slate-200 flex justify-between items-center">
                    <button type="button" id="btn-prev" class="hidden px-6 py-3 rounded-xl text-sm font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 transition-colors">
                        Kembali
                    </button>
                    
                    <div class="ml-auto">
                        <button type="button" id="btn-next" class="px-8 py-3 rounded-xl text-sm font-bold text-white bg-gradient-to-r from-[#172545] to-[#1F335C] shadow-lg shadow-[#172545]/25 hover:shadow-xl transition-all">
                            Selanjutnya
                        </button>
                        <button type="submit" id="btn-submit" class="hidden px-8 py-3 rounded-xl text-sm font-bold text-white bg-gradient-to-r from-blue-600 to-blue-800 shadow-lg shadow-blue-600/30 hover:shadow-xl transition-all">
                            Ajukan Pendaftaran
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <!-- Script Multi-step Form -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let currentStep = 1;
            const totalSteps = 3;
            
            const btnNext = document.getElementById('btn-next');
            const btnPrev = document.getElementById('btn-prev');
            const btnSubmit = document.getElementById('btn-submit');

            btnNext.addEventListener('click', () => {
                if(validateStep(currentStep)) {
                    if (currentStep < totalSteps) {
                        currentStep++;
                        updateUI();
                    }
                } else {
                    alert('Mohon lengkapi semua isian wajib di tahap ini.');
                }
            });

            btnPrev.addEventListener('click', () => {
                if (currentStep > 1) {
                    currentStep--;
                    updateUI();
                }
            });

            function updateUI() {
                // Sembunyikan semua step
                for(let i=1; i<=totalSteps; i++) {
                    document.getElementById('step-'+i).className = 'step-hidden';
                    
                    // Update indicator
                    const ind = document.getElementById('ind-'+i);
                    const circle = ind.querySelector('div');
                    
                    if(i === currentStep) {
                        ind.classList.remove('opacity-50');
                        circle.classList.replace('bg-[#394B6E]', 'bg-[#1F54CE]');
                    } else if (i < currentStep) {
                        ind.classList.remove('opacity-50');
                        circle.classList.replace('bg-[#394B6E]', 'bg-[#1F54CE]');
                    } else {
                        ind.classList.add('opacity-50');
                        circle.classList.replace('bg-[#1F54CE]', 'bg-[#394B6E]');
                    }
                }

                // Tampilkan step aktif
                document.getElementById('step-'+currentStep).className = 'step-active';

                // Toggle buttons
                if(currentStep === 1) {
                    btnPrev.classList.add('hidden');
                } else {
                    btnPrev.classList.remove('hidden');
                }

                if(currentStep === totalSteps) {
                    btnNext.classList.add('hidden');
                    btnSubmit.classList.remove('hidden');
                } else {
                    btnNext.classList.remove('hidden');
                    btnSubmit.classList.add('hidden');
                }
            }

            // Validasi Sederhana sebelum maju ke langkah berikut
            function validateStep(step) {
                const formStep = document.getElementById('step-' + step);
                const inputs = formStep.querySelectorAll('input[required], select[required], textarea[required]');
                let isValid = true;
                
                inputs.forEach(input => {
                    if (!input.value.trim()) {
                        input.classList.add('ring-2', 'ring-red-400', 'bg-red-50');
                        isValid = false;
                    } else {
                        input.classList.remove('ring-2', 'ring-red-400', 'bg-red-50');
                        // Custom validation for NIK/KK length
                        if(input.name === 'nik' || input.name === 'nomor_kk') {
                            if(input.value.length !== 16) {
                                input.classList.add('ring-2', 'ring-red-400', 'bg-red-50');
                                isValid = false;
                            }
                        }
                    }
                });

                return isValid;
            }
            
            // clear error styling on input change
            const allInputs = document.querySelectorAll('input, select, textarea');
            allInputs.forEach(input => {
                input.addEventListener('input', function() {
                    this.classList.remove('ring-2', 'ring-red-400', 'bg-red-50');
                });
            });
        });
    </script>
</body>
</html>
