<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            @if(auth()->user()->role === 'mandor')
                Laporan Progres Saya
            @elseif(auth()->user()->role === 'admin')
                Semua Laporan Proyek
            @else
                Laporan Proyek Saya
            @endif
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- TOMBOL TAMBAH LAPORAN (Hanya untuk Mandor) -->
            @if(auth()->user()->role === 'mandor')
                <div class="mb-6 flex justify-end">
                    <button type="button" onclick="openProjectModal()"
                            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 font-medium">
                        + Tambah Laporan Progres
                    </button>
                </div>

                <!-- Modal Pemilihan Proyek -->
                <div id="projectModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                    <div class="bg-white rounded-lg p-6 w-full max-w-md">
                        <h3 class="text-lg font-bold mb-4">Pilih Proyek untuk Laporan</h3>
                        @if(isset($myProjects) && $myProjects->count())
                            <ul class="space-y-2">
                                @foreach($myProjects as $project)
                                    <li>
                                        <a href="{{ route('reports.create', $project) }}"
                                           class="block p-3 bg-gray-100 rounded hover:bg-gray-200">
                                            {{ $project->name }}
                                            <span class="text-sm text-gray-600 block">{{ $project->location }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-500">Anda belum ditugaskan ke proyek mana pun.</p>
                        @endif
                        <button type="button" onclick="closeProjectModal()"
                                class="mt-4 text-gray-600 hover:text-gray-800">
                            Tutup
                        </button>
                    </div>
                </div>

                <script>
                    function openProjectModal() {
                        document.getElementById('projectModal').classList.remove('hidden');
                    }
                    function closeProjectModal() {
                        document.getElementById('projectModal').classList.add('hidden');
                    }
                </script>
            @endif

            <!-- TAMPILAN PER PROYEK (1 LAPORAN TERBARU) -->
            @if(isset($latestReports) && $latestReports->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($latestReports as $report)
                        <a href="{{ route('reports.by-project', $report->project) }}" class="block">
                            <div class="bg-white rounded-lg shadow p-5 hover:shadow-md transition">
                                <h3 class="font-bold text-gray-900">{{ $report->project->name }}</h3>
                                <p class="text-sm text-gray-600 mt-1">{{ $report->project->location }}</p>

                                @if($report->progress_percentage !== null)
                                    <div class="mt-3">
                                        <div class="flex items-center">
                                            <div class="w-full bg-gray-200 rounded-full h-2 mr-2">
                                                <div class="bg-blue-600 h-2 rounded-full"
                                                     style="width: {{ $report->progress_percentage }}%"></div>
                                            </div>
                                            <span class="text-sm font-medium ml-2">{{ $report->progress_percentage }}%</span>
                                        </div>
                                    </div>
                                @endif

                                <p class="mt-2 text-sm text-gray-800 line-clamp-2">
                                    {{ $report->description }}
                                </p>

                                <p class="mt-2 text-xs text-gray-500">
                                    {{ $report->report_date->format('d M Y') }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-lg shadow p-6 text-center">
                    <p class="text-gray-500">
                        @if(auth()->user()->role === 'mandor')
                            Anda belum mengirim laporan untuk proyek mana pun.
                        @else
                            Belum ada laporan progres dari mandor.
                        @endif
                    </p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>