
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🩺 Breast Cancer Detection Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Kalam&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .bg-glass {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(12px);
        }
        .sidebar-icon {
            transition: transform 0.3s ease-in-out;
        }
        .sidebar-icon:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body class="bg-gradient-to-r from-pink-900 to-purple-800 min-h-screen text-white" x-data="{ sidebarOpen: true }">

    <!-- Sidebar -->
    <div class="flex">
        <aside class="w-64 h-screen bg-glass border-r border-pink-600 p-4 transition-all duration-300"
               x-show="sidebarOpen"
               x-transition>
            <h2 class="text-2xl font-bold mb-6 text-pink-300 animate-pulse">🎗️ Cancer AI Panel</h2>

            <nav class="space-y-4">
                <a href="{{ route('home') }}" class="flex items-center gap-3 sidebar-icon hover:text-pink-200">
                    🏠 <span>Home</span>
                </a>
                <a href="{{ route('users.index') }}" class="flex items-center gap-3 sidebar-icon hover:text-pink-200">
                    👩‍⚕️ <span>Patients</span>
                </a>
                <a href="{{ route('diagnosis.index') }}" class="flex items-center gap-3 sidebar-icon hover:text-pink-200">
                    🧬 <span>Diagnoses</spknow
                    an>
                </a>
                <a href="{{ route('reports.index') }}" class="flex items-center gap-3 sidebar-icon hover:text-pink-200">
                    📊 <span>Reports</span>
                </a>
                <a href="{{ route('dashboard.powerbi') }}" class="flex items-center gap-3 sidebar-icon hover:text-pink-200">
                    🔍 <span>AI Insights</span>
                </a>
                <a href="{{ route('support.index') }}" class="flex items-center gap-3 sidebar-icon hover:text-pink-200">
                    💬 <span>Support</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <!-- Top Bar -->
            <header class="flex justify-between items-center mb-6">
                <button @click="sidebarOpen = !sidebarOpen" class="text-white focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <h1 class="text-2xl font-semibold text-pink-200">Breast Cancer Dashboard</h1>
                <div class="flex items-center gap-4">
    <span class="text-sm text-gray-300">Welcome, Admin</span>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="bg-pink-600 hover:bg-pink-700 text-white px-3 py-1 rounded text-sm">
            Logout
        </button>
    </form>
</div>

            </header>

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center mt-10 text-gray-400 text-sm">
        &copy; {{ date('Y') }} Breast Cancer Detection AI. All rights reserved.
    </footer>
</body>
</html>
