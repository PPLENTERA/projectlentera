<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LENTERA') - Sistem Bantuan Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Navigation Bar -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-8 py-4 flex justify-between items-center">
            <div class="flex items-center gap-6">
                <h1 class="text-2xl font-bold text-blue-600">LENTERA</h1>
                @if(Auth::user() && Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="text-sm font-semibold text-gray-500 hover:text-blue-600 transition-colors">← Kembali ke Dashboard</a>
                @endif
            </div>
            <div class="flex items-center gap-6">
                <span class="text-gray-700 font-medium">{{ Auth::user()->name ?? 'User' }}</span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="flex">
        <!-- Main Content -->
        <div class="flex-1">
            @yield('content')
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-8 mt-12">
        <div class="max-w-7xl mx-auto px-8 text-center">
            <p>&copy; 2026 LENTERA - Sistem Bantuan Digital. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
