<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Edit User</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow p-6">
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-100 text-red-800 rounded">
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="mt-2 list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('users.update', $user) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Lengkap *</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email *</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" required>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Peran *</label>
                            <select name="role" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" required>
                                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="pelaksana" {{ old('role', $user->role) === 'pelaksana' ? 'selected' : '' }}>Pelaksana</option>
                                <option value="mandor" {{ old('role', $user->role) === 'mandor' ? 'selected' : '' }}>Mandor</option>
                            </select>
                            @error('role')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Password Baru <span class="text-gray-500">(kosongkan jika tidak diubah)</span></label>
                            <input type="password" name="password" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" minlength="6">
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2">
                        </div>
                    </div>

                    <div class="mt-6 flex gap-3">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan Perubahan</button>
                        <a href="{{ route('users.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>