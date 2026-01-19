<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\User;

class ProjectSeeder extends Seeder
{
    public function run()
    {
        // Data dari wiguna_arya.sql
        Project::create([
            'id' => 5,
            'name' => 'Jaringan Irigasi',
            'location' => 'Ngeluk',
            'latitude' => -7.044049385741501,
            'longitude' => 110.82964146140515,
            'status' => 'selesai',
            'supervisor_id' => 8,
            'executor_id' => 6,
            'created_at' => '2026-01-17 16:37:21',
            'updated_at' => '2026-01-17 17:47:50',
        ]);

        Project::create([
            'id' => 6,
            'name' => 'Renovasi',
            'location' => 'SDN Curut',
            'latitude' => -7.086247046846516,
            'longitude' => 110.81997799879902,
            'status' => 'selesai',
            'supervisor_id' => 9,
            'executor_id' => 7,
            'created_at' => '2026-01-17 16:38:20',
            'updated_at' => '2026-01-17 18:21:49',
        ]);

        Project::create([
            'id' => 7,
            'name' => 'Jaris',
            'location' => 'Watu Pawon',
            'latitude' => -7.110672481753682,
            'longitude' => 110.81327998641427,
            'status' => 'selesai',
            'supervisor_id' => 11,
            'executor_id' => 6,
            'created_at' => '2026-01-17 16:39:20',
            'updated_at' => '2026-01-17 18:23:26',
        ]);

        Project::create([
            'id' => 8,
            'name' => 'Renovasi',
            'location' => 'SDN 1 Tanggungharjo',
            'latitude' => -7.049053850828685,
            'longitude' => 110.95741653494771,
            'status' => 'selesai',
            'supervisor_id' => 9,
            'executor_id' => 7,
            'created_at' => '2026-01-17 16:40:51',
            'updated_at' => '2026-01-17 17:57:25',
        ]);

        Project::create([
            'id' => 9,
            'name' => 'Drainase',
            'location' => 'Sasak, Tanggungharjo',
            'latitude' => -7.045693411897161,
            'longitude' => 110.94606006148754,
            'status' => 'berjalan',
            'supervisor_id' => 10,
            'executor_id' => 6,
            'created_at' => '2026-01-17 16:42:54',
            'updated_at' => '2026-01-17 18:00:23',
        ]);

        Project::create([
            'id' => 10,
            'name' => 'Peningkatan jalan',
            'location' => 'Plosorejo-Tarub',
            'latitude' => -7.057955277924691,
            'longitude' => 110.99751663234204,
            'status' => 'berjalan',
            'supervisor_id' => 12,
            'executor_id' => 7,
            'created_at' => '2026-01-17 16:47:11',
            'updated_at' => '2026-01-17 18:04:51',
        ]);

        Project::create([
            'id' => 11,
            'name' => 'Talud',
            'location' => 'Ruas jl. Danyang-Krangganharjo',
            'latitude' => -7.119634465972131,
            'longitude' => 110.89692521101827,
            'status' => 'berjalan',
            'supervisor_id' => 8,
            'executor_id' => 6,
            'created_at' => '2026-01-17 16:49:09',
            'updated_at' => '2026-01-17 18:05:31',
        ]);

        Project::create([
            'id' => 12,
            'name' => 'Penataan Lingkungan',
            'location' => 'RW 12 Kuripan',
            'latitude' => -7.076906440358785,
            'longitude' => 110.89989387992318,
            'status' => 'selesai',
            'supervisor_id' => 8,
            'executor_id' => 7,
            'created_at' => '2026-01-17 16:50:29',
            'updated_at' => '2026-01-17 18:23:54',
        ]);

        Project::create([
            'id' => 13,
            'name' => 'Jaris',
            'location' => 'Jajar baru-hulu',
            'latitude' => -7.117637251020339,
            'longitude' => 110.78861331952795,
            'status' => 'selesai',
            'supervisor_id' => 11,
            'executor_id' => 6,
            'created_at' => '2026-01-17 16:55:08',
            'updated_at' => '2026-01-17 18:22:42',
        ]);

        Project::create([
            'id' => 14,
            'name' => 'jaris',
            'location' => 'D1 Mudal 1 Karangasem',
            'latitude' => -7.007670621984688,
            'longitude' => 111.11215210170488,
            'status' => 'selesai',
            'supervisor_id' => 9,
            'executor_id' => 6,
            'created_at' => '2026-01-17 16:56:29',
            'updated_at' => '2026-01-17 18:22:57',
        ]);
    }
}