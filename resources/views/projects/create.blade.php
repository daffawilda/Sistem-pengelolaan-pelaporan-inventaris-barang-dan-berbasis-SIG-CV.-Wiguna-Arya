<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Tambah Proyek Baru</h2>
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
                <form action="{{ route('projects.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Proyek *</label>
                            <input type="text" name="name" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Lokasi *</label>
                            <input type="text" name="location" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Latitude *</label>
                            <input type="number" step="any" name="latitude" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Longitude *</label>
                            <input type="number" step="any" name="longitude" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" required>
                                <option value="berjalan">Berjalan</option>
                                <option value="tertunda">Tertunda</option>
                                <option value="selesai">Selesai</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Mandor</label>
                            <select name="supervisor_id" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" required>
                                @foreach($supervisors as $s)
                                    <option value="{{ $s->id }}">{{ $s->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Pelaksana</label>
                            <select name="executor_id" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" required>
                                @foreach($executors as $e)
                                    <option value="{{ $e->id }}">{{ $e->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mt-6 flex gap-3">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
                        <a href="{{ route('projects.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>