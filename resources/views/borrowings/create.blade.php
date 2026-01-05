<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Pinjam Alat untuk Proyek</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <form method="POST" action="{{ route('borrowings.store') }}">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Alat -->
                        <div>
                            <label for="tool_id" class="block text-sm font-medium text-gray-700 mb-1">Alat *</label>
                            <select 
                                id="tool_id"
                                name="tool_id" 
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                                required>
                                <option value="">-- Pilih Alat --</option>
                                @foreach($tools as $t)
                                    @if($t->stock > 0)
                                        <option value="{{ $t->id }}">
                                            {{ $t->name }} (Stok: {{ $t->stock }})
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            <p class="mt-1 text-xs text-gray-500">Hanya menampilkan alat dengan stok tersedia</p>
                        </div>

                        <!-- Proyek -->
                        <div>
                            <label for="project_id" class="block text-sm font-medium text-gray-700 mb-1">Proyek *</label>
                            <select 
                                id="project_id"
                                name="project_id" 
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                                required>
                                <option value="">-- Pilih Proyek --</option>
                                @foreach($projects as $p)
                                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Jumlah -->
                        <div>
                            <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Jumlah *</label>
                            <input 
                                type="number" 
                                id="quantity"
                                name="quantity" 
                                min="1" 
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                                placeholder="1"
                                required>
                        </div>

                        <!-- Tanggal Pinjam -->
                        <div>
                            <label for="borrow_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pinjam *</label>
                            <input 
                                type="date" 
                                id="borrow_date"
                                name="borrow_date" 
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                                required>
                        </div>
                    </div>

                    <div class="mt-8 flex gap-3">
                        <button 
                            type="submit" 
                            class="flex-1 sm:flex-none px-5 py-2.5 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition shadow-sm">
                            Pinjam Alat
                        </button>
                        <a 
                            href="{{ route('borrowings.index') }}" 
                            class="flex-1 sm:flex-none px-5 py-2.5 bg-white text-gray-700 font-medium rounded-lg border border-gray-300 hover:bg-gray-50 focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition text-center">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>