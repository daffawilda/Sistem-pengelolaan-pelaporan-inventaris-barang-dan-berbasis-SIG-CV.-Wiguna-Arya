<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Contoh: 1 pemilik, 1 admin, 2 pelaksana, 2 mandor
        User::factory()->create([
            'name' => 'Pemilik CV',
            'email' => 'pemilik@wigunaarya.com',
            'role' => 'pemilik',
            'password' => bcrypt('password123'),
        ]);

        User::factory()->create([
            'name' => 'Admin Utama',
            'email' => 'admin@wigunaarya.com',
            'role' => 'admin',
            'password' => bcrypt('password123'),
        ]);

        // User pelaksana
        User::factory()->create([
            'name' => 'Pelaksana Satu',
            'email' => 'pelaksana1@wigunaarya.com',
            'role' => 'pelaksana',
            'password' => bcrypt('password123'),
        ]);

        User::factory()->create([
            'name' => 'Pelaksana Dua',
            'email' => 'pelaksana2@wigunaarya.com',
            'role' => 'pelaksana',
            'password' => bcrypt('password123'),
        ]);

        // Contoh mandor
        User::factory()->create([
            'name' => 'Mandor Andi',
            'email' => 'mandor1@wigunaarya.com',
            'role' => 'mandor',
            'password' => bcrypt('password123'),
        ]);
        User::factory()->create([
            'name' => 'Mandor Budi',
            'email' => 'mandor2@wigunaarya.com',
            'role' => 'mandor',
            'password' => bcrypt('password123'),
        ]);
    }
}