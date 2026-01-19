<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CV. Wiguna Arya') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="flex min-h-screen">
        <!-- SIDEBAR -->
        @include('layouts.sidebar')

        <!-- KONTEN UTAMA -->
        <div class="flex-1 lg:ml-64">
            <!-- Header dengan Hamburger Menu -->
            <header class="bg-white shadow-sm sticky top-0 z-20">
                <div class="py-4 px-6 flex justify-between items-center">
                    <!-- Hamburger Menu untuk Mobile -->
                    <button id="open-sidebar" class="lg:hidden text-gray-600 hover:text-gray-900">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <!-- Judul Halaman -->
                    <div class="flex-1 lg:flex-none">
                        @if (isset($header))
                            <div class="ml-4 lg:ml-0">
                                {{ $header }}
                            </div>
                        @endif
                    </div>
                </div>
            </header>

            <!-- Konten -->
            <main class="p-4 sm:p-6">
                {{ $slot }}
            </main>
        </div>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        const openSidebarBtn = document.getElementById('open-sidebar');
        if (openSidebarBtn) {
            openSidebarBtn.addEventListener('click', function() {
                document.getElementById('sidebar').classList.remove('-translate-x-full');
                document.getElementById('sidebar-overlay').classList.remove('hidden');
            });
        }
    </script>
    @stack('scripts')
</body>
</html>