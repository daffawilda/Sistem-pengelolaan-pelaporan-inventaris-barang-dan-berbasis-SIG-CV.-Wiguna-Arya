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

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Proyek -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Proyek *</label>
                            <input type="text" name="name" value="{{ old('name', $project->name) }}" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" required>
                        </div>

                        <!-- Lokasi -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Lokasi (Alamat) *</label>
                            <input type="number" name="location" value="{{ old('location', $project->location) }}" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" required>
                        </div>

                        <!-- Latitude -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Latitude *</label>
                            <input type="text" step="any" name="latitude" value="{{ old('latitude', $project->latitude) }}" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" required>
                            <p class="text-xs text-gray-500 mt-1">Contoh: -6.8083</p>
                        </div>

                        <!-- Longitude -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Longitude *</label>
                            <input type="text" step="any" name="longitude" value="{{ old('longitude', $project->longitude) }}" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" required>
                            <p class="text-xs text-gray-500 mt-1">Contoh: 111.0071</p>
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status *</label>
                            <select name="status" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" required>
                                <option value="berjalan" {{ old('status', $project->status) == 'berjalan' ? 'selected' : '' }}>Berjalan</option>
                                <option value="tertunda" {{ old('status', $project->status) == 'tertunda' ? 'selected' : '' }}>Tertunda</option>
                                <option value="selesai" {{ old('status', $project->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>

                        <!-- Mandor -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Mandor (Supervisor) *</label>
                            <select name="supervisor_id" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" required>
                                <option value="">-- Pilih Mandor --</option>
                                @foreach($supervisors as $mandor)
                                    <option value="{{ $mandor->id }}" {{ old('supervisor_id', $project->supervisor_id) == $mandor->id ? 'selected' : '' }}>
                                        {{ $mandor->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Pelaksana -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Pelaksana *</label>
                            <select name="executor_id" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" required>
                                <option value="">-- Pilih Pelaksana --</option>
                                @foreach($executors as $pelaksana)
                                    <option value="{{ $pelaksana->id }}" {{ old('executor_id', $project->executor_id) == $pelaksana->id ? 'selected' : '' }}>
                                        {{ $pelaksana->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mt-6 flex gap-3">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan Perubahan</button>
                        <a href="{{ route('projects.show', $project) }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>