<?php

// app/Http/Controllers/ProgressReportController.php
namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProgressReport;
use Illuminate\Http\Request;

class ProgressReportController extends Controller
{
    public function index()
    {
        // Tampilkan daftar laporan (untuk mandor dan pelaksana)
        if (auth()->user()->role === 'mandor') {
        // Ambil proyek yang ditangani oleh mandor ini
            $myProjects = Project::where('supervisor_id', auth()->id())->get();
            $reports = ProgressReport::with('project')
            ->where('reporter_id', auth()->id())
            ->orderBy('report_date', 'desc')
            ->get();

            return view('reports.index', compact('reports', 'myProjects'));
        } elseif (auth()->user()->role === 'pelaksana') {
            // Pelaksana lihat laporan dari proyek yang DIA kelola
            $reports = ProgressReport::with('project', 'reporter')
                ->whereHas('project', fn($q) => $q->where('executor_id', auth()->id()))
                ->orderBy('report_date', 'desc')
                ->get();
        } else {
            // Admin/pemilik: tidak diizinkan (sesuai proposal)
            abort(403);
        }
        return view('reports.index', compact('reports'));

    }

     // Form buat laporan (hanya untuk mandor)
    public function create(Project $project)
    {
        // Hanya boleh akses jika dia mandor proyek ini
        if (auth()->id() !== $project->supervisor_id) {
            abort(403, 'Anda bukan mandor proyek ini.');            }
            return view('reports.create', compact('project'));
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
        ]);

        ProgressReport::create([
            'project_id' => $project->id,
            'reporter_id' => auth()->id(),
            'progress_percentage' => $request->progress_percentage,
            'description' => $request->description,
            'report_date' => $request->report_date,
        ]);
        return redirect()->route('projects.show', $project)->with('success', 'Laporan kemajuan berhasil disimpan.');
    }

    public function show(ProgressReport $report)
    {
        // Hanya pelaksana proyek terkait yang bisa melihat
        if($report->project->executor_id !== auth()->id()) {
            abort(403);
        }
        return view('reports.show', compact('report'));
    }
}
