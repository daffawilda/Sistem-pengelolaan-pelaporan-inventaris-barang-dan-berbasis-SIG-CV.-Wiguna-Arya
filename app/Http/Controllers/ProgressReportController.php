<?php

// app/Http/Controllers/ProgressReportController.php
namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProgressReport;
use App\Models\Feedback;
use Illuminate\Http\Request;

class ProgressReportController extends Controller
{
    public function index()
    {
        $latestReports = collect();
        $myProjects = collect();
        if (auth()->user()->role === 'mandor') {
            // Hanya proyek yang dia tangani
            $myProjects = Project::where('supervisor_id', auth()->id())->get();
            $projectIds = $myProjects->pluck('id');
            $latestReports = $this->getLatestReportsByProject($projectIds);
        } 
        elseif (in_array(auth()->user()->role, ['pelaksana', 'admin'])) {
            if (auth()->user()->role === 'pelaksana') {
                // Hanya proyek yang dia kelola
                $projectIds = Project::where('executor_id', auth()->id())->pluck('id');
            } else {
                // Admin: semua proyek
                $projectIds = Project::pluck('id');
            }
            $latestReports = $this->getLatestReportsByProject($projectIds);
        }

        return view('reports.index', compact('latestReports', 'myProjects'));
    }

     // Form buat laporan (hanya untuk mandor)
    public function create(Project $project)
    {
        if (auth()->id() !== $project->supervisor_id) {
            abort(403, 'Anda bukan mandor proyek ini.');            
        } 
        return view('reports.create', compact('project')); // <-- ini harus di luar if
    }
    // Simpan laporan
    public function store(Request $request, Project $project)
    {
        if (auth()->user()->role !== 'mandor' || auth()->id() !== $project->supervisor_id) {
            abort(403);
        }

        $request->validate([
            'progress_percentage' => 'required|integer|min:0|max:100',
            'description' => 'required|string',
            'report_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048' // Maks 2MB
        ]);
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('progress_reports', 'public');
        }   
        ProgressReport::create([
            'project_id' => $project->id,
            'reporter_id' => auth()->id(),
            'progress_percentage' => $request->progress_percentage,
            'description' => $request->description,
            'report_date' => $request->report_date,
            'image' => $imagePath
        ]);
        return redirect()->route('projects.show', $project)->with('success', 'Laporan kemajuan berhasil disimpan.');
    }
    public function storeFeedback(Request $request, ProgressReport $report)
    {
        $user = auth()->user();
        if (!in_array($user->role, ['pelaksana', 'admin']) || 
            ($user->role === 'pelaksana' && $report->project->executor_id !== $user->id)) {
            abort(403);
        }

        $request->validate(['comment' => 'required|string|max:500']);

        Feedback::create([
            'report_id' => $report->id,
            'user_id' => $user->id,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Feedback berhasil dikirim.');
    }

    public function show(ProgressReport $report)
    {
        $user = auth()->user();
        // Hanya pelaksana proyek terkait yang bisa melihat
        if(
            $user->role === 'admin' ||
            ($user->role === 'pelaksana' && $report->project->executor_id === $user->id)
        ){
            return view('reports.show', compact('report'));
        }
        abort(403);
    }
    public function showByProject(Project $project)
    {
        $user = auth()->user();

        // Validasi akses
        if ($user->role === 'mandor') {
            if ($project->supervisor_id !== $user->id) {
                abort(403);
            }
        } elseif ($user->role === 'pelaksana') {
            if ($project->executor_id !== $user->id) {
                abort(403);
            }
        } 
        // Admin: boleh akses semua

        $reports = ProgressReport::with('reporter')
            ->where('project_id', $project->id)
            ->orderBy('report_date', 'desc')
            ->get();

        return view('reports.by-project', compact('project', 'reports'));
    }

    // Helper: Ambil laporan terbaru per proyek
    private function getLatestReportsByProject($projectIds)
    {
        return ProgressReport::with('project', 'reporter')
            ->whereIn('project_id', $projectIds)
            ->whereNotNull('project_id')
            ->orderBy('report_date', 'desc')
            ->get()
            ->groupBy('project_id')
            ->map(fn($reports) => $reports->first()) // Ambil yang terbaru
            ->values();
    }
}
