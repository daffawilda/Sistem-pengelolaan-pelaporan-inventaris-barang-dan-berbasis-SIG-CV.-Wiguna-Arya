<x-guest-layout>
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-900">CV. <span class="text-blue-700">Wiguna Arya</span></h1>
            <p class="text-sm text-gray-600 mt-1">Login Internal Sistem Informasi</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4 p-3 bg-green-100 text-green-800 text-sm rounded" :status="session('status')" />

        <!-- Error Umum -->
        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-800 text-sm rounded">
                Email atau password salah.
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-gray-800" />
                <x-text-input
                    id="email"
                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autofocus
                    autocomplete="username"
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" class="text-gray-800" />
                <x-text-input
                    id="password"
                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm" />
            </div>

            <div class="flex items-center justify-end mt-6">
                <x-primary-button class="w-full bg-blue-700 hover:bg-blue-800 py-2 px-4 rounded-md font-medium">
                    {{ __('MASUK') }}
                </x-primary-button>
            </div>

            <div class="mt-6 text-center text-xs text-gray-500">
                &copy; {{ date('Y') }} CV. Wiguna Arya<br>
                Sistem Informasi Manajemen Proyek & Inventaris
            </div>
        </form>
    </div>
</x-guest-layout>