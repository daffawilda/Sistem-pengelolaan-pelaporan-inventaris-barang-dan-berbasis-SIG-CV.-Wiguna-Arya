<?php

namespace App\Http\Controllers;
use App\Models\Project;

use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {
        // Query berdasarkan role user
        $query = Project::whereNotNull('latitude')
                        ->whereNotNull('longitude')
                        ->with(['supervisor'])
                        ->select('id', 'name', 'location', 'latitude', 'longitude', 'status', 'supervisor_id');
        
        // Filter berdasarkan role
        if (auth()->check()) {
            if (auth()->user()->role === 'pelaksana') {
                // Pelaksana hanya lihat proyek yang ditangani
                $query = $query->where('executor_id', auth()->id());
            } elseif (auth()->user()->role === 'mandor') {
                // Mandor hanya lihat proyek yang disupervisi
                $query = $query->where('supervisor_id', auth()->id());
            }
            // Admin melihat semua
        } else {
            // Guest/tidak login redirect ke login
            return redirect()->route('login');
        }
        
        $projects = $query->get();
        
        return view('maps.index', compact('projects'));
    }
}
