<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lapor Penyalahgunaan Bantuan - LENTERA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        #map{
    height:700px;
    border-radius:20px;
    }
    </style>
    <link rel="stylesheet"
    href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

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
                <a href="{{ route('masyarakat.pelaporan.create') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-600 hover:bg-slate-100 font-medium transition-colors">
                    <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    Laporkan Penyalahgunaan
                </a>
                <a href="{{ route('masyarakat.notifikasi.index') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-600 hover:bg-slate-100 font-medium transition-colors">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    Notifikasi & Pengingat
                    @if(isset($unreadNotificationsCount) && $unreadNotificationsCount > 0)
    <span class="ml-auto bg-red-100 text-red-650 text-xs font-bold px-2 py-0.5 rounded-full">
        {{ $unreadNotificationsCount }}
    </span>
@endif
                </a>
                <a href="{{ url('/masyarakat/peta-bantuan') }}"
                        class="flex items-center gap-3 rounded-2xl bg-white border border-slate-200 text-slate-900 px-4 py-3 shadow-sm font-medium">
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
<div id="map"></div>

<script>

var map = L.map('map')
.setView([-6.9735,107.6332],13);

L.tileLayer(
'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
{
maxZoom:19
}
).addTo(map);

@foreach($data as $d)

L.marker([
{{ $d->latitude }},
{{ $d->longitude }}
])

.addTo(map)

.bindPopup(`
<b>{{ $d->name }}</b>
<br>
{{ $d->address ?? 'Alamat belum tersedia' }}
<br>
Score : {{ $d->score }}
`);

@endforeach

</script>

</main>

</div>
</div>

</body>
</html>