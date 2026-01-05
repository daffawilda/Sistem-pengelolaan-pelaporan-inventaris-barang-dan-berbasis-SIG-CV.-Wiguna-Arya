<x-app-layout>
    <x-slot name="header">Laporan Progres Proyek</x-slot>
    <div class="p-6 max-w-3xl">
        <h2 class="text-lg font-medium mb-4">Proyek: {{ $project->name }}</h2>

        <form method="POST" action="{{ route('reports.store', $project) }}" enctype="multipart/form-data">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium">Persentase Progres (%)</label>
                    <input type="number" name="progress_percentage" min="0" max="100" class="w-full border rounded p-2" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Gambar Progres (Opsional)</label>
                    <input type="file" name="image" accept="image/*" class="mt-1 block w-full">
                </div>
                <div>
                    <label class="block text-sm font-medium">Deskripsi Progres</label>
                    <textarea name="description" rows="4" class="w-full border rounded p-2" required></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium">Tanggal Laporan</label>
                    <input type="date" name="report_date" class="w-full border rounded p-2" required>
                </div>
            </div>
            <div class="mt-6 flex gap-3">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Kirim Laporan</button>
                <a href="{{ route('projects.show', $project) }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>