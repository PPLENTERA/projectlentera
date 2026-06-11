<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi & Pengingat - LENTERA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        heading: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-[#F8FAFC] min-h-screen font-sans antialiased text-[#1E293B]">

    {{-- NAVBAR --}}
    <nav class="bg-white border-b border-[#E2E8F0] px-8 py-4 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="text-2xl font-extrabold text-[#112340] font-heading tracking-tight">LENTERA</div>
            <div class="hidden md:flex gap-8 text-sm font-semibold text-[#64748B]">
                <a href="{{ url('/') }}" class="hover:text-[#112340] transition-colors">Home</a>
                <a href="{{ route('masyarakat.dashboard') }}" class="hover:text-[#112340] transition-colors">Dashboard</a>
                <a href="{{ route('masyarakat.pengajuan.index') }}" class="hover:text-[#112340] transition-colors">Bantuan</a>
                <a href="{{ route('masyarakat.pelaporan.create') }}" class="hover:text-[#112340] transition-colors">Pelaporan</a>
            </div>
            <div class="flex items-center gap-6">
                <!-- Bell Icon -->
                <a href="{{ route('masyarakat.notifikasi.index') }}" class="relative p-2 text-[#64748B] hover:text-[#112340] transition-colors bg-slate-50 hover:bg-slate-100 rounded-full" id="navbar-notification-btn">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                    @if($unreadCount > 0)
                        <span class="absolute top-0.5 right-0.5 block h-2.5 w-2.5 rounded-full bg-red-500 ring-2 ring-white"></span>
                    @endif
                </a>
                
                <!-- User Profile -->
                <div class="flex items-center gap-3 border-l border-slate-200 pl-6">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-bold text-[#1E293B]">{{ $authUser->name }}</p>
                        <p class="text-xs text-[#94A3B8]">ID: {{ $authUser->id }}</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-[#112340] flex items-center justify-center text-white text-sm font-bold shadow-md">
                        {{ strtoupper(substr($authUser->name, 0, 2)) }}
                    </div>
                </div>
            </div>
        </div>
    </nav>

    {{-- MAIN WRAPPER --}}
    <main class="max-w-7xl mx-auto py-10 px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            {{-- LEFT COLUMN: NOTIFICATION LIST --}}
            <div class="lg:col-span-8 space-y-8">
                
                <!-- Header Title -->
                <div>
                    <div class="flex items-center gap-2 text-xs font-bold tracking-widest text-[#64748B] uppercase mb-2">
                        <div class="p-1.5 bg-[#112340] text-white rounded-md">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                        </div>
                        Pusat Pesan
                    </div>
                    <h1 class="text-4xl font-extrabold text-[#112340] font-heading tracking-tight mb-2">
                        Notifikasi & <span class="text-[#3b82f6]">Pengingat</span>
                    </h1>
                    <p class="text-sm text-[#64748B] max-w-xl">
                        Tetap terinformasi dengan pembaruan status pengajuan dan jadwal bantuan sosial Anda secara real-time.
                    </p>
                </div>

                {{-- NOTIFICATION ITEMS --}}
                <div class="space-y-8">

                    {{-- Empty State --}}
                    @if($todayNotifications->isEmpty() && $yesterdayNotifications->isEmpty() && $olderNotifications->isEmpty())
                        <div class="bg-white rounded-3xl p-10 border border-[#E2E8F0] shadow-sm text-center">
                            <div class="w-16 h-16 bg-slate-100 text-[#94A3B8] rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                </svg>
                            </div>
                            <h3 class="font-bold text-[#112340] text-lg mb-1">Belum ada notifikasi</h3>
                            <p class="text-sm text-[#64748B]">Semua pembaruan status pengajuan atau jadwal bantuan Anda akan tampil di sini.</p>
                        </div>
                    @endif

                    {{-- HARI INI --}}
                    @if($todayNotifications->isNotEmpty())
                        <div class="space-y-4">
                            <div class="flex items-center gap-4">
                                <span class="text-xs font-extrabold uppercase tracking-widest text-[#94A3B8]">Hari Ini</span>
                                <div class="h-[1px] bg-[#E2E8F0] flex-1"></div>
                            </div>
                            <div class="space-y-4">
                                @foreach($todayNotifications as $notification)
                                    @include('masyarakat.components.notification-card', ['notification' => $notification])
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- KEMARIN --}}
                    @if($yesterdayNotifications->isNotEmpty())
                        <div class="space-y-4">
                            <div class="flex items-center gap-4">
                                <span class="text-xs font-extrabold uppercase tracking-widest text-[#94A3B8]">Kemarin</span>
                                <div class="h-[1px] bg-[#E2E8F0] flex-1"></div>
                            </div>
                            <div class="space-y-4">
                                @foreach($yesterdayNotifications as $notification)
                                    @include('masyarakat.components.notification-card', ['notification' => $notification])
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- SEBELUMNYA --}}
                    @if($olderNotifications->isNotEmpty())
                        <div class="space-y-4">
                            <div class="flex items-center gap-4">
                                <span class="text-xs font-extrabold uppercase tracking-widest text-[#94A3B8]">Sebelumnya</span>
                                <div class="h-[1px] bg-[#E2E8F0] flex-1"></div>
                            </div>
                            <div class="space-y-4">
                                @foreach($olderNotifications as $notification)
                                    @include('masyarakat.components.notification-card', ['notification' => $notification])
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>

            </div>

            {{-- RIGHT COLUMN: PUSAT BANTUAN CARD --}}
            <div class="lg:col-span-4 sticky top-28">
                
                <div class="bg-white rounded-3xl p-8 border border-[#E2E8F0] shadow-sm text-center relative overflow-hidden flex flex-col items-center">
                    
                    {{-- Soft radial glow --}}
                    <div class="absolute -top-16 -right-16 w-40 h-40 bg-orange-100 rounded-full filter blur-3xl opacity-60"></div>
                    
                    {{-- Large bell icon --}}
                    <div class="relative mb-6 mt-4">
                        <div class="w-20 h-20 bg-[#112340] rounded-full flex items-center justify-center text-[#F5A623] shadow-lg">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                        </div>
                        @if($unreadCount > 0)
                            <div class="absolute -bottom-1 -right-1 bg-red-600 text-white font-bold text-xs w-6 h-6 rounded-full flex items-center justify-center border-2 border-white shadow">
                                {{ $unreadCount }}
                            </div>
                        @endif
                    </div>

                    <h2 class="text-xl font-bold text-[#112340] font-heading mb-2">Pusat Bantuan</h2>
                    
                    <p class="text-sm text-[#64748B] mb-8 max-w-[240px]">
                        @if($unreadCount > 0)
                            Ada {{ $unreadCount }} informasi penting yang membutuhkan perhatian Anda segera.
                        @else
                            Semua notifikasi penting Anda telah dibaca.
                        @endif
                    </p>

                    @if($unreadCount > 0)
                        <form action="{{ route('masyarakat.notifikasi.read_all') }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" class="w-full py-4 bg-[#112340] hover:bg-[#1C2C4E] text-white font-bold text-sm rounded-2xl shadow-lg transition-all hover:-translate-y-0.5 duration-200">
                                Tandai Semua Dibaca
                            </button>
                        </form>
                    @else
                        <button disabled class="w-full py-4 bg-slate-100 text-[#94A3B8] font-bold text-sm rounded-2xl cursor-not-allowed">
                            Tidak Ada Pesan Baru
                        </button>
                    @endif

                </div>

            </div>

        </div>

    </main>

</body>
</html>
