<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Tool;

class HomeController extends Controller
{
    public function index()
    {
        $latestProjects = Project::whereNotNull('latitude')
                            ->whereNotNull('longitude')
                            ->with(['supervisor', 'executor', 'latestReport'])
                            ->take(6)
                            ->get();
        
        $availableTools = Tool::where('stock', '>', 0)->get();

        return view('home', compact('latestProjects', 'availableTools'));
    }
}