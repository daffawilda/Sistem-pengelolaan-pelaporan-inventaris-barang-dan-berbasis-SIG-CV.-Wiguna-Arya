<x-app-layout>
    <x-slot name="header">Manajemen User</x-slot>
    <div class="p-6">
        <a href="{{ route('users.create') }}" class="bg-blue-600 text-white px-3 py-2 rounded mb-4 inline-block">
            + Tambah User
        </a>
        <table class="min-w-full divide-y">
            <thead><tr>
                <th>Nama</th><th>Email</th><th>Peran</th><th>aksi</th>
            </tr></thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <span class="px-2 py-1 rounded text-xs
                            @if($user->role === 'admin') bg-purple-100 text-purple-800
                            @elseif($user->role === 'pelaksana') bg-green-100 text-green-800
                            @else bg-yellow-100 text-yellow-800 @endif">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td>
                        <div>
                            <!-- Aksi seperti edit atau hapus bisa ditambahkan di sini -->
                            <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                            </form>
                            <a href="{{ route('users.edit', $user) }}" class="text-green-600 hover:underline">Edit</a>

                        </div>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>