<!-- resources/views/layouts/sidebar.blade.php -->
<div class="w-64 bg-gray-800 text-white fixed h-full overflow-y-auto pt-6 hidden lg:block">
    <div class="px-6 mb-8">
        <h1 class="text-xl font-bold">CV. Wiguna Arya</h1>
        <p class="text-gray-400 text-sm">Sistem Proyek & Inventaris</p>
    </div>

    <nav class="px-4 space-y-2">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}" 
           class="flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-gray-700 {{ request()->routeIs('dashboard') ? 'bg-gray-700' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
            </svg>
            Dashboard
        </a>

        <!-- Proyek -->
        <a href="{{ route('projects.index') }}" 
           class="flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-gray-700 {{ request()->routeIs('projects') ? 'bg-gray-700' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
            </svg>
            Proyek
        </a>

        <!-- Peta (SIG) -->
        <a href="{{ route('projects.map') }}" 
           class="flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-gray-700 {{ request()->routeIs('projects.map') ? 'bg-gray-700' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
            </svg>
            Peta Proyek
        </a>
        @if (auth()->user()->role === 'admin')
            <!-- Inventaris Alat -->
            <a href="{{ route('tools.index') }}" 
            class="flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-gray-700 {{ request()->routeIs('tools.*') ? 'bg-gray-700' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M8 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" />
                <path d="M6 3a2 2 0 00-2 2v11a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2 3 3 0 01-3 3H9a3 3 0 01-3-3z" />
            </svg>
            Inventaris Alat
            </a>
         @endif

        <!-- Peminjaman Alat -->
        <a href="{{ route('borrowings.index') }}" 
           class="flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-gray-700 {{ request()->routeIs('tool-borrowings.*') ? 'bg-gray-700' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
            </svg>
            Peminjaman Alat
        </a>

        <!-- Laporan Progres -->
        @if(auth()->user()->role === 'pelaksana' || auth()->user()->role === 'mandor'  || auth()->user()->role === 'admin')
            <a href="{{ route('reports.index') }}" 
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-gray-700 {{ request()->routeIs('reports.*') ? 'bg-gray-700' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11 6a1 1 0 10-2 0v2a1 1 0 102 0v-2zm-4 0a1 1 0 10-2 0v2a1 1 0 102 0v-2z" clip-rule="evenodd" />
                </svg>
                Laporan Progres
            </a>
        @endif

        <!-- Kelola User (Hanya Pemilik) -->
        @if(auth()->user()->role === 'admin')
            <a href="{{ route('users.index') }}" 
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-gray-700 {{ request()->routeIs('users.*') ? 'bg-gray-700' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                </svg>
                Kelola User
            </a>
        @endif

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}" class="mt-6">
            @csrf
            <button type="submit" class="flex items-center gap-3 w-full px-4 py-2.5 text-left text-red-300 hover:bg-red-900 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
                </svg>
                Logout
            </button>
        </form>
    </nav>
</div>