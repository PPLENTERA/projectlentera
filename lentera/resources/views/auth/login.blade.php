<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - LENTERA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F3F4F6] min-h-screen flex items-center justify-center p-4 font-['Inter']">

    <div class="flex flex-col md:flex-row w-full max-w-4xl bg-white rounded-3xl shadow-xl overflow-hidden min-h-[550px]">
        
        <!-- Kolom Kiri - LENTERA Branding -->
        <div class="relative hidden md:flex flex-col w-[45%] p-10 bg-gradient-to-b from-[#1C2C4E] to-[#111A31] text-white">
            
            <!-- Ornamen Garis Tipis (Opsional / Background effect) -->
            <div class="absolute inset-0 opacity-20 pointer-events-none" style="background-image: radial-gradient(circle at 50% 120%, rgba(255,255,255,0.1) 0%, transparent 60%);"></div>

            <!-- Header Branding -->
            <div class="relative z-10 w-full text-left mt-2">
                <h1 class="text-3xl font-extrabold tracking-tight mb-2">LENTERA</h1>
                <p class="text-[0.6rem] sm:text-[0.65rem] font-medium tracking-widest text-[#8F9BB3] uppercase">
                    Layanan Evaluasi dan Transparansi Bantuan Rakyat
                </p>
            </div>
            
            <!-- Ilustrasi Lampion -->
            <div class="relative z-10 flex-1 flex items-center justify-center py-8">
                <!-- Lingkaran Cahaya -->
                <div class="relative w-44 h-44 rounded-full border-[2px] border-[#394B6E] bg-gradient-to-br from-[#26375A] to-[#162340] shadow-[0_0_50px_rgba(255,255,255,0.05)] flex items-center justify-center p-3">
                    <img src="{{ asset('images/LENTERA KUNING.png') }}" alt="Ilustrasi Lentera" class="w-full h-full object-contain rounded-full opacity-90 drop-shadow-md">
                </div>
            </div>
            
            <!-- Footer Branding -->
            <div class="relative z-10 text-center w-full max-w-[280px] mx-auto mb-4">
                <h2 class="text-2xl font-bold mb-3 tracking-wide">LENTERA</h2>
                <p class="text-sm font-normal text-[#8A99BA] leading-relaxed">
                    Mewujudkan keadilan sosial melalui pengawasan yang transparan dan akuntabel.
                </p>
            </div>
        </div>

        <!-- Kolom Kanan - Form Login -->
        <div class="w-full md:w-[55%] p-10 md:p-14 flex flex-col justify-center bg-white">
            <h2 class="text-[1.75rem] font-bold text-slate-900 mb-2">Selamat Datang</h2>
            <p class="text-[0.95rem] text-slate-500 mb-8 tracking-tight">Silakan masuk untuk mengakses panel bantuan Anda.</p>

            @if ($errors->any())
                <div class="bg-red-50 text-red-600 text-sm p-4 rounded-xl border border-red-100 mb-6 font-medium">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Input Email -->
                <div>
                    <label for="email" class="block text-[0.7rem] font-bold text-slate-600 uppercase tracking-widest mb-2">
                        Username atau Email
                    </label>
                    <div class="relative flex items-center">
                        <div class="absolute pl-4 pointer-events-none text-slate-400">
                            <!-- User Icon -->
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                            class="block w-full pl-11 pr-4 py-3.5 border-none bg-[#F0F2F5] rounded-xl text-sm font-medium text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-[#1C2C4E] focus:bg-white transition-all outline-none" 
                            placeholder="nama@email.com">
                    </div>
                </div>

                <!-- Input Password -->
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label for="password" class="block text-[0.7rem] font-bold text-slate-600 uppercase tracking-widest">
                            Kata Sandi
                        </label>
                        <a href="#" class="text-xs font-bold text-[#1F54CE] hover:text-[#11389A] transition-colors">
                            Lupa sandi?
                        </a>
                    </div>
                    <div class="relative flex items-center group">
                        <div class="absolute pl-4 pointer-events-none text-slate-400">
                            <!-- Lock Icon -->
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input type="password" id="password" name="password" required 
                            class="block w-full pl-11 pr-11 py-3.5 border-none bg-[#F0F2F5] rounded-xl text-sm font-medium text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-[#1C2C4E] focus:bg-white transition-all outline-none tracking-widest" 
                            placeholder="••••••••">
                        <button type="button" onclick="togglePassword()" class="absolute right-0 pr-4 text-slate-400 hover:text-slate-600 focus:outline-none transition-colors">
                            <!-- Eye Icon -->
                            <svg id="eye-icon" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="pt-4">
                    <button type="submit" class="w-full flex justify-center items-center py-4 px-4 rounded-xl text-[0.95rem] font-bold text-white bg-gradient-to-r from-[#172545] to-[#1F335C] shadow-lg shadow-[#172545]/25 hover:shadow-xl hover:-translate-y-0.5 active:translate-y-0 active:shadow-md transition-all outline-none">
                        Masuk
                        <svg class="ml-2.5 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </div>
            </form>

            <div class="mt-10">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-slate-100"></div>
                    </div>
                </div>
                
                <div class="mt-8 text-center text-sm">
                    <span class="text-slate-500">Belum memiliki akun?</span> 
                    <a href="{{ Route::has('register') ? route('register') : '#' }}" class="font-bold text-[#1F54CE] hover:text-[#11389A] transition-colors ml-1">
                        Daftar Akun Baru
                    </a>
                </div>
            </div>

            <!-- Footer Links -->
            <div class="mt-8 flex justify-center space-x-6 text-[0.7rem] text-slate-400 font-semibold">
                <a href="#" class="hover:text-slate-600 transition-colors">Bantuan</a>
                <a href="#" class="hover:text-slate-600 transition-colors">Privasi</a>
                <a href="#" class="hover:text-slate-600 transition-colors">Syarat</a>
            </div>
        </div>
    </div>

    <!-- Script Native untuk Toggle Password -->
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                // Eye-slash / Eye-off icon
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                `;
            } else {
                passwordInput.type = 'password';
                // Eye icon
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                `;
            }
        }
    </script>
</body>
</html>
