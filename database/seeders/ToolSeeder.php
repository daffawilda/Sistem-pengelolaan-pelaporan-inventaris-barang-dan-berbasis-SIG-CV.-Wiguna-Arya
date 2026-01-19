<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tool;

class ToolSeeder extends Seeder
{
    public function run()
    {
        // Data dari wiguna_arya.sql
        Tool::create([
            'id' => 11,
            'name' => 'Excavator PC75',
            'type' => 'alat_berat',
            'stock' => 1,
            'condition' => 'baik',
            'created_at' => '2026-01-17 16:57:58',
            'updated_at' => '2026-01-17 18:20:28',
        ]);

        Tool::create([
            'id' => 12,
            'name' => 'Cangkul',
            'type' => 'alat_kerja',
            'stock' => 12,
            'condition' => 'baik',
            'created_at' => '2026-01-17 16:58:19',
            'updated_at' => '2026-01-17 16:58:19',
        ]);

        Tool::create([
            'id' => 13,
            'name' => 'Cetok',
            'type' => 'alat_kerja',
            'stock' => 15,
            'condition' => 'baik',
            'created_at' => '2026-01-17 16:58:47',
            'updated_at' => '2026-01-17 16:58:47',
        ]);

        Tool::create([
            'id' => 14,
            'name' => 'Molen',
            'type' => 'alat_berat',
            'stock' => 5,
            'condition' => 'baik',
            'created_at' => '2026-01-17 16:59:08',
            'updated_at' => '2026-01-17 16:59:08',
        ]);

        Tool::create([
            'id' => 15,
            'name' => 'Palu',
            'type' => 'alat_kerja',
            'stock' => 7,
            'condition' => 'baik',
            'created_at' => '2026-01-17 16:59:28',
            'updated_at' => '2026-01-17 16:59:28',
        ]);

        Tool::create([
            'id' => 16,
            'name' => 'Betel',
            'type' => 'alat_kerja',
            'stock' => 3,
            'condition' => 'baik',
            'created_at' => '2026-01-17 16:59:45',
            'updated_at' => '2026-01-17 16:59:45',
        ]);

        Tool::create([
            'id' => 17,
            'name' => 'Roskam',
            'type' => 'alat_kerja',
            'stock' => 8,
            'condition' => 'baik',
            'created_at' => '2026-01-17 17:00:00',
            'updated_at' => '2026-01-17 17:00:00',
        ]);

        Tool::create([
            'id' => 18,
            'name' => 'Rompi',
            'type' => 'alat_kerja',
            'stock' => 20,
            'condition' => 'baik',
            'created_at' => '2026-01-17 17:00:15',
            'updated_at' => '2026-01-17 17:00:15',
        ]);

        Tool::create([
            'id' => 19,
            'name' => 'Sepatu Bot',
            'type' => 'alat_kerja',
            'stock' => 20,
            'condition' => 'baik',
            'created_at' => '2026-01-17 17:00:37',
            'updated_at' => '2026-01-17 17:00:37',
        ]);

        Tool::create([
            'id' => 20,
            'name' => 'Helm Proyek',
            'type' => 'alat_kerja',
            'stock' => 20,
            'condition' => 'baik',
            'created_at' => '2026-01-17 17:00:54',
            'updated_at' => '2026-01-17 17:00:54',
        ]);

        Tool::create([
            'id' => 21,
            'name' => 'Gergaji',
            'type' => 'alat_kerja',
            'stock' => 5,
            'condition' => 'baik',
            'created_at' => '2026-01-17 17:01:25',
            'updated_at' => '2026-01-17 17:01:25',
        ]);

        Tool::create([
            'id' => 22,
            'name' => 'Gerinda',
            'type' => 'alat_kerja',
            'stock' => 2,
            'condition' => 'baik',
            'created_at' => '2026-01-17 17:01:52',
            'updated_at' => '2026-01-17 17:01:52',
        ]);

        Tool::create([
            'id' => 23,
            'name' => 'Bor',
            'type' => 'alat_kerja',
            'stock' => 2,
            'condition' => 'baik',
            'created_at' => '2026-01-17 17:02:03',
            'updated_at' => '2026-01-17 17:02:03',
        ]);
    }
}