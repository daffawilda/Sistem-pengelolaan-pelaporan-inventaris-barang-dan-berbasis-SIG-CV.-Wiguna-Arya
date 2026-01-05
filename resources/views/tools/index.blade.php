<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Inventaris Alat</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Tombol Tambah (Hanya Admin/Pelaksana) -->
            @if(in_array(auth()->user()->role, ['admin', 'pelaksana']))
                <div class="mb-6 flex justify-end">
                    <a href="{{ route('tools.create') }}" 
                       class="inline-flex items-center px-4 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Tambah Alat
                    </a>
                </div>
            @endif

            <!-- Tabel Inventaris -->
            @if($tools->count())
                <div class="overflow-x-auto bg-white rounded-xl shadow-sm border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama Alat</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Jenis</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Stok</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kondisi</th>
                                @if(in_array(auth()->user()->role, ['admin', 'pelaksana']))
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($tools as $tool)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="font-medium text-gray-900">{{ $tool->name }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2.5 py-0.5 text-xs font-medium rounded-full
                                        @if($tool->type === 'alat_kerja')
                                            bg-blue-100 text-blue-800
                                        @else
                                            bg-purple-100 text-purple-800
                                        @endif">
                                        {{ $tool->type === 'alat_kerja' ? 'Alat Kerja' : 'Alat Berat' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="font-semibold text-gray-900">{{ $tool->stock }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2.5 py-0.5 text-xs font-medium rounded-full
                                        @if($tool->condition === 'baik')
                                            bg-green-100 text-green-800
                                        @elseif($tool->condition === 'rusak')
                                            bg-red-100 text-red-800
                                        @else
                                            bg-yellow-100 text-yellow-800
                                        @endif">
                                        {{ ucfirst(str_replace('_', ' ', $tool->condition)) }}
                                    </span>
                                </td>
                                @if(in_array(auth()->user()->role, ['admin', 'pelaksana']))
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('tools.edit', $tool) }}" 
                                           class="text-blue-600 hover:text-blue-800 mr-4">Edit</a>
                                        <form action="{{ route('tools.destroy', $tool) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus alat ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Belum ada data alat</h3>
                    <p class="mt-1 text-gray-500">Inventaris alat masih kosong.</p>
                    @if(in_array(auth()->user()->role, ['admin', 'pelaksana']))
                        <a href="{{ route('tools.create') }}" 
                           class="mt-4 inline-block text-blue-600 hover:text-blue-800 font-medium">
                            + Tambah Alat Pertama
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
</x-app-layout>