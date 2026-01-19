<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="CV. Wiguna Arya – Perusahaan Konstruksi & Pembangunan di Kudus, Jawa Tengah. Manajemen proyek dan inventaris alat konstruksi." />
    <title>CV. Wiguna Arya – Perusahaan Konstruksi & Pembangunan</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #f8fafc;
        }

        /* Hero Section Styling */
        .construction-hero {
            background-image: url('/image/hero.jpg'); 
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .hero-overlay {
            background: linear-gradient(to right, rgba(15, 23, 42, 0.9) 0%, rgba(15, 23, 42, 0.4) 100%);
        }

        #map { height: 450px; border-radius: 1rem; }

        .glass-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .nav-link {
            position: relative;
            transition: color 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 0;
            background-color: #ea580c;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }
    </style>
</head>
<body class="text-slate-900 antialiased">

    <header class="sticky top-0 z-[1000] bg-white/80 backdrop-blur-md border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3 group">
                <div class="w-11 h-11 bg-orange-600 rounded-xl flex items-center justify-center shadow-lg shadow-orange-200 group-hover:rotate-12 transition-transform">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                <div class="flex flex-col leading-none">
                    <span class="font-extrabold text-xl tracking-tight text-slate-900 uppercase">CV. <span class="text-orange-600">Wiguna Arya</span></span>
                    <span class="text-[10px] text-slate-500 font-bold tracking-[0.2em] uppercase">Construction & Engineering</span>
                </div>
            </div>
            
            <nav class="hidden md:flex items-center space-x-8">
                <a href="#proyek" class="nav-link text-sm font-bold text-slate-600 hover:text-orange-600 uppercase tracking-wider">Proyek</a>
                <a href="#peta" class="nav-link text-sm font-bold text-slate-600 hover:text-orange-600 uppercase tracking-wider">Peta SIG</a>
                <a href="#inventaris" class="nav-link text-sm font-bold text-slate-600 hover:text-orange-600 uppercase tracking-wider">Inventaris</a>
                <a href="/login" class="bg-slate-900 text-white px-6 py-2.5 rounded-full text-sm font-bold hover:bg-orange-600 transition-all shadow-md shadow-slate-200">
                    LOGIN PORTAL
                </a>
            </nav>

            <button class="md:hidden p-2 text-slate-600" onclick="toggleMenu()">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
            </button>
        </div>
    </header>

    <section class="construction-hero relative min-h-[90vh] flex items-center overflow-hidden">
        <div class="absolute inset-0 hero-overlay"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="max-w-3xl space-y-8">
                <div class="inline-flex items-center space-x-3 bg-orange-600/20 border border-orange-500/30 px-4 py-2 rounded-full">
                    <span class="relative flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-orange-500"></span>
                    </span>
                    <span class="text-xs font-black tracking-[0.1em] uppercase text-orange-400">Main Contractor & Developer</span>
                </div>

                <h1 class="text-5xl md:text-7xl font-extrabold text-white leading-[1.1]">
                    Membangun Fondasi <br> 
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-amber-400">Masa Depan Anda</span>
                </h1>
                
                <p class="text-lg md:text-xl text-slate-300 max-w-2xl leading-relaxed">
                    Menghadirkan keunggulan teknik dan integritas di setiap struktur. Spesialis konstruksi terpercaya untuk pembangunan di wilayah Grobogan dan sekitarnya.
                </p>

                <div class="flex flex-wrap gap-5 pt-4">
                    <a href="#proyek" class="bg-orange-600 hover:bg-orange-700 text-white px-10 py-4 rounded-xl font-extrabold transition-all transform hover:-translate-y-1 shadow-2xl shadow-orange-900/20 flex items-center space-x-3">
                        <span>LIHAT PORTOFOLIO</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                    <a href="#inventaris" class="glass-card text-white px-10 py-4 rounded-xl font-extrabold hover:bg-white/10 transition-all border border-white/20">
                        CEK ALAT BERAT
                    </a>
                </div>

                <div class="grid grid-cols-3 gap-8 pt-12 border-t border-white/10">
    <div>
        <p class="text-3xl font-bold text-white">
            {{ $stats['total_projects'] }}+
        </p>
        <p class="text-xs font-bold text-orange-500 uppercase tracking-widest">Proyek</p>
    </div>

    <div>
        <p class="text-3xl font-bold text-white">
            {{ $stats['total_tools'] }}+
        </p>
        <p class="text-xs font-bold text-orange-500 uppercase tracking-widest">Unit Alat</p>
    </div>

    <div>
        <p class="text-3xl font-bold text-white">
            {{ $stats['active_projects'] }}
        </p>
        <p class="text-xs font-bold text-orange-500 uppercase tracking-widest">Proyek Aktif</p>
    </div>
</div>
            </div>
        </div>
    </section>

<section id="proyek" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center mb-16">
        <h2 class="text-orange-600 font-black tracking-widest text-sm uppercase mb-3">Portfolio</h2>
        <h3 class="text-4xl font-extrabold text-slate-900">Proyek Konstruksi</h3>
        <div class="w-20 h-1.5 bg-orange-600 mx-auto mt-6 rounded-full"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-10">
        @forelse($portfolioProjects as $project)
            <div class="group relative bg-slate-50 rounded-3xl overflow-hidden border border-slate-200 transition-all hover:shadow-2xl hover:-translate-y-2">
                <div class="h-40 bg-gradient-to-br from-slate-800 to-slate-900 relative overflow-hidden flex items-center justify-center">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-orange-600/10 rounded-full -mr-16 -mt-16"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full -ml-12 -mb-12"></div>
                    
                    <div class="relative text-center">
                        <svg class="w-12 h-12 text-orange-500 mx-auto mb-2 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        <span class="text-white/30 font-black text-4xl tracking-tighter uppercase select-none">
                            {{ substr($project->name, 0, 2) }}
                        </span>
                    </div>
                </div>

                <div class="p-8">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-[10px] font-bold bg-slate-200 text-slate-700 px-3 py-1 rounded-full uppercase">
                            {{ $project->category ?? 'General Project' }}
                        </span>
                        
                        @php
                            $statusColor = [
                                'selesai' => 'bg-green-500',
                                'berjalan' => 'bg-orange-500',
                                'tertunda' => 'bg-red-500'
                            ][$project->status] ?? 'bg-slate-400';
                        @endphp
                        <div class="flex items-center space-x-1.5">
                            <span class="w-2 h-2 rounded-full {{ $statusColor }}"></span>
                            <span class="text-[10px] font-bold text-slate-500 uppercase">{{ $project->status }}</span>
                        </div>
                    </div>

                    <h4 class="text-xl font-bold mb-3 text-slate-900 leading-tight group-hover:text-orange-600 transition-colors">
                        {{ $project->name }}
                    </h4>
                    
                    <div class="space-y-3 mb-6">
                        <div class="flex items-start space-x-2 text-slate-500 text-sm">
                            <svg class="w-4 h-4 mt-0.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><circle cx="11.5" cy="11.5" r="1"></circle></svg>
                            <span class="line-clamp-1">{{ $project->location ?? 'Kudus, Jawa Tengah' }}</span>
                        </div>
                        <div class="flex items-start space-x-2 text-slate-500 text-sm">
                            <svg class="w-4 h-4 mt-0.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            <span>Mandor: {{ $project->supervisor->name ?? '-' }}</span>
                        </div>
                    </div>

                    <div class="pt-5 border-t border-slate-100 flex justify-between items-center">
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">Est. {{ $project->created_at->format('Y') }}</span>
                        <a href="/projects/{{ $project->id }}" class="text-orange-600 font-bold text-xs hover:underline uppercase tracking-tighter">
                            Lihat Log →
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-3 py-20 text-center bg-slate-50 rounded-3xl border-2 border-dashed border-slate-200">
                <p class="text-slate-400 font-bold uppercase tracking-widest text-sm">Belum ada proyek konstruksi tercatat</p>
            </div>
        @endforelse
    </div>
</section>

    <section id="peta" class="py-24 bg-slate-50 border-y border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
                <div class="text-left">
                    <h2 class="text-orange-600 font-black tracking-widest text-sm uppercase mb-3 text-center md:text-left">Monitoring Real-Time</h2>
                    <h3 class="text-4xl font-extrabold text-slate-900">Peta Lokasi Proyek</h3>
                </div>
                <div class="flex space-x-4 bg-white p-2 rounded-2xl shadow-sm border border-slate-200">
                    <span class="flex items-center text-xs font-bold px-3 py-1"><span class="w-3 h-3 bg-green-500 rounded-full mr-2 border-2 border-white shadow-sm"></span> Selesai</span>
                    <span class="flex items-center text-xs font-bold px-3 py-1"><span class="w-3 h-3 bg-orange-500 rounded-full mr-2 border-2 border-white shadow-sm"></span> Berjalan</span>
                    <span class="flex items-center text-xs font-bold px-3 py-1"><span class="w-3 h-3 bg-red-500 rounded-full mr-2 border-2 border-white shadow-sm"></span> Tertunda</span>
                </div>
            </div>
            
            <div class="bg-white p-4 rounded-[2rem] shadow-2xl shadow-slate-200 border border-slate-100 overflow-hidden">
                @if($latestProjects->isNotEmpty())
                    <div id="map"></div>
                    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
                    <script>
                        const map = L.map('map').setView([-7.0990, 110.9110], 13);
                        L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
                            attribution: '&copy; CartoDB'
                        }).addTo(map);

                        function getIconByStatus(status) {
                            let color = '#3b82f6';
                            if (status === 'selesai') color = '#22c55e';
                            else if (status === 'berjalan') color = '#f97316';
                            else if (status === 'tertunda') color = '#ef4444';

                            return L.divIcon({
                                html: `<div style="background-color: ${color}; width: 20px; height: 20px; border-radius: 50%; border: 3px solid white; box-shadow: 0 0 10px rgba(0,0,0,0.1);"></div>`,
                                className: '',
                                iconSize: [20, 20],
                                iconAnchor: [10, 10]
                            });
                        }

                        @foreach($latestProjects as $project)
                            @if($project->latitude && $project->longitude)
                                L.marker(
                                    [{{ $project->latitude }}, {{ $project->longitude }}],
                                    { icon: getIconByStatus("{{ $project->status }}") }
                                ).addTo(map).bindPopup(`
                                    <div class="p-2">
                                        <b class="text-slate-900 font-bold">${"{{ $project->name }}".toUpperCase()}</b><br>
                                        <span class="text-xs text-slate-500">${"{{ $project->location }}"}</span><br>
                                        <hr class="my-2 border-slate-100">
                                        <div class="text-[10px] font-bold text-orange-600">MANDOR: {{ $project->supervisor?->name ?? 'N/A' }}</div>
                                    </div>
                                `);
                            @endif
                        @endforeach
                    </script>
                @else
                    <div class="p-20 text-center">
                        <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                        </div>
                        <p class="text-slate-500 font-bold uppercase tracking-widest text-sm">Tidak ada koordinat proyek tersedia</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section id="inventaris" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-3 gap-16 items-center">
                <div class="md:col-span-1 space-y-6">
                    <h2 class="text-orange-600 font-black tracking-widest text-sm uppercase">Resources</h2>
                    <h3 class="text-4xl font-extrabold text-slate-900">Inventaris Alat & Mesin</h3>
                    <p class="text-slate-500 leading-relaxed">Kami memiliki armada alat berat dan peralatan konstruksi mandiri untuk menjamin ketepatan waktu proyek.</p>
                    <div class="pt-4 flex items-center space-x-4">
                        <div class="p-3 bg-orange-600 rounded-xl">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-900 uppercase">Status Ready</p>
                            <p class="text-xs text-slate-500">Update per {{ date('d M Y') }}</p>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2">
                    <div class="bg-slate-50 rounded-[2rem] border border-slate-100 overflow-hidden shadow-xl">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-900 text-white">
                                    <th class="px-8 py-5 text-xs font-black uppercase tracking-widest">Alat Konstruksi</th>
                                    <th class="px-8 py-5 text-xs font-black uppercase tracking-widest">Jenis</th>
                                    <th class="px-8 py-5 text-xs font-black uppercase tracking-widest text-center">Stok</th>
                                    <th class="px-8 py-5 text-xs font-black uppercase tracking-widest">Kondisi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200">
                                @forelse($availableTools as $tool)
                                <tr class="hover:bg-white transition-colors">
                                    <td class="px-8 py-5 font-bold text-slate-900">{{ $tool->name }}</td>
                                    <td class="px-8 py-5 text-slate-500 text-sm uppercase font-bold">{{ str_replace('_', ' ', $tool->type) }}</td>
                                    <td class="px-8 py-5 text-center font-black text-orange-600">{{ $tool->stock }}</td>
                                    <td class="px-8 py-5">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase
                                            @if($tool->condition === 'baik') bg-green-100 text-green-700
                                            @elseif($tool->condition === 'rusak_ringan') bg-yellow-100 text-yellow-700
                                            @else bg-red-100 text-red-700 @endif">
                                            {{ $tool->condition }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-8 py-12 text-center text-slate-400 font-bold uppercase tracking-widest">Belum ada data inventaris</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-slate-900 text-white pt-20 pb-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-4 gap-12 mb-16">
            <div class="col-span-2 space-y-6">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-orange-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <span class="font-bold text-2xl tracking-tighter uppercase">CV. WIGUNA ARYA</span>
                </div>
                <p class="text-slate-400 text-sm leading-relaxed max-w-sm">
                    Membangun dengan presisi, melayani dengan hati. Mitra strategis Anda dalam setiap proyek pembangunan fisik di Jawa Tengah.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="w-10 h-10 bg-white/5 rounded-full flex items-center justify-center hover:bg-orange-600 transition-colors"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg></a>
                    <a href="#" class="w-10 h-10 bg-white/5 rounded-full flex items-center justify-center hover:bg-orange-600 transition-colors"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></a>
                </div>
            </div>
            <div>
                <h4 class="font-bold text-sm uppercase tracking-widest text-orange-500 mb-8">Tautan Cepat</h4>
                <ul class="space-y-4 text-sm text-slate-400">
                    <li><a href="#proyek" class="hover:text-white transition-colors">Portofolio Proyek</a></li>
                    <li><a href="#peta" class="hover:text-white transition-colors">Peta Sebaran Proyek</a></li>
                    <li><a href="#inventaris" class="hover:text-white transition-colors">Status Alat Berat</a></li>
                    <li><a href="/login" class="hover:text-white transition-colors">Login Karyawan</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-sm uppercase tracking-widest text-orange-500 mb-8">Kantor Pusat</h4>
                <ul class="space-y-4 text-sm text-slate-400 leading-relaxed">
                    <li>Jl. a. Yani, No. 136 <br>Purwodadi, Grobogan</li>
                    <li>Email: wigunaarya136@yahoo.com</li>
                    <li>Telp: (0292) 421675</li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 border-t border-white/5 text-center">
            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest italic">
                &copy; {{ date('Y') }} CV. WIGUNA ARYA. All Rights Reserved. <br class="md:hidden"> 
                Hand-built for Excellence.
            </p>
        </div>
    </footer>

    <script>
        function toggleMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }
    </script>
</body>
</html>