<nav class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                    <span class="font-bold text-blue-700 text-xl">Wiguna<span class="text-gray-500">Arya</span></span>
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="flex items-center space-x-4">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-600 font-medium">Dashboard</a>

                <!-- Peta Proyek -->
                <a href="{{ route('projects.map') }}" class="text-gray-700 hover:text-blue-600 font-medium">Peta Proyek</a>

                <!-- Proyek (hanya untuk admin/pelaksana) -->
                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'pelaksana')
                    <a href="{{ route('projects.index') }}" class="text-gray-700 hover:text-blue-600 font-medium">Proyek</a>
                @endif
                <!-- Inventaris Alat (hanya untuk admin) -->
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('tools.index') }}" class="text-gray-700 hover:text-blue-600 font-medium">Inventaris Alat</a>
                @endif

                <!-- Peminjaman Alat (mandor & pelaksana) -->
                @if(auth()->user()->role === 'mandor' || auth()->user()->role === 'pelaksana' || auth()->user()->role === 'admin')
                    <a href="{{ route('borrowings.index') }}" class="text-gray-700 hover:text-blue-600 font-medium">Peminjaman Alat</a>
                @endif

                <!-- Laporan progress untuk mandor kepada pelaksana -->
                @if(auth()->user()->role === 'pelaksana')
                    <a href="{{ route('reports.index') }}" class="text-gray-700 hover:text-blue-600 font-medium">Laporan</a>
                @endif
                @if(auth()->user()->role === 'mandor')
                    <a href="{{ route('reports.index') }}" class="text-gray-700 hover:text-blue-600 font-medium">
                        Laporan Saya
                    </a>
                @endif
                @if(auth()->user()->role === 'pemilik')
                    <a href="{{ route('users.index') }}" class="text-gray-700 hover:text-blue-600 font-medium">
                        Kelola User
                    </a>
                @endif

                <!-- User Dropdown -->
                <div class="relative">
                    <button id="user-menu-button" class="flex items-center space-x-1 text-sm font-medium text-gray-700 hover:text-blue-600 focus:outline-none">
                        <span>{{ Auth::user()->name }}</span>
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div id="user-menu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                        <form method="POST" action="{{ route('logout') }}" class="block px-4 py-2">
                            @csrf
                            <button type="submit" class="w-full text-left text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const button = document.getElementById('user-menu-button');
            const menu = document.getElementById('user-menu');

            button.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });

            // Tutup dropdown saat klik di luar
            document.addEventListener('click', (e) => {
                if (!button.contains(e.target) && !menu.contains(e.target)) {
                    menu.classList.add('hidden');
                }
            });
        });
    </script>
</nav>