<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\User;
use App\Models\ProgressReport;

class ProgressReportSeeder extends Seeder
{
    public function run()
    {
        // Ambil proyek yang sudah ada (pastikan ProjectSeeder sudah dijalankan)
        $projects = Project::with('supervisor', 'executor')->get();

        if ($projects->isEmpty()) {
            $this->command->warn('Tidak ada proyek. Jalankan ProjectSeeder terlebih dahulu.');
            return;
        }

        foreach ($projects as $project) {
            // Pastikan proyek memiliki mandor (supervisor) dan pelaksana (executor)
            if (!$project->supervisor || !$project->executor) {
                continue;
            }

            // Buat 1–3 laporan per proyek
            $reportCount = rand(1, 3);
            for ($i = 1; $i <= $reportCount; $i++) {
                $progress = min(100, rand(10, 30) * $i); // naik bertahap
                $date = now()->subDays($reportCount - $i); // tanggal mundur

                ProgressReport::create([
                    'project_id' => $project->id,
                    'reporter_id' => $project->supervisor_id, // mandor
                    'progress_percentage' => $progress,
                    'description' => $this->generateDescription($project->name, $progress),
                    'report_date' => $date->format('Y-m-d'),
                ]);
            }
        }

        $this->command->info('Seeder laporan progres berhasil dibuat!');
    }

    private function generateDescription($projectName, $progress)
    {
        $descriptions = [
            "Pekerjaan pondasi selesai 100%. Mulai pemasangan struktur kolom.",
            "Struktur lantai 1 selesai. Lanjut ke pekerjaan dinding.",
            "Pekerjaan atap selesai. Mulai finishing interior.",
            "Pengecatan dinding hampir selesai. Instalasi listrik dalam pemasangan.",
            "Pekerjaan lansekap mulai dilaksanakan di area luar.",
            "Quality control dilakukan pada seluruh area yang telah dikerjakan.",
            "Pekerjaan plumbing dan sanitasi dalam tahap finalisasi.",
            "Sedang menunggu material finishing dari supplier.",
        ];

        return $descriptions[array_rand($descriptions)] . " Progres total: {$progress}%.";
    }
}