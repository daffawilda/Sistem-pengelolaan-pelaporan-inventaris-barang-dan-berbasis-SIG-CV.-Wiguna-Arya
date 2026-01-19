<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProgressReport;
use App\Models\Feedback;

class ProgressReportSeeder extends Seeder
{
    public function run()
    {
        // Proyek 9: Drainase - Sasak, Tanggungharjo (Berjalan - dimulai 2026-01-15)
        $report9_1 = ProgressReport::create([
            'project_id' => 9,
            'reporter_id' => 10, // Mandor
            'description' => 'Pekerjaan penggalian drainase sudah dimulai. Alat-alat sudah siap dan lokasi sudah dipersiapkan. Estimasi penyelesaian galian utama 2 hari.',
            'progress_percentage' => 15,
            'report_date' => '2026-01-15',
        ]);

        // Feedback dari pelaksana
        Feedback::create([
            'report_id' => $report9_1->id,
            'user_id' => 6, // Pelaksana
            'comment' => 'Lokasi sudah dibersihkan dan siap. Excavator dan alat kerja dalam kondisi baik. Cuaca cerah mendukung pekerjaan.',
        ]);

        $report9_2 = ProgressReport::create([
            'project_id' => 9,
            'reporter_id' => 10,
            'description' => 'Penggalian drainase utama sudah 50% selesai. Material hasil galian sudah dipindahkan ke lokasi penampungan. Lanjut dengan penggalian cabang.',
            'progress_percentage' => 45,
            'report_date' => '2026-01-17',
        ]);

        Feedback::create([
            'report_id' => $report9_2->id,
            'user_id' => 6,
            'comment' => 'Pekerjaan berjalan lancar. Excavator bekerja optimal. Perlu perhatian pada area dengan tanah keras di sebelah timur.',
        ]);

        Feedback::create([
            'report_id' => $report9_2->id,
            'user_id' => 10, // Mandor juga bisa kasih feedback
            'comment' => 'Pastikan keselamatan kerja tetap terjaga. Minggu depan akan ada inspeksi dari kepala dinas.',
        ]);

        $report9_3 = ProgressReport::create([
            'project_id' => 9,
            'reporter_id' => 10,
            'description' => 'Penggalian drainase utama sudah 80% selesai. Tahap pemadatan dasar sudah dimulai dengan Molen. Kondisi lapangan baik.',
            'progress_percentage' => 75,
            'report_date' => '2026-01-18',
        ]);

        Feedback::create([
            'report_id' => $report9_3->id,
            'user_id' => 6,
            'comment' => 'Tim kerja sudah memasuki fase pemadatan. Semua alat dalam kondisi siap. Tidak ada hambatan signifikan.',
        ]);

        // Proyek 10: Peningkatan Jalan (Berjalan - dimulai 2026-01-12)
        $report10_1 = ProgressReport::create([
            'project_id' => 10,
            'reporter_id' => 12, // Mandor Proyek 10
            'description' => 'Pekerjaan persiapan lahan jalan sudah dimulai. Pembersihan vegetasi dan penggalian permukaan yang tidak rata sudah 30% selesai.',
            'progress_percentage' => 20,
            'report_date' => '2026-01-14',
        ]);

        Feedback::create([
            'report_id' => $report10_1->id,
            'user_id' => 7, // Pelaksana Proyek 10
            'comment' => 'Pekerjaan pembersihan lahan berjalan sesuai jadwal. Tim sudah siap dengan peralatan lengkap. Cuaca mendukung.',
        ]);

        Feedback::create([
            'report_id' => $report10_1->id,
            'user_id' => 12,
            'comment' => 'Koordinasi dengan warga sekitar sudah dilakukan. Tidak ada hambatan dari sisi sosial.',
        ]);

        $report10_2 = ProgressReport::create([
            'project_id' => 10,
            'reporter_id' => 12,
            'description' => 'Persiapan lahan sudah 80% selesai. Base layer sudah mulai dipadatkan. Kebutuhan material terus berdatangan sesuai jadwal.',
            'progress_percentage' => 55,
            'report_date' => '2026-01-18',
        ]);

        Feedback::create([
            'report_id' => $report10_2->id,
            'user_id' => 7,
            'comment' => 'Material dan alat sudah memadai. Kecepatan pekerjaan melebihi target awal. Tim sangat produktif.',
        ]);

        // Proyek 11: Talud (Berjalan - dimulai 2026-01-14)
        $report11_1 = ProgressReport::create([
            'project_id' => 11,
            'reporter_id' => 8, // Mandor Proyek 11
            'description' => 'Pekerjaan pembuatan talud sudah dimulai. Penggalian tanah untuk fondasi talud sudah 25% selesai. Material batu sudah disiapkan di lokasi.',
            'progress_percentage' => 15,
            'report_date' => '2026-01-15',
        ]);

        Feedback::create([
            'report_id' => $report11_1->id,
            'user_id' => 6,
            'comment' => 'Lokasi pekerjaan sudah siap. Material batu bata dan semen sudah disiapkan dengan baik. Alat kerja dalam kondisi optimal.',
        ]);

        $report11_2 = ProgressReport::create([
            'project_id' => 11,
            'reporter_id' => 8,
            'description' => 'Struktur talud bagian bawah sudah 40% selesai. Perbaikan drainase tambahan sedang dilakukan. Progress sesuai jadwal.',
            'progress_percentage' => 35,
            'report_date' => '2026-01-17',
        ]);

        Feedback::create([
            'report_id' => $report11_2->id,
            'user_id' => 6,
            'comment' => 'Struktur talud sudah kokoh. Perlu perhatian khusus pada bagian sudut. Roskam dan Cetok terus digunakan secara optimal.',
        ]);

        Feedback::create([
            'report_id' => $report11_2->id,
            'user_id' => 8,
            'comment' => 'Pastikan mutu bata dan semen terjaga. Inspektur akan datang minggu depan untuk verifikasi kualitas.',
        ]);

        $report11_3 = ProgressReport::create([
            'project_id' => 11,
            'reporter_id' => 8,
            'description' => 'Pekerjaan talud memasuki tahap finishing. 70% struktur sudah selesai dan kokoh. Tinggal finishing dan drainase akhir.',
            'progress_percentage' => 65,
            'report_date' => '2026-01-18',
        ]);

        Feedback::create([
            'report_id' => $report11_3->id,
            'user_id' => 6,
            'comment' => 'Struktur talud sudah sangat kokoh dan rapi. Tim bekerja dengan teliti dan berhati-hati. Estimasi selesai 2-3 hari lagi.',
        ]);
    }
}
