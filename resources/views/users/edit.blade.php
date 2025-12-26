<x-app-layout>
    <x-slot name="header">Edit User</x-slot>
    <div class="p-6 max-w-2xl">
        <form method="POST" action="{{ route('users.update', $user) }}">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border rounded p-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border rounded p-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium">Peran</label>
                    <select name="role" class="w-full border rounded p-2" required>
                        <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="pelaksana" {{ old('role', $user->role) === 'pelaksana' ? 'selected' : '' }}>Pelaksana</option>
                        <option value="mandor" {{ old('role', $user->role) === 'mandor' ? 'selected' : '' }}>Mandor</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium">Password Baru (kosongkan jika tidak diubah)</label>
                    <input type="password" name="password" class="w-full border rounded p-2" minlength="6">
                </div>
                <div>
                    <label class="block text-sm font-medium">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" class="w-full border rounded p-2">
                </div>
            </div>
            <div class="mt-6 flex gap-3">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Perubahan</button>
                <a href="{{ route('users.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>