<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Tambah Alat Baru</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow p-6">
                <form action="{{ route('tools.store') }}" method="POST">
                    @csrf

                    <div class="space-y-6">
                        <!-- Nama Alat -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Alat *</label>
                            <input type="text" name="name" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" required>
                        </div>

                        <!-- Jenis Alat -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jenis Alat *</label>
                            <div class="mt-2 space-y-2">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="type" value="alat_kerja" class="text-blue-600" required>
                                    <span class="ml-2">Alat Kerja (contoh: sekop, palu)</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="type" value="alat_berat" class="text-blue-600" required>
                                    <span class="ml-2">Alat Berat (contoh: excavator, bulldozer)</span>
                                </label>
                            </div>
                        </div>

                        <!-- Stok -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Stok *</label>
                            <input type="number" name="stock" min="1" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" required>
                            <p class="text-xs text-gray-500 mt-1">Jumlah unit alat yang tersedia</p>
                        </div>

                        <!-- Kondisi -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kondisi *</label>
                            <select name="condition" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" required>
                                <option value="baik">Baik</option>
                                <option value="rusak">Rusak</option>
                                <option value="perlu_perbaikan">Perlu Perbaikan</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-6 flex gap-3">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan Alat</button>
                        <a href="{{ route('tools.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>