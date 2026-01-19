<x-app-layout>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Peta Monitoring Proyek</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-4 border-b border-gray-200">
                    <p class="text-sm text-gray-600">Klik pada marker untuk melihat detail proyek.</p>
                </div>
                <div id="map" class="h-[500px] w-full rounded-lg border"></div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        const map = L.map('map').setView([-7.0990, 110.9110], 12);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        const projects = @json($projects);

        function getMarkerColor(status) {
            switch(status) {
                case 'selesai': return '#10B981'; // green-500
                case 'berjalan': return '#F59E0B'; // amber-500
                case 'tertunda': return '#EF4444'; // red-500
                default: return '#6B7280';
            }
        }

        projects.forEach(project => {
            if (!project.latitude || !project.longitude) return;

            const icon = L.divIcon({
                className: 'custom-marker',
                html: `<div style="
                    background-color: ${getMarkerColor(project.status)};
                    width: 24px;
                    height: 24px;
                    border-radius: 50%;
                    border: 2px solid white;
                    box-shadow: 0 0 6px rgba(0,0,0,0.3);
                "></div>`,
                iconSize: [24, 24],
                iconAnchor: [12, 12]
            });

            const popupContent = `
                <div class="font-medium">${project.name}</div>
                <div class="text-sm text-gray-600 mt-1">${project.location}</div>
                <div class="mt-2">
                    <span class="inline-block px-2 py-1 rounded text-xs font-medium"
                          style="background-color: ${getMarkerColor(project.status)}20; color: ${getMarkerColor(project.status)};">
                        ${project.status === 'selesai' ? 'Selesai' : project.status === 'berjalan' ? 'Berjalan' : 'Tertunda'}
                    </span>
                </div>
                <div class="mt-2">
                    <a href="/projects/${project.id}" class="text-blue-600 hover:underline text-sm">Lihat Detail</a>
                </div>
            `;

            L.marker([project.latitude, project.longitude], { icon })
                .addTo(map)
                .bindPopup(popupContent);
        });
    </script>
    
    @endpush
</x-app-layout>