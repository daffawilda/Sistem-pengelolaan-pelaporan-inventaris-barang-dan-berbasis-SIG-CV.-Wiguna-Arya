<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Sistem Informasi Manajemen Proyek & Inventaris CV. Wiguna Arya – Transparansi real-time proyek konstruksi dan pemantauan inventaris di Kudus, Jawa Tengah." />
    <title>CV. Wiguna Arya – Sistem Informasi Proyek & Inventaris</title>
    @vite(['resources/css/app.css', 'resources/js/map.js'])
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        #map { height: 400px; border-radius: 0.5rem; }
    </style>
</head>
<body class="bg-white text-gray-800">

    <!-- Header -->
    <header class="sticky top-0 z-50 bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <span class="font-bold text-xl text-gray-900">CV. <span class="text-blue-700">Wiguna Arya</span></span>
            </div>
            <div class="hidden md:flex space-x-6">
                <a href="#proyek" class="text-gray-700 hover:text-blue-700 font-medium">Proyek</a>
                <a href="#inventaris" class="text-gray-700 hover:text-blue-700 font-medium">Inventaris</a>
                <a href="#peta" class="text-gray-700 hover:text-blue-700 font-medium">Peta Lokasi</a>
                <a href="/login" class="text-blue-700 font-medium">Login Internal</a>
            </div>
        </div>
    </header>

    <!-- Hero -->
    <section class="bg-gradient-to-br from-blue-900 to-blue-700 text-white py-20">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Transparansi Proyek & Inventaris Real-Time</h1>
            <p class="text-xl opacity-90 mb-8">
                Sistem informasi terpadu untuk pemantauan proyek konstruksi dan manajemen inventaris alat kerja di CV. Wiguna Arya.
            </p>
            <a href="/login" class="inline-block bg-white text-blue-800 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 shadow-lg">
                Akses Portal Internal
            </a>
        </div>
    </section>

  <!-- Peta Lokasi Proyek (SIG) -->
<section id="peta" class="py-16">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900">Peta Lokasi Proyek</h2>
            <p class="text-gray-600 mt-2">Visualisasi geografis proyek konstruksi CV. Wiguna Arya</p>
        </div>
        <div class="bg-white rounded-lg shadow overflow-hidden">
            @if($latestProjects->isNotEmpty())
                <div id="map" class="h-96 w-full"></div>
                <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    const map = L.map('map').setView([-6.805, 110.805], 12);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Fungsi untuk membuat ikon berdasarkan status
    function getIconByStatus(status) {
        let color = 'blue'; // default
        if (status === 'selesai') color = 'green';
        else if (status === 'berjalan') color = 'yellow';
        else if (status === 'tertunda') color = 'red';

        return L.divIcon({
            html: `<div style="
                background-color: ${color};
                width: 24px;
                height: 24px;
                border-radius: 50%;
                border: 2px solid white;
                box-shadow: 0 0 4px rgba(0,0,0,0.4);
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-weight: bold;
                font-size: 12px;
            ">●</div>`,
            className: '',
            iconSize: [24, 24],
            iconAnchor: [12, 12]
        });
    }

    // Tambahkan marker proyek
    @foreach($latestProjects as $project)
        @if($project->latitude && $project->longitude)
            L.marker(
                [{{ $project->latitude }}, {{ $project->longitude }}],
                { icon: getIconByStatus("{{ $project->status }}") }
            ).addTo(map).bindPopup(`
                <strong>{{ $project->name }}</strong><br>
                Lokasi: {{ $project->location }}<br>
                Mandor: {{ $project->supervisor?->name ?? '–' }}<br>
                Status: 
                @if($project->status === 'berjalan') <span style="color:#d97706;">Berjalan</span>
                @elseif($project->status === 'selesai') <span style="color:#16a34a;">Selesai</span>
                @else <span style="color:#dc2626;">Tertunda</span> @endif
            `);
        @endif
    @endforeach
</script>
            @else
                <div class="p-8 text-center text-gray-500">
                    Belum ada proyek yang terdaftar dengan lokasi geografis.
                </div>
            @endif
        </div>
    </div>
</section>

    <!-- Inventaris Publik -->
    <section id="inventaris" class="py-16 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">Inventaris Alat Kerja</h2>
                <p class="text-gray-600 mt-2">Stok alat kerja dan alat berat yang tersedia untuk proyek</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Nama Alat</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Jenis</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Stok Tersedia</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Kondisi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($availableTools as $tool)
                                <tr>
                                    <td class="px-4 py-2 text-sm">{{ $tool->name }}</td>
                                    <td class="px-4 py-2 text-sm capitalize">{{ str_replace('_', ' ', $tool->type) }}</td>
                                    <td class="px-4 py-2 text-sm">{{ $tool->stock }}</td>
                                    <td class="px-4 py-2 text-sm">
                                        <span class="inline-block px-2 py-1 rounded-full text-xs
                                            @if($tool->condition === 'baik') bg-green-100 text-green-800
                                            @elseif($tool->condition === 'rusak_ringan') bg-yellow-100 text-yellow-800
                                            @else bg-red-100 text-red-800 @endif">
                                            {{ $tool->condition }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-2 text-center text-gray-500">Tidak ada data inventaris</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between">
                <div class="mb-6 md:mb-0">
                    <h3 class="font-bold text-lg">CV. Wiguna Arya</h3>
                    <p class="text-gray-400 text-sm mt-2">
                        Sistem Informasi Manajemen Proyek & Inventaris<br>
                        Kudus, Jawa Tengah<br>
                        Email: info@wigunaarya.co.id
                    </p>
                </div>
                <div>
                    <h4 class="font-semibold mb-3">Akses Internal</h4>
                    <ul class="text-gray-400 text-sm space-y-1">
                        <li><a href="/login" class="hover:text-white">Login Admin/Pelaksana/Mandor</a></li>
                        <li><a href="#proyek" class="hover:text-white">Proyek Publik</a></li>
                        <li><a href="#inventaris" class="hover:text-white">Inventaris Publik</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-6 text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} CV. Wiguna Arya. Sistem Informasi Manajemen Proyek & Inventaris.
            </div>
        </div>
    </footer>

    <script>
        // Inisialisasi peta
        const map = L.map('map').setView([-6.805, 110.805], 12); // Koordinat Kudus

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Tambahkan marker proyek
        @foreach($latestProjects as $project)
            @if($project->latitude && $project->longitude)
                L.marker([{{ $project->latitude }}, {{ $project->longitude }}]).addTo(map)
                    .bindPopup(`
                        <strong>{{ $project->name }}</strong><br>
                        Status: 
                        @if($project->status === 'berjalan') <span class="text-yellow-600">Berjalan</span>
                        @elseif($project->status === 'selesai') <span class="text-green-600">Selesai</span>
                        @else <span class="text-red-600">Tertunda</span> @endif
                    `);
            @endif
        @endforeach
    </script>
</body>
</html>