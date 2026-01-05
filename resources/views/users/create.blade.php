<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Tambah User Baru</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <form method="POST" action="{{ route('users.store') }}">
                    @csrf

                    <div class="space-y-6">
                        <!-- Nama Lengkap -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap *</label>
                            <input 
                                type="text" 
                                id="name"
                                name="name" 
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                                placeholder="Contoh: Budi Santoso"
                                required>
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                            <input 
                                type="email" 
                                id="email"
                                name="email" 
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                                placeholder="user@wigunaarya.co.id"
                                required>
                        </div>

                        <!-- Peran -->
                        <div>
                            <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Peran *</label>
                            <select 
                                id="role"
                                name="role" 
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                                required>
                                <option value="">-- Pilih Peran --</option>
                                <option value="admin">Admin</option>
                                <option value="pelaksana">Pelaksana</option>
                                <option value="mandor">Mandor</option>
                            </select>
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password *</label>
                            <input 
                                type="password" 
                                id="password"
                                name="password" 
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                                minlength="6"
                                placeholder="Minimal 6 karakter"
                                required>
                            <p class="mt-1 text-xs text-gray-500">Password minimal 6 karakter</p>
                        </div>

                        <!-- Konfirmasi Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password *</label>
                            <input 
                                type="password" 
                                id="password_confirmation"
                                name="password_confirmation" 
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                                required>
                        </div>
                    </div>

                    <div class="mt-8 flex gap-3">
                        <button 
                            type="submit" 
                            class="flex-1 sm:flex-none px-5 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition shadow-sm">
                            Simpan User
                        </button>
                        <a 
                            href="{{ route('users.index') }}" 
                            class="flex-1 sm:flex-none px-5 py-2.5 bg-white text-gray-700 font-medium rounded-lg border border-gray-300 hover:bg-gray-50 focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition text-center">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>