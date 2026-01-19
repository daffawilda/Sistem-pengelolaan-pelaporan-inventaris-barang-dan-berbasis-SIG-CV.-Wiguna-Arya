<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard utama berdasarkan role pengguna.
     */
    public function __invoke()
    {
        $user = Auth::user();

        // Query dasar: semua proyek
        $projectQuery = Project::query();

        // Filter proyek berdasarkan role pengguna
        if ($user->role === 'mandor') {
            // Mandor hanya melihat proyek yang dia supervisi
            $projectQuery->where('supervisor_id', $user->id);
        } elseif ($user->role === 'pelaksana') {
            // Pelaksana hanya melihat proyek yang dia kerjakan
            $projectQuery->where('executor_id', $user->id);
        }
        // Admin & pemilik: lihat semua proyek

        $allProjects = $projectQuery->get();

        // Hitung statistik proyek
        $stats = [
            'total_projects' => $allProjects->count(),
            'running_projects' => $allProjects->where('status', 'berjalan')->count(),
            'completed_projects' => $allProjects->where('status', 'selesai')->count(),
            'delayed_projects' => $allProjects->where('status', 'tertunda')->count(),
        ];

        // Data untuk peta SIG: semua proyek dengan koordinat valid
        // (diperlihatkan ke semua role, sesuai proposal)
        $mapProjects = Project::with('supervisor:id,name')
            ->select('id', 'name', 'location', 'latitude', 'longitude', 'status', 'supervisor_id')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        return view('dashboard', compact('stats', 'mapProjects', 'allProjects'));
    }
}