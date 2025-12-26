<x-app-layout>
    <x-slot name="header">Tambah User Baru</x-slot>
    <div class="p-6 max-w-2xl">
        <form method="POST" action="{{ route('users.store') }}">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium">Nama Lengkap</label>
                    <input type="text" name="name" class="w-full border rounded p-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium">Email</label>
                    <input type="email" name="email" class="w-full border rounded p-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium">Peran</label>
                    <select name="role" class="w-full border rounded p-2" required>
                        <option value="admin">Admin</option>
                        <option value="pelaksana">Pelaksana</option>
                        <option value="mandor">Mandor</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium">Password</label>
                    <input type="password" name="password" class="w-full border rounded p-2" required minlength="6">
                </div>
                <div>
                    <label class="block text-sm font-medium">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="w-full border rounded p-2" required>
                </div>
            </div>
            <div class="mt-6 flex gap-3">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan User</button>
                <a href="{{ route('users.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>