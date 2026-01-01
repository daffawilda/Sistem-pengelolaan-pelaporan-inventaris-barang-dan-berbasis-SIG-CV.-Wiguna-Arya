<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Edit Proyek</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow p-6">
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-100 text-red-800 rounded">
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="mt-2 list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('projects.update', $project) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Nama Proyek & Lokasi -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Proyek *</label>
                            <input type="text" name="name" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" value="{{ old('name', $project->name) }}" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Lokasi *</label>
                            <input type="text" name="location" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" value="{{ old('location', $project->location) }}" required>
                        </div>
                    </div>

                    <!-- PETA UNTUK PIN POINT -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Tentukan Lokasi Proyek di Peta *
                        </label>
                        <div id="project-map" class="w-full h-[400px] rounded-lg border border-gray-300 shadow-sm"></div>
                        <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', $project->latitude) }}" required>
                        <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', $project->longitude) }}" required>
                        <p class="mt-2 text-sm text-gray-600">
                            Klik di peta untuk memperbarui lokasi proyek. Marker akan muncul secara otomatis.
                        </p>
                    </div>

                    <!-- Status, Mandor, Pelaksana -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" required>
                                <option value="berjalan" {{ old('status', $project->status) == 'berjalan' ? 'selected' : '' }}>Berjalan</option>
                                <option value="tertunda" {{ old('status', $project->status) == 'tertunda' ? 'selected' : '' }}>Tertunda</option>
                                <option value="selesai" {{ old('status', $project->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Mandor</label>
                            <select name="supervisor_id" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" required>
                                @foreach($supervisors as $s)
                                    <option value="{{ $s->id }}" {{ old('supervisor_id', $project->supervisor_id) == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Pelaksana</label>
                            <select name="executor_id" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" required>
                                @foreach($executors as $e)
                                    <option value="{{ $e->id }}" {{ old('executor_id', $project->executor_id) == $e->id ? 'selected' : '' }}>{{ $e->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Tombol Simpan & Batal -->
                    <div class="mt-6 flex gap-3">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan Perubahan</button>
                        <a href="{{ route('projects.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const map = L.map('project-map').setView([-6.8000, 111.0000], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            let marker = null;
            const latInput = document.getElementById('latitude');
            const lngInput = document.getElementById('longitude');

            // Tampilkan marker dari koordinat yang sudah ada
            if (latInput.value && lngInput.value) {
                const lat = parseFloat(latInput.value);
                const lng = parseFloat(lngInput.value);
                marker = L.marker([lat, lng]).addTo(map);
                map.setView([lat, lng], 15);
            }

            // Klik peta → perbarui marker dan koordinat
            map.on('click', function(e) {
                const lat = e.latlng.lat;
                const lng = e.latlng.lng;

                if (marker) map.removeLayer(marker);
                marker = L.marker([lat, lng]).addTo(map);

                latInput.value = lat;
                lngInput.value = lng;
            });
        });
    </script>
    @endpush
</x-app-layout> 