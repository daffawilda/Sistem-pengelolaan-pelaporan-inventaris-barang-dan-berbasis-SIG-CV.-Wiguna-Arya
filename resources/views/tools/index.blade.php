<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Inventaris Alat</h2>
    </x-slot>

    <div class="p-6">
        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'pelaksana')
            <a href="{{ route('tools.create') }}" class="bg-blue-600 text-white px-3 py-2 rounded mb-4 inline-block">
                + Tambah Alat
            </a>
        @endif

        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stok</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kondisi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($tools as $tool)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $tool->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $tool->type === 'alat_kerja' ? 'Alat Kerja' : 'Alat Berat' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $tool->stock }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($tool->condition) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap space-x-3">
                            @if(auth()->user()->role === 'admin' || auth()->user()->role === 'pelaksana')
                                <a href="{{ route('tools.edit', $tool) }}" class="text-green-600 hover:underline">Edit</a>
                                <form action="{{ route('tools.destroy', $tool) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus alat ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>