<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Makroom</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gradient-to-b from-indigo-600 to-purple-700 text-white">
            <div class="p-6">
                <h1 class="text-2xl font-bold">Makroom Admin</h1>
                <p class="text-indigo-200 text-sm mt-1">Management Panel</p>
            </div>
            
            <nav class="mt-6">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 py-3 hover:bg-white/10 transition {{ request()->routeIs('admin.dashboard') ? 'bg-white/20 border-l-4 border-white' : '' }}">
                    <i class="fas fa-chart-line w-5"></i>
                    <span class="ml-3">Dashboard</span>
                </a>
                
                <a href="{{ route('admin.countries.index') }}" class="flex items-center px-6 py-3 hover:bg-white/10 transition {{ request()->routeIs('admin.countries.*') ? 'bg-white/20 border-l-4 border-white' : '' }}">
                    <i class="fas fa-globe w-5"></i>
                    <span class="ml-3">Countries</span>
                </a>
                
                <a href="{{ route('admin.configs.index') }}" class="flex items-center px-6 py-3 hover:bg-white/10 transition {{ request()->routeIs('admin.configs.*') ? 'bg-white/20 border-l-4 border-white' : '' }}">
                    <i class="fas fa-cog w-5"></i>
                    <span class="ml-3">Configurations</span>
                </a>
                
                <a href="{{ route('admin.ui-settings.index') }}" class="flex items-center px-6 py-3 hover:bg-white/10 transition {{ request()->routeIs('admin.ui-settings.*') ? 'bg-white/20 border-l-4 border-white' : '' }}">
                    <i class="fas fa-sliders-h w-5"></i>
                    <span class="ml-3">UI Settings</span>
                </a>
                
                <a href="{{ route('admin.records.index') }}" class="flex items-center px-6 py-3 hover:bg-white/10 transition {{ request()->routeIs('admin.records.*') ? 'bg-white/20 border-l-4 border-white' : '' }}">
                    <i class="fas fa-database w-5"></i>
                    <span class="ml-3">Records</span>
                </a>
                
                <a href="{{ route('admin.texts.index') }}" class="flex items-center px-6 py-3 hover:bg-white/10 transition {{ request()->routeIs('admin.texts.*') ? 'bg-white/20 border-l-4 border-white' : '' }}">
                    <i class="fas fa-font w-5"></i>
                    <span class="ml-3">App Texts</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Header -->
            <header class="bg-white shadow-sm">
                <div class="px-8 py-4 flex items-center justify-between">
                    <h2 class="text-2xl font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-600">{{ now()->format('M d, Y') }}</span>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="p-8">
                @if(session('success'))
                    <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded">
                        <p class="text-green-700">{{ session('success') }}</p>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded">
                        <p class="text-red-700">{{ session('error') }}</p>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
