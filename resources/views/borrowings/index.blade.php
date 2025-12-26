<x-app-layout>
    <x-slot name="header">Daftar Peminjaman Alat</x-slot>
    <div class="p-6">
        @if(auth()->user()->role === 'mandor' || auth()->user()->role === 'pelaksana' || auth()->user()->role === 'admin')
            <a href="{{ route('borrowings.create') }}" class="bg-blue-600 text-white px-3 py-2 rounded mb-4 inline-block">
                + Pinjam Alat
            </a>
        @endif

        <table class="min-w-full divide-y">
            <thead><tr>
                <th>Alat</th><th>Proyek</th><th>Peminjam</th><th>Jumlah</th><th>Status</th><th>Aksi</th>
            </tr></thead>
            <tbody>
                @foreach($borrowings as $b)
                <tr>
                    <td>{{ $b->tool->name }}</td>
                    <td>{{ $b->project->name }}</td>
                    <td>{{ $b->borrower->name }}</td>
                    <td>{{ $b->quantity }}</td>
                    <td>
                        @if($b->status === 'dipinjam')
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded">Dipinjam</span>
                        @else
                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded">Dikembalikan</span>
                        @endif
                    </td>
                    <td>
                        @if($b->status === 'dipinjam' && (auth()->id() === $b->borrower_id || auth()->user()->role === 'admin'))
                            <form action="{{ route('borrowings.return', $b->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-green-600 hover:underline">Kembalikan</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>