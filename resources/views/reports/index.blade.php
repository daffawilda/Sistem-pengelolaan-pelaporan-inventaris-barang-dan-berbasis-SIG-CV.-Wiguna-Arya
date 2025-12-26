<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            @if(auth()->user()->role === 'mandor')
                Laporan Progres Saya
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
                    @if($myProjects->count())
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
            @if($reports->count())
                <div class="space-y-4">
                    @foreach($reports as $report)
                        <div class="bg-white rounded-lg shadow p-5">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-bold text-gray-900">{{ $report->project->name }}</h3>
                                    @if(auth()->user()->role === 'pelaksana')
                                        <p class="text-sm text-gray-600">Mandor: {{ $report->reporter->name }}</p>
                                    @endif
                                </div>
                                <span class="text-sm text-gray-500">
                                    {{ $report->report_date->format('d M Y') }}
                                </span>
                            </div>

                            <div class="mt-3">
                                <div class="flex items-center">
                                    <div class="w-40 bg-gray-200 rounded-full h-2 mr-2">
                                        <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $report->progress_percentage }}%"></div>
                                    </div>
                                    <span class="text-sm font-medium">{{ $report->progress_percentage }}%</span>
                                </div>
                            </div>

                            <p class="mt-3 text-gray-800">{{ $report->description }}</p>
                             @if(auth()->user()->role === 'pelaksana')
                                <div class="text-right mt-2">
                                    <a href="{{ route('reports.show', $report) }}" 
                                        class="text-blue-600 hover:underline text-sm">
                                        Lihat Detail →
                                    </a>
                                </div>
                             @endif
                        </div>
                       
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-lg shadow p-6 text-center">
                    <p class="text-gray-500">
                        @if(auth()->user()->role === 'mandor')
                            Belum ada laporan progres yang dikirim.
                        @else
                            Belum ada laporan dari mandor.
                        @endif
                    </p>
                    @if(auth()->user()->role === 'mandor')
                        <a href="{{ route('projects.index') }}" class="text-blue-600 hover:underline mt-2 inline-block">
                            Lihat proyek untuk kirim laporan
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
</x-app-layout>