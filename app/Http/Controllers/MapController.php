<?php

namespace App\Http\Controllers;
use App\Models\Project;

use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {
        $projects = Project::select('id', 'name', 'location', 'latitude', 'longitude', 'status')->get();
        return view('maps.index', compact('projects'));
    }
}
