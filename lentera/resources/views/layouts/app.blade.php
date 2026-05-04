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
            <div class="flex items-center">
                <h1 class="text-2xl font-bold text-blue-600">LENTERA</h1>
            </div>
            <div class="flex items-center gap-6">
                <span class="text-gray-700">{{ Auth::user()->name ?? 'User' }}</span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Sidebar + Content -->
    <div class="flex">
        <!-- Sidebar -->
        @if(Auth::user() && Auth::user()->role === 'admin')
        <div class="w-64 bg-white border-r border-gray-200 min-h-screen sticky top-0">
            <div class="p-8">
                <h2 class="text-sm font-bold text-gray-600 uppercase tracking-wider mb-6">Menu Admin</h2>
                <nav class="space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 font-medium">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.feedback.index') }}" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 font-medium">
                        Manajemen Feedback
                    </a>
                </nav>
            </div>
        </div>
        @endif

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
