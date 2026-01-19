<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;



class ProjectController extends Controller
{

    public function index()
    {
        if (Auth::user()->role === 'pelaksana') {
            // Pelaksana hanya melihat proyek yang dia kerjakan
            $projects = Project::with(['supervisor', 'executor'])
                ->where('executor_id', Auth::id())
                ->get();
        } elseif (Auth::user()->role === 'mandor') {
            // Mandor hanya melihat proyek yang dia supervisi
            $projects = Project::with(['supervisor', 'executor'])
                ->where('supervisor_id', Auth::id())
                ->get();
        } else {
        // Admin & pemilik: lihat semua proyek
        $projects = Project::with(['supervisor', 'executor'])->get();
        }
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        if (!in_array(auth()->user()->role, ['admin'])) {
            abort(403, 'Akses ditolak.');
        }
        $supervisors = User::where('role', 'mandor')->get();
        $executors = User::where('role', 'pelaksana')->get();
        
        return view('projects.create', compact('supervisors', 'executors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string|max:255', // ✅ STRING, bukan numeric!
            'latitude' => 'required|numeric|min:-90|max:90',
            'longitude' => 'required|numeric|min:-180|max:180', 
            'status' => 'required|in:berjalan,tertunda,selesai',
            'supervisor_id' => 'required|exists:users,id',
            'executor_id' => 'required|exists:users,id',
        ]);

        Project::create($request->all());

        return redirect()->route('projects.index')->with('success', 'Proyek berhasil ditambahkan.');
    }

    public function edit(Project $project)
    {
        if (!in_array(auth()->user()->role, ['admin'])) {
            abort(403, 'Akses ditolak.');
        }
        $supervisors = User::where('role', 'mandor')->get();
        $executors = User::where('role', 'pelaksana')->get();
        return view('projects.edit', compact('project', 'supervisors', 'executors'));
    }
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string|max:255',
            'latitude' => 'required|numeric|min:-90|max:90',
            'longitude' => 'required|numeric|min:-180|max:180',
            'status' => 'required|in:berjalan,tertunda,selesai',
            'supervisor_id' => 'required|exists:users,id',
            'executor_id' => 'required|exists:users,id',
        ]);

        $project->update($request->all());

        return redirect()->route('projects.index')->with('success', 'Proyek berhasil diperbarui.');
    }

    public function show(Project $project)
    {
        // Eager load relasi untuk performa optimal
        $project->load([
            'supervisor',
            'executor',
            'progressReports' => function ($query) {
                $query->with(['reporter', 'feedbacks.user'])->latest('report_date');
            }
        ]);
        
        return view('projects.show', compact('project'));
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Proyek berhasil dihapus.');
    }

    public function map()
    {
        $projects = Project::select('id', 'name', 'location', 'latitude', 'longitude', 'status')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        return view('maps.index', compact('projects'));
    }
}