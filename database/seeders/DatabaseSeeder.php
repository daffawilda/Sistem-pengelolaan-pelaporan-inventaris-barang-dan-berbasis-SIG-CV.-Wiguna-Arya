<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed the application's database dengan data dari wiguna_arya.sql
        $this->call([
            UserSeeder::class,
            ProjectSeeder::class,
            ToolSeeder::class,
            ToolBorrowingSeeder::class,
            ProgressReportSeeder::class,
            FeedbackSeeder::class,
        ]);
    }
}
