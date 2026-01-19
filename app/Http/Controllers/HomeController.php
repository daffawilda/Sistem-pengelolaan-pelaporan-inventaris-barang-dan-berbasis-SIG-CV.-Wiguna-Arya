<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Tool;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Data untuk Peta SIG
        $latestProjects = Project::whereNotNull('latitude')
                            ->whereNotNull('longitude')
                            ->with(['supervisor'])
                            ->latest()
                            ->get();

        // Data untuk Proyek Unggulan (Ambil 3 proyek terbaru)
        $portfolioProjects = Project::latest()->take(3)->get();
        
        // Data Inventaris
        $availableTools = Tool::where('stock', '>', 0)->get();

        // Statistik Hero
        $stats = [
            'total_projects' => Project::count(),
            'total_tools' => Tool::sum('stock'),
            'active_projects' => Project::where('status', 'berjalan')->count(),
        ];

        return view('home', compact('latestProjects', 'portfolioProjects', 'availableTools', 'stats'));
    }
}