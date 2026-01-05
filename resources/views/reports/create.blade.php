<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Laporan Progres Proyek</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-5">Proyek: {{ $project->name }}</h2>
                <!-- Tambahkan di bawah <div class="bg-white ..."> -->
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg">
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="mt-2 list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('reports.store', $project) }}" enctype="multipart/form-data">
                    @csrf

                    <div class="space-y-6">
                        <!-- Persentase Progres -->
                        <div>
                            <label for="progress_percentage" class="block text-sm font-medium text-gray-700 mb-1">
                                Persentase Progres (%)*
                            </label>
                            <input 
                                type="number" 
                                id="progress_percentage"
                                name="progress_percentage" 
                                min="0" 
                                max="100" 
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition"
                                placeholder="Contoh: 25"
                                required>
                        </div>

                        <!-- Gambar Progres -->
                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-1">
                                Gambar Progres (Opsional)
                            </label>
                            <input 
                                type="file" 
                                id="image"
                                name="image" 
                                accept="image/*" 
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition">
                            <p class="mt-1 text-xs text-gray-500">
                                Format: JPEG, PNG, maks. 2MB. Gambar akan ditampilkan di laporan.
                            </p>
                        </div>

                        <!-- Deskripsi Progres -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                                Deskripsi Progres*
                            </label>
                            <textarea 
                                id="description"
                                name="description" 
                                rows="4" 
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition"
                                placeholder="Jelaskan pekerjaan yang telah dilakukan hari ini..."
                                required></textarea>
                        </div>

                        <!-- Tanggal Laporan -->
                        <div>
                            <label for="report_date" class="block text-sm font-medium text-gray-700 mb-1">
                                Tanggal Laporan*
                            </label>
                            <input 
                                type="date" 
                                id="report_date"
                                name="report_date" 
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition"
                                value="{{ old('report_date', date('Y-m-d')) }}"
                                required>
                        </div>
                    </div>

                    <div class="mt-8 flex gap-3">
                        <button 
                            type="submit" 
                            class="flex-1 sm:flex-none px-5 py-2.5 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition shadow-sm">
                            Kirim Laporan
                        </button>
                        <a 
                            href="{{ route('projects.show', $project) }}" 
                            class="flex-1 sm:flex-none px-5 py-2.5 bg-white text-gray-700 font-medium rounded-lg border border-gray-300 hover:bg-gray-50 focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition text-center">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>