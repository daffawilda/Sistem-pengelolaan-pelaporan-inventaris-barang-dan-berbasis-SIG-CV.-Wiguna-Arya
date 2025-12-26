<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Daftar Proyek</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-900">Data Proyek</h3>
                    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'pelaksana')
                        <a href="{{ route('projects.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">
                            + Tambah Proyek
                        </a>
                    @endif
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Lokasi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mandor</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pelaksana</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($projects as $p)
                            <tr>
                                <td class="px-6 py-4 font-medium">{{ $p->name }}</td>
                                <td class="px-6 py-4 text-sm">{{ $p->location }}</td>
                                <td class="px-6 py-4">
                                    @if($p->status === 'selesai')
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs">Selesai</span>
                                    @elseif($p->status === 'berjalan')
                                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-xs">Berjalan</span>
                                    @else
                                        <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-xs">Tertunda</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm">{{ $p->supervisor?->name ?? '–' }}</td>
                                <td class="px-6 py-4 text-sm">{{ $p->executor?->name ?? '–' }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('projects.show', $p) }}" class="text-blue-600 hover:underline text-sm">Lihat</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>