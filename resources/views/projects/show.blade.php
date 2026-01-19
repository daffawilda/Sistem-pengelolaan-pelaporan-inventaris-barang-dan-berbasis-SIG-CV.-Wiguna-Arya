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

                <!-- Alat yang Digunakan/Dipinjam -->
                <div class="mt-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Alat yang Dipinjam</h3>
                    @php
                        $borrowings = \App\Models\ToolBorrowing::where('project_id', $project->id)->with('tool')->get();
                    @endphp
                    
                    @if($borrowings->count() > 0)
                        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm">
                                    <thead class="bg-gray-100 border-b">
                                        <tr>
                                            <th class="px-4 py-3 text-left font-medium text-gray-700">Nama Alat</th>
                                            <th class="px-4 py-3 text-left font-medium text-gray-700">Jenis</th>
                                            <th class="px-4 py-3 text-left font-medium text-gray-700">Qty</th>
                                            <th class="px-4 py-3 text-left font-medium text-gray-700">Tgl Pinjam</th>
                                            <th class="px-4 py-3 text-left font-medium text-gray-700">Tgl Kembali</th>
                                            <th class="px-4 py-3 text-left font-medium text-gray-700">Status Peminjaman</th>
                                            <th class="px-4 py-3 text-left font-medium text-gray-700">Verifikasi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach($borrowings as $borrow)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-3 font-medium text-gray-900">{{ $borrow->tool->name }}</td>
                                            <td class="px-4 py-3 text-gray-600">
                                                @if($borrow->tool->type === 'alat_kerja')
                                                    <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs">Alat Kerja</span>
                                                @else
                                                    <span class="px-2 py-1 bg-purple-100 text-purple-800 rounded text-xs">Alat Berat</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3 text-gray-600">{{ $borrow->quantity }}</td>
                                            <td class="px-4 py-3 text-gray-600">{{ \Carbon\Carbon::parse($borrow->borrow_date)->format('d M Y') }}</td>
                                            <td class="px-4 py-3 text-gray-600">{{ $borrow->return_date ? \Carbon\Carbon::parse($borrow->return_date)->format('d M Y') : '–' }}</td>
                                            <td class="px-4 py-3">
                                                @if($borrow->status === 'dipinjam')
                                                    <span class="px-2 py-1 bg-orange-100 text-orange-800 rounded text-xs font-medium">Dipinjam</span>
                                                @else
                                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs font-medium">Dikembalikan</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3">
                                                @if($borrow->verified === 'approved')
                                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs font-medium">✓ Disetujui</span>
                                                @elseif($borrow->verified === 'rejected')
                                                    <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-xs font-medium">✗ Ditolak</span>
                                                @else
                                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-xs font-medium">⏳ Pending</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">Belum ada alat yang dipinjam untuk proyek ini.</p>
                    @endif
                </div>

                <!-- Progress Laporan -->
                <div class="mt-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Progress Proyek</h3>
                    @php
                        $reports = $project->progressReports()->with('reporter', 'feedbacks')->latest('report_date')->get();
                    @endphp
                    
                    @if($reports->count() > 0)
                        <div class="space-y-4">
                            @foreach($reports as $report)
                            <div class="bg-white rounded-lg border border-gray-200 p-4">
                                <div class="flex justify-between items-start gap-4">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-3 mb-2">
                                            <span class="text-sm font-medium text-gray-900">{{ $report->reporter?->name ?? '–' }}</span>
                                            <span class="text-sm text-gray-500">{{ $report->report_date->format('d M Y') }}</span>
                                        </div>
                                        @if($report->progress_percentage)
                                            <div class="mb-2">
                                                <div class="flex justify-between mb-1">
                                                    <span class="text-xs text-gray-600">Progress</span>
                                                    <span class="text-sm font-semibold text-blue-600">{{ $report->progress_percentage }}%</span>
                                                </div>
                                                <div class="w-full bg-gray-200 rounded-full h-2">
                                                    <div class="bg-blue-600 h-2 rounded-full transition-all" style="width: {{ $report->progress_percentage }}%"></div>
                                                </div>
                                            </div>
                                        @endif
                                        <p class="text-sm text-gray-700 mt-2">{{ $report->description }}</p>
                                        @if($report->image)
                                            <div class="mt-3">
                                                <img src="{{ $report->image_url() }}" alt="Progress Report" class="max-w-xs rounded-lg border border-gray-200">
                                            </div>
                                        @endif
                                        @if($report->feedbacks->count() > 0)
                                            <div class="mt-3 bg-gray-50 rounded p-3 border-l-4 border-blue-400">
                                                <p class="text-xs font-medium text-gray-600 mb-2">💬 Feedback ({{ $report->feedbacks->count() }})</p>
                                                @foreach($report->feedbacks as $feedback)
                                                <div class="text-sm text-gray-700 mb-1">
                                                    <strong>{{ $feedback->user?->name }}</strong>: {{ $feedback->comment }}
                                                </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">Belum ada laporan progress untuk proyek ini.</p>
                    @endif
                </div>

                <!-- Peta Interaktif -->
                <div class="mt-8">
                    <h3 class="text-lg font-medium text-gray-900 mb-3">Lokasi Proyek</h3>
                    <div id="project-map" class="h-80 rounded-lg border"></div>
                </div>

                <div class="mt-8 flex gap-3">
                    <a href="{{ route('projects.index') }}" class="text-gray-600 hover:text-gray-900 font-medium">← Kembali ke Daftar</a>
                    @if(auth()->user()->role === 'admin')
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