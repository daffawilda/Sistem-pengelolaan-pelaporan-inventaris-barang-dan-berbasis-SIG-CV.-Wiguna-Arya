<x-app-layout>
    <x-slot name="header">Detail Laporan Progres</x-slot>
    <div class="p-6 max-w-3xl">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold">{{ $report->project->name }}</h2>
            <p class="text-gray-600">Mandor: {{ $report->reporter->name }}</p>
            
            <div class="mt-4">
                <label class="block text-sm font-medium">Persentase Progres</label>
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $report->progress_percentage }}%"></div>
                </div>
                <span class="text-sm">{{ $report->progress_percentage }}%</span>
            </div>

            <div class="mt-4">
                <label class="block text-sm font-medium">Deskripsi</label>
                <p class="mt-1">{{ $report->description }}</p>
            </div>

            <div class="mt-4">
                <label class="block text-sm font-medium">Tanggal Laporan</label>
                <p class="mt-1">{{ $report->report_date->format('d M Y') }}</p>
            </div>

            <div class="mt-6">
                <a href="{{ route('reports.index') }}" class="text-blue-600 hover:underline">← Kembali ke Daftar</a>
            </div>
        </div>
    </div>
</x-app-layout>