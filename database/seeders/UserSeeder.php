<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Data dari wiguna_arya.sql
        User::create([
            'id' => 1,
            'name' => 'Admin Utama',
            'email' => 'admin@wigunaarya.com',
            'role' => 'admin',
            'email_verified_at' => '2026-01-17 16:21:12',
            'password' => '$2y$12$rnobt2PD69VTUs78xFU6uOtC4vP4nLIVnTRULQZsE/Y/s5fheTnSi',
            'remember_token' => 'xshkiYRBo0Bca94eeOK08lyVSRRrAMGHtz1C3QvHWQSDbFrSbSkwaSy8CgDX',
            'created_at' => '2026-01-17 16:21:13',
            'updated_at' => '2026-01-17 16:21:13',
        ]);

        User::create([
            'id' => 6,
            'name' => 'Marse Arda Grasiozo',
            'email' => 'marsearda@wigunaarya.com',
            'role' => 'pelaksana',
            'password' => '$2y$12$ZS/SjA.DWqS.GalhxhC0ee8h3saHi4Ywp6t6FXQha1A2XqPn68adi',
            'created_at' => '2026-01-17 16:30:36',
            'updated_at' => '2026-01-17 16:31:03',
        ]);

        User::create([
            'id' => 7,
            'name' => 'Ahmad Nur Amin',
            'email' => 'nuramin@wigunaarya.com',
            'role' => 'pelaksana',
            'password' => '$2y$12$j8Tiq2SNUEkf89FmitSy8u3bC2MUSmIj0tAQfL5QhF06WNy9e9NPW',
            'created_at' => '2026-01-17 16:31:35',
            'updated_at' => '2026-01-17 16:31:42',
        ]);

        User::create([
            'id' => 8,
            'name' => 'Sutrisno',
            'email' => 'sutrisno@wigunaaarya.com',
            'role' => 'mandor',
            'password' => '$2y$12$VNLx5LP3//BpnhvR4CgLEOSGuyvRmDZlwnSPuTG5j.Oxt1fx5GGh6',
            'created_at' => '2026-01-17 16:32:17',
            'updated_at' => '2026-01-17 16:35:33',
        ]);

        User::create([
            'id' => 9,
            'name' => 'Kahlan',
            'email' => 'kahlan@wigunaarya.com',
            'role' => 'mandor',
            'password' => '$2y$12$pslCtJ7g5YcnZQ6Q3PS9CO4kzTPkKb9k8bZnylPtA8.j3PYjXYoc6',
            'created_at' => '2026-01-17 16:32:56',
            'updated_at' => '2026-01-17 16:35:40',
        ]);

        User::create([
            'id' => 10,
            'name' => 'Purnomo',
            'email' => 'purnomo@wigunaarya.com',
            'role' => 'mandor',
            'password' => '$2y$12$02ufANX84dxvVgt1F95knOaBRj0z.80kx95o93oYfTUGvmBC3lbH.',
            'created_at' => '2026-01-17 16:34:01',
            'updated_at' => '2026-01-17 16:35:46',
        ]);

        User::create([
            'id' => 11,
            'name' => 'Supriyo',
            'email' => 'supriyo@wigunaarya.com',
            'role' => 'mandor',
            'password' => '$2y$12$NHMvxlkp2dnCm1X1tEAB8OqM1eYLLvekTIjoDy2v4VXSr/O0D3Lk.',
            'created_at' => '2026-01-17 16:35:24',
            'updated_at' => '2026-01-17 16:35:54',
        ]);

        User::create([
            'id' => 12,
            'name' => 'Suratman',
            'email' => 'suratman@wigunaarya.com',
            'role' => 'mandor',
            'password' => '$2y$12$UEtTUM4Bg.A56blwzZuS6egM94EXneVqilS65R3gDld1g2Y8z40sO',
            'created_at' => '2026-01-17 16:46:03',
            'updated_at' => '2026-01-17 16:46:12',
        ]);

        User::create([
            'id' => 13,
            'name' => 'coba',
            'email' => 'coba@gmail.com',
            'role' => 'admin',
            'password' => '$2y$12$NHN8WKXkAM7MpnAtVE8Ca.0rk1JjBFTGSPRBrfKCSwPJ6Sn6.WdUS',
            'created_at' => '2026-01-17 17:08:27',
            'updated_at' => '2026-01-17 17:08:27',
        ]);

        User::create([
            'id' => 14,
            'name' => 'tes',
            'email' => 'tes@gmail.com',
            'role' => 'admin',
            'password' => '$2y$12$nTppFHr8kG0zjlICoPbXiuvEpoyPsBeUsFldJaxqdt3yt45fvk8Eu',
            'created_at' => '2026-01-17 17:14:21',
            'updated_at' => '2026-01-17 17:14:21',
        ]);

        User::create([
            'id' => 15,
            'name' => 'p',
            'email' => 'p@gmail.com',
            'role' => 'pelaksana',
            'password' => '$2y$12$o7yN03nEH2AzHhboFBcmsuA9M4rozD/Qtn0bqYPT7YcrRFXnAbX9W',
            'created_at' => '2026-01-17 17:17:22',
            'updated_at' => '2026-01-17 17:17:22',
        ]);
    }
}