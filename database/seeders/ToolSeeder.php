<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tool;

class ToolSeeder extends Seeder
{
    public function run()
    {
        // === ALAT KERJA ===
        Tool::create([
            'name' => 'Sekop',
            'type' => 'alat_kerja',
            'stock' => 20,
            'condition' => 'baik'
        ]);

        Tool::create([
            'name' => 'Cangkul',
            'type' => 'alat_kerja',
            'stock' => 15,
            'condition' => 'baik'
        ]);

        Tool::create([
            'name' => 'Palu',
            'type' => 'alat_kerja',
            'stock' => 10,
            'condition' => 'baik'
        ]);

        Tool::create([
            'name' => 'Gerinda Tangan',
            'type' => 'alat_kerja',
            'stock' => 5,
            'condition' => 'perlu_perbaikan'
        ]);

        Tool::create([
            'name' => 'Waterpass',
            'type' => 'alat_kerja',
            'stock' => 3,
            'condition' => 'rusak'
        ]);

        // === ALAT BERAT ===
        Tool::create([
            'name' => 'Excavator',
            'type' => 'alat_berat',
            'stock' => 2,
            'condition' => 'baik'
        ]);

        Tool::create([
            'name' => 'Bulldozer',
            'type' => 'alat_berat',
            'stock' => 1,
            'condition' => 'baik'
        ]);

        Tool::create([
            'name' => 'Concrete Mixer',
            'type' => 'alat_berat',
            'stock' => 3,
            'condition' => 'perlu_perbaikan'
        ]);

        Tool::create([
            'name' => 'Roller (Pemadat Tanah)',
            'type' => 'alat_berat',
            'stock' => 2,
            'condition' => 'baik'
        ]);

        Tool::create([
            'name' => 'Tower Crane',
            'type' => 'alat_berat',
            'stock' => 1,
            'condition' => 'rusak'
        ]);
    }
}