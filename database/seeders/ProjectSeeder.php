<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\User;

class ProjectSeeder extends Seeder
{
    public function run()
    {
        // Ambil user contoh (pastikan sudah ada di database)
        $pelaksana1 = User::where('email', 'pelaksana1@wigunaarya.com')->first();
        $pelaksana2 = User::where('email', 'pelaksana2@wigunaarya.com')->first();
        $mandor1 = User::where('email', 'mandor1@wigunaarya.com')->first();
        $mandor2 = User::where('email', 'mandor2@wigunaarya.com')->first();

        // Jika user belum ada, hentikan seeder
        if (!$pelaksana1 || !$mandor1) {
            $this->command->warn('User pelaksana/mandor belum dibuat. Jalankan UserSeeder terlebih dahulu.');
            return;
        }

        // === PROYEK 1: Sedang Berjalan ===
        Project::create([
            'name' => 'Pembangunan Jalan Raya Kudus–Pati',
            'location' => 'Jl. Raya Kudus–Pati, Kec. Jekulo, Kab. Kudus',
            'latitude' => -6.808312,
            'longitude' => 111.007067,
            'status' => 'berjalan',
            'executor_id' => $pelaksana1->id,
            'supervisor_id' => $mandor1->id,
        ]);

        // === PROYEK 2: Sudah Selesai ===
        Project::create([
            'name' => 'Gedung SMP Negeri 3 Kudus',
            'location' => 'Jl. Gondangmanis No. 15, Bae, Kudus',
            'latitude' => -6.820543,
            'longitude' => 110.998215,
            'status' => 'selesai',
            'executor_id' => $pelaksana2->id,
            'supervisor_id' => $mandor2->id,
        ]);

        // === PROYEK 3: Tertunda ===
        Project::create([
            'name' => 'Jembatan Kali Gelis',
            'location' => 'Desa Gelis, Kec. Gebog, Kab. Kudus',
            'latitude' => -6.795120,
            'longitude' => 110.990380,
            'status' => 'tertunda',
            'executor_id' => $pelaksana1->id,
            'supervisor_id' => $mandor1->id,
        ]);

        // === PROYEK 4: Berjalan (Alat Berat) ===
        Project::create([
            'name' => 'Pengaspalan Jalan Lingkar Utara Kudus',
            'location' => 'Jl. Lingkar Utara, Kudus',
            'latitude' => -6.782450,
            'longitude' => 110.978520,
            'status' => 'berjalan',
            'executor_id' => $pelaksana2->id,
            'supervisor_id' => $mandor2->id,
        ]);
    }
}