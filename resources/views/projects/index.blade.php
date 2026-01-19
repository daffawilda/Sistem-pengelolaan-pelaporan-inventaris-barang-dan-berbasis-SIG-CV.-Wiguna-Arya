<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Daftar Proyek</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Tombol Tambah (Hanya Admin/Pelaksana) -->
            @if(in_array(auth()->user()->role, ['admin']))
                <div class="mb-6 flex justify-end">
                    <a href="{{ route('projects.create') }}" 
                       class="inline-flex items-center px-4 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Tambah Proyek
                    </a>
                </div>
            @endif

            <!-- Tabel Proyek -->
            @if($projects->count())
                <div class="overflow-x-auto bg-white rounded-xl shadow-sm border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama Proyek</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Lokasi</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Mandor</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Pelaksana</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($projects as $p)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="font-medium text-gray-900">{{ $p->name }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-gray-600 text-sm">{{ $p->location }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2.5 py-0.5 text-xs font-medium rounded-full
                                        @if($p->status === 'selesai')
                                            bg-green-100 text-green-800
                                        @elseif($p->status === 'berjalan')
                                            bg-yellow-100 text-yellow-800
                                        @else
                                            bg-red-100 text-red-800
                                        @endif">
                                        {{ ucfirst($p->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-gray-600 text-sm">{{ $p->supervisor?->name ?? '–' }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-gray-600 text-sm">{{ $p->executor?->name ?? '–' }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-3">
                                    <a href="{{ route('projects.show', $p) }}" 
                                       class="text-blue-600 hover:text-blue-800">Lihat</a>
                                    @if(in_array(auth()->user()->role, ['admin']))
                                        <a href="{{ route('projects.edit', $p) }}" 
                                           class="text-yellow-600 hover:text-yellow-800">Edit</a>
                                        <form action="{{ route('projects.destroy', $p) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus proyek ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Belum ada proyek</h3>
                    <p class="mt-1 text-gray-500">Daftar proyek masih kosong.</p>
                    @if(in_array(auth()->user()->role, ['admin', 'pelaksana']))
                        <a href="{{ route('projects.create') }}" 
                           class="mt-4 inline-block text-blue-600 hover:text-blue-800 font-medium">
                            + Tambah Proyek Pertama
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
</x-app-layout>