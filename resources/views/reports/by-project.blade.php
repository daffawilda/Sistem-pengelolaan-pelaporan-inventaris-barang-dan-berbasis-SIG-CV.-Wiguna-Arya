<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Laporan Proyek: {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($reports->count())
                <div class="space-y-4">
                    @foreach($reports as $report)
                        <div class="bg-white rounded-lg shadow p-5">
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-500">
                                    {{ $report->report_date->format('d M Y') }}
                                </span>
                                @if($report->progress_percentage)
                                    <span class="px-2 py-0.5 bg-blue-100 text-blue-800 rounded text-sm">
                                        {{ $report->progress_percentage }}%
                                    </span>
                                @endif
                            </div>
                            @if($report->image)
                                <div class="mt-3">
                                    <img src="{{ $report->image_url() }}" class="max-w-32 rounded">
                                </div>
                            @endif
                            <p class="mt-2">{{ $report->description }}</p>
                            
                            @if(auth()->user()->role !== 'mandor')
                                <div class="mt-3">
                                    <a href="{{ route('reports.show', $report) }}" 
                                       class="text-blue-600 hover:underline text-sm">
                                        Lihat Detail & Feedback →
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">Belum ada laporan untuk proyek ini.</p>
            @endif

            <div class="mt-4">
                <a href="{{ route('reports.index') }}" class="text-gray-600 hover:underline">
                    ← Kembali ke Daftar Proyek
                </a>
            </div>
        </div>
    </div>
</x-app-layout>