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
            <!-- Header (Opsional: Judul Halaman) -->
            @if (isset($header))
                <header class="bg-white shadow-sm">
                    <div class="py-4 px-6">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Konten -->
            <main class="p-6">
                {{ $slot }}
            </main>
        </div>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    @stack('scripts')
</body>
</html>