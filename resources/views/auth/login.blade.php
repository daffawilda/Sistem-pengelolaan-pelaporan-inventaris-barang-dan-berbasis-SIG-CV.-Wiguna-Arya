<x-guest-layout>
    <style>
        .login-bg {
            background-image: url('/image/hero.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
    </style>

    <div class="min-h-screen login-bg flex flex-col justify-center items-center px-4 py-8">
        
        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-orange-600 rounded-2xl shadow-xl mb-4">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-black tracking-tighter text-white uppercase italic">
                CV. <span class="text-orange-500">Wiguna Arya</span>
            </h2>
        </div>

        <div class="w-full sm:max-w-md px-6 py-10 glass-card shadow-2xl rounded-[2.5rem] border border-white/20">
            
            <div class="text-center mb-8">
                <h1 class="text-xl font-extrabold text-slate-900 tracking-widest uppercase">Portal Internal</h1>
                <p class="text-xs font-medium text-slate-500 mt-1 uppercase tracking-tighter">Manajemen Proyek & Inventaris</p>
                <div class="w-10 h-1 bg-orange-600 mx-auto mt-4 rounded-full"></div>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />
            @if($errors->any())
                <div class="mb-4 p-3 bg-red-50 border-l-4 border-red-500 text-red-700 text-xs rounded-r-lg">
                    Email atau password salah.
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-widest mb-1 ml-1">Email Karyawan</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </span>
                        <input type="email" name="email" required autofocus class="w-full pl-10 pr-4 py-3 bg-slate-50 border-slate-200 rounded-xl text-sm focus:ring-orange-500 focus:border-orange-500 transition-all shadow-sm" placeholder="nama@wigunaarya.co.id">
                    </div>
                </div>

                <div class="mt-4">
                    <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-widest mb-1 ml-1">Kata Sandi</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </span>
                        <input type="password" name="password" required class="w-full pl-10 pr-4 py-3 bg-slate-50 border-slate-200 rounded-xl text-sm focus:ring-orange-500 focus:border-orange-500 transition-all shadow-sm" placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-center justify-between px-1">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="rounded border-slate-300 text-orange-600 focus:ring-orange-500">
                        <span class="ml-2 text-[10px] font-bold text-slate-600 uppercase tracking-tighter italic">Ingat Saya</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-[10px] font-bold text-orange-600 uppercase tracking-tighter hover:underline">Lupa Sandi?</a>
                    @endif
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-slate-900 hover:bg-orange-600 text-white py-4 rounded-2xl font-black text-xs tracking-[0.2em] transition-all transform active:scale-95 shadow-lg shadow-slate-200 uppercase">
                        Masuk Ke Sistem
                    </button>
                </div>
            </form>

            <div class="mt-8 pt-6 border-t border-slate-100 text-center">
                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">
                    &copy; 2026 CV. Wiguna Arya <br>
                    <span class="text-slate-300 italic">Internal Management System</span>
                </p>
            </div>
        </div>

        <a href="/" class="mt-8 flex items-center text-white/70 hover:text-white transition-colors text-[10px] font-bold uppercase tracking-widest bg-white/10 px-6 py-2 rounded-full backdrop-blur-sm border border-white/10">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Beranda
        </a>
    </div>
</x-guest-layout>