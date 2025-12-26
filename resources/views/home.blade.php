<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="CV. Wiguna Arya – Perusahaan konstruksi profesional di Kudus, Jawa Tengah. Melayani pembangunan jalan, jembatan, gedung, dan infrastruktur publik." />
    <title>CV. Wiguna Arya – Konstruksi Profesional di Jawa Tengah</title>
    @vite(['resources/css/app.css'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-white text-gray-800">

    <!-- Header -->
    <header class="sticky top-0 z-50 bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <span class="font-bold text-xl text-gray-900">CV. <span class="text-blue-700">Wiguna Arya</span></span>
            </div>
            <div class="hidden md:flex space-x-6">
                <a href="#layanan" class="text-gray-700 hover:text-blue-700 font-medium">Layanan</a>
                <a href="#proyek" class="text-gray-700 hover:text-blue-700 font-medium">Proyek</a>
                <a href="#tentang" class="text-gray-700 hover:text-blue-700 font-medium">Tentang</a>
                <a href="/login" class="text-blue-700 font-medium">Login Klien</a>
            </div>
        </div>
    </header>

    <!-- Hero -->
    <section class="bg-gradient-to-br from-blue-900 to-blue-700 text-white py-20">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Membangun Infrastruktur untuk Masa Depan</h1>
            <p class="text-xl opacity-90 mb-8">
                Solusi konstruksi profesional untuk jalan, jembatan, gedung, dan fasilitas publik di Jawa Tengah.
            </p>
            <a href="/login" class="inline-block bg-white text-blue-800 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 shadow-lg">
                Akses Portal Proyek
            </a>
        </div>
    </section>

    <!-- Layanan -->
    <section id="layanan" class="py-16 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">Layanan Kami</h2>
                <p class="text-gray-600 mt-2">Kompeten, tepat waktu, dan sesuai spesifikasi teknis</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-blue-700 text-2xl">🛣️</span>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Konstruksi Jalan & Jembatan</h3>
                    <p class="text-gray-600">Pembangunan dan perawatan jalan raya, jalan desa, serta jembatan beton.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-blue-700 text-2xl">🏛️</span>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Gedung & Fasilitas Umum</h3>
                    <p class="text-gray-600">Sekolah, kantor pemerintah, puskesmas, dan gedung komersial.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-blue-700 text-2xl">👷</span>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Manajemen Proyek Terpadu</h3>
                    <p class="text-gray-600">Pengawasan ketat dari perencanaan hingga serah terima akhir.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Proyek Terkini -->
<section id="proyek" class="py-16">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900">Proyek Terkini</h2>
            <p class="text-gray-600 mt-2">Proyek yang sedang atau baru saja kami kerjakan</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($latestProjects as $project)
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="h-48 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500">Foto Proyek</span>
                    </div>
                    <div class="p-5">
                        @if($project->status === 'berjalan')
                            <span class="inline-block bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded">Berjalan</span>
                        @elseif($project->status === 'selesai')
                            <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded">Selesai</span>
                        @else
                            <span class="inline-block bg-red-100 text-red-800 text-xs px-2 py-1 rounded">Tertunda</span>
                        @endif
                        <h3 class="font-bold mt-2">{{ $project->name }}</h3>
                        <p class="text-gray-600 text-sm mt-1">{{ $project->location }}</p>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500 py-10">
                    Belum ada proyek yang terdaftar.
                </div>
            @endforelse
        </div>
    </div>
</section>

    <!-- Tentang -->
    <section id="tentang" class="py-16 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-gray-900 mb-6">Tentang Kami</h2>
            <p class="text-gray-700 mb-4">
                CV. Wiguna Arya adalah perusahaan konstruksi yang berdiri sejak 2015 di Kudus, Jawa Tengah. Kami telah menyelesaikan lebih dari 50 proyek infrastruktur di wilayah Jawa Tengah, dengan komitmen pada kualitas, keselamatan, dan ketepatan waktu.
            </p>
            <p class="text-gray-700">
                Tim kami terdiri dari insinyur sipil, mandor berpengalaman, dan tenaga ahli yang siap mewujudkan proyek Anda sesuai standar teknis tertinggi.
            </p>
        </div>
    </section>

    <!-- Kontak CTA -->
    <section class="bg-blue-800 text-white py-12">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-2xl font-bold mb-4">Siap memulai proyek Anda?</h2>
            <p class="mb-6">Hubungi kami untuk konsultasi awal tanpa biaya.</p>
            <a href="mailto:info@wigunaarya.co.id" class="inline-block bg-white text-blue-800 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100">
                Kirim Email
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between">
                <div class="mb-6 md:mb-0">
                    <h3 class="font-bold text-lg">CV. Wiguna Arya</h3>
                    <p class="text-gray-400 text-sm mt-2">
                        Jl. Raya Kudus–Pati No. 88<br>
                        Kudus, Jawa Tengah 59321<br>
                        Email: info@wigunaarya.co.id<br>
                        Telp: (0291) 123456
                    </p>
                </div>
                <div>
                    <h4 class="font-semibold mb-3">Portal</h4>
                    <ul class="text-gray-400 text-sm space-y-1">
                        <li><a href="/login" class="hover:text-white">Login Klien</a></li>
                        <li><a href="#proyek" class="hover:text-white">Proyek</a></li>
                        <li><a href="#layanan" class="hover:text-white">Layanan</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-6 text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} CV. Wiguna Arya. Hak Cipta Dilindungi.
            </div>
        </div>
    </footer>

</body>
</html>