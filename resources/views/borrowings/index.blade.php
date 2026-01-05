<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Daftar Peminjaman Alat</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Tombol Pinjam Alat (untuk mandor, pelaksana, admin) -->
            @if(in_array(auth()->user()->role, ['mandor', 'pelaksana', 'admin']))
                <div class="mb-6 flex justify-end">
                    <a href="{{ route('borrowings.create') }}" 
                       class="inline-flex items-center px-4 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                        </svg>
                        Pinjam Alat
                    </a>
                </div>
            @endif

            <!-- Tabel Peminjaman -->
            @if($borrowings->count())
                <div class="overflow-x-auto bg-white rounded-xl shadow-sm border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Alat</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Proyek</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Peminjam</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Jumlah</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($borrowings as $b)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="font-medium text-gray-900">{{ $b->tool->name }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-800">{{ $b->project->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-800">{{ $b->borrower->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-900 font-medium">{{ $b->quantity }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($b->status === 'dipinjam')
                                        <span class="px-2.5 py-0.5 bg-yellow-100 text-yellow-800 text-xs font-medium rounded-full">
                                            Dipinjam
                                        </span>
                                    @else
                                        <span class="px-2.5 py-0.5 bg-green-100 text-green-800 text-xs font-medium rounded-full">
                                            Dikembalikan
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    @if($b->status === 'dipinjam' && (auth()->id() === $b->borrower_id || auth()->user()->role === 'admin'))
                                        <form action="{{ route('borrowings.return', $b->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin mengembalikan alat ini?');">
                                            @csrf
                                            <button type="submit" class="text-green-600 hover:text-green-800 flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                </svg>
                                                Kembalikan
                                            </button>
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m16 10v-6" />
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Belum ada peminjaman alat</h3>
                    <p class="mt-1 text-gray-500">Tidak ada riwayat peminjaman yang ditemukan.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>