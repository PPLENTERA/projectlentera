<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - LENTERA Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F8F9FA] font-['Inter']">

<div class="flex min-h-screen">

    <aside class="w-72 bg-[#F8F9FA] fixed left-0 top-0 h-full flex flex-col py-8 border-r border-slate-100">

        <div class="px-8 mb-10">
            <h1 class="text-2xl font-extrabold text-[#1E3A5F] font-['Plus_Jakarta_Sans'] tracking-tight">LENTERA</h1>
            <p class="text-xs text-slate-400 uppercase tracking-widest mt-1">Management Portal</p>
        </div>

        <nav class="flex-1 px-6 space-y-2">
            <a href="/admin/dashboard"
                class="flex items-center gap-3 px-4 py-3 rounded-full text-sm font-medium transition-all
                {{ request()->is('admin/dashboard') ? 'bg-white shadow text-[#1E3A5F] font-semibold' : 'text-slate-500 hover:bg-white hover:text-[#1E3A5F]' }}">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Dashboard
            </a>

            <a href="/admin/validasi"
                class="flex items-center gap-3 px-4 py-3 rounded-full text-sm font-medium transition-all
                {{ request()->is('admin/validasi*') ? 'bg-white shadow text-[#1E3A5F] font-semibold' : 'text-slate-500 hover:bg-white hover:text-[#1E3A5F]' }}">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Verifikasi
            </a>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 rounded-full text-sm font-medium transition-all
                {{ request()->is('admin/rekomendasi*') ? 'bg-white shadow text-[#1E3A5F] font-semibold' : 'text-slate-500 hover:bg-white hover:text-[#1E3A5F]' }}">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                </svg>
                Rekomendasi
            </a>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 rounded-full text-sm font-medium transition-all
                {{ request()->is('admin/laporan*') ? 'bg-white shadow text-[#1E3A5F] font-semibold' : 'text-slate-500 hover:bg-white hover:text-[#1E3A5F]' }}">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Laporan
            </a>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 rounded-full text-sm font-medium transition-all text-slate-500 hover:bg-white hover:text-[#1E3A5F]">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Pengaturan
            </a>
        </nav>

        <div class="px-6">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="flex items-center gap-3 px-4 py-3 rounded-full text-sm font-medium text-slate-500 hover:bg-white hover:text-red-500 transition-all w-full">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Logout
                </button>
            </form>
        </div>

    </aside>

    <main class="ml-72 flex-1 p-12">
        @yield('content')
    </main>

</div>

</body>
</html>