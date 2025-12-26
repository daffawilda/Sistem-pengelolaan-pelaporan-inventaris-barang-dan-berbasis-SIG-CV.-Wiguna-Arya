<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Detail Proyek</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-900">{{ $project->name }}</h1>
                    <p class="text-gray-600">{{ $project->location }}</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <p class="text-sm text-gray-500">Status</p>
                        <p class="mt-1">
                            @if($project->status === 'selesai')
                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-sm font-medium">Selesai</span>
                            @elseif($project->status === 'berjalan')
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-sm font-medium">Berjalan</span>
                            @else
                                <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-sm font-medium">Tertunda</span>
                            @endif
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Mandor</p>
                        <p class="mt-1 font-medium">{{ $project->supervisor?->name ?? '–' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Pelaksana</p>
                        <p class="mt-1 font-medium">{{ $project->executor?->name ?? '–' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Koordinat</p>
                        <p class="mt-1 text-sm">{{ $project->latitude }}, {{ $project->longitude }}</p>
                    </div>
                </div>

                <!-- Peta Interaktif -->
                <div class="mt-8">
                    <h3 class="text-lg font-medium text-gray-900 mb-3">Lokasi Proyek</h3>
                    <div id="project-map" class="h-80 rounded-lg border"></div>
                </div>

                <div class="mt-8 flex gap-3">
                    <a href="{{ route('projects.index') }}" class="text-gray-600 hover:text-gray-900 font-medium">← Kembali ke Daftar</a>
                    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'pelaksana')
                        <a href="{{ route('projects.edit', $project) }}" class="text-blue-600 hover:text-blue-800 font-medium">Edit Proyek</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        const map = L.map('project-map').setView([{{ $project->latitude }}, {{ $project->longitude }}], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Warna marker berdasarkan status
        let color = '#666666';
        @if($project->status === 'selesai')
            color = '#10B981'; // hijau
        @elseif($project->status === 'berjalan')
            color = '#F59E0B'; // kuning
        @else
            color = '#EF4444'; // merah
        @endif

        const icon = L.divIcon({
            className: 'custom-marker',
            html: `<div style="
                background-color: ${color};
                width: 24px;
                height: 24px;
                border-radius: 50%;
                border: 2px solid white;
                box-shadow: 0 0 6px rgba(0,0,0,0.3);
            "></div>`,
            iconSize: [24, 24],
            iconAnchor: [12, 12]
        });

        L.marker([{{ $project->latitude }}, {{ $project->longitude }}], { icon })
            .addTo(map)
            .bindPopup(`
                <div class="font-medium">{{ $project->name }}</div>
                <div class="text-sm text-gray-600 mt-1">{{ $project->location }}</div>
                <div class="mt-2">
                    <span class="inline-block px-2 py-1 rounded text-xs font-medium"
                          style="background-color: ${color}20; color: ${color};">
                        {{ $project->status === 'selesai' ? 'Selesai' : ($project->status === 'berjalan' ? 'Berjalan' : 'Tertunda') }}
                    </span>
                </div>
            `);
    </script>
    @endpush
</x-app-layout>