<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard — 
            <span class="text-sm font-normal capitalize text-gray-600">
                {{ auth()->user()->role === 'pemilik' ? 'Pemilik' : auth()->user()->role }}
            </span>
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <!-- Statistik Proyek -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl p-5 shadow">
                    <h3 class="text-sm opacity-80">Total Proyek</h3>
                    <p class="text-3xl font-bold mt-1">{{ $stats['total_projects'] }}</p>
                </div>
                <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-white rounded-xl p-5 shadow">
                    <h3 class="text-sm opacity-80">Berjalan</h3>
                    <p class="text-3xl font-bold mt-1">{{ $stats['running_projects'] }}</p>
                </div>
                <div class="bg-gradient-to-r from-green-500 to-green-600 text-white rounded-xl p-5 shadow">
                    <h3 class="text-sm opacity-80">Selesai</h3>
                    <p class="text-3xl font-bold mt-1">{{ $stats['completed_projects'] }}</p>
                </div>
                <div class="bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl p-5 shadow">
                    <h3 class="text-sm opacity-80">Tertunda</h3>
                    <p class="text-3xl font-bold mt-1">{{ $stats['delayed_projects'] }}</p>
                </div>
            </div>

            <!-- Proyek Terbaru -->
            @if($latestProjects->isNotEmpty())
            <div class="bg-white rounded-xl shadow overflow-hidden">
                <div class="p-4 border-b border-gray-200">
                    <h3 class="font-semibold text-lg text-gray-800">Proyek Terbaru</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Lokasi</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mandor</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($latestProjects as $p)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 font-medium">{{ $p->name }}</td>
                                <td class="px-4 py-3 text-sm">{{ $p->location }}</td>
                                <td class="px-4 py-3">
                                    @if($p->status === 'selesai')
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs">Selesai</span>
                                    @elseif($p->status === 'berjalan')
                                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-xs">Berjalan</span>
                                    @else
                                        <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-xs">Tertunda</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">{{ $p->supervisor?->name ?? '–' }}</td>
                                <td class="px-4 py-3">
                                    <a href="{{ route('projects.show', $p) }}" class="text-blue-600 hover:underline text-sm">Detail</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
    </div>

    @push('scripts')
    <script>
        const map = L.map('dashboard-map').setView([-6.2088, 106.8456], 6);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        const projects = @json($mapProjects);

        function getMarkerColor(status) {
            switch(status) {
                case 'selesai': return '#10B981'; // green-500
                case 'berjalan': return '#F59E0B'; // amber-500
                case 'tertunda': return '#EF4444'; // red-500
                default: return '#6B7280';
            }
        }

        projects.forEach(p => {
            if (!p.latitude || !p.longitude) return;

            const icon = L.divIcon({
                className: 'custom-marker',
                html: `
                    <div style="
                        background-color: ${getMarkerColor(p.status)};
                        width: 24px;
                        height: 24px;
                        border-radius: 50%;
                        border: 2px solid white;
                        box-shadow: 0 0 6px rgba(0,0,0,0.3);
                    "></div>
                `,
                iconSize: [24, 24],
                iconAnchor: [12, 12]
            });

            const popupContent = `
                <div class="font-medium">${p.name}</div>
                <div class="text-sm text-gray-600 mt-1">${p.location}</div>
                <div class="mt-2">
                    <span class="inline-block px-2 py-1 rounded text-xs font-medium"
                          style="background-color: ${getMarkerColor(p.status)}20; color: ${getMarkerColor(p.status)};">
                        ${p.status === 'selesai' ? 'Selesai' : p.status === 'berjalan' ? 'Berjalan' : 'Tertunda'}
                    </span>
                </div>
                <div class="mt-2">
                    <a href="/projects/${p.id}" class="text-blue-600 hover:underline text-sm">Lihat Detail</a>
                </div>
            `;

            L.marker([p.latitude, p.longitude], { icon })
                .addTo(map)
                .bindPopup(popupContent);
        });
    </script>
    @endpush
</x-app-layout>