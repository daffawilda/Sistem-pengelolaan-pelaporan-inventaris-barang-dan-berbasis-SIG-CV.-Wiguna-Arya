<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil 3 proyek terbaru (bisa diurutkan berdasarkan created_at)
        $latestProjects = Project::select('name', 'location', 'status')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        return view('home', compact('latestProjects'));
    }
}