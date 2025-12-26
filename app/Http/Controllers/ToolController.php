<?php 
// app/Http/Controllers/ToolController.php
namespace App\Http\Controllers;

use App\Models\Tool;
use Illuminate\Http\Request;

class ToolController extends Controller
{
    public function index()
    {
        $tools = Tool::all();
        return view('tools.index', compact('tools'));
    }

    public function create()
    {
        return view('tools.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:alat_kerja,alat_berat',
            'stock' => 'required|integer|min:1',
            'condition' => 'required|in:baik,rusak,perlu_perbaikan',
        ]);

        Tool::create($request->all());
        return redirect()->route('tools.index')->with('success', 'Alat berhasil ditambahkan!');
    }

    // Tambahkan edit/update jika perlu
    public function edit(Tool $tool)
    {
        return view('tools.edit', compact('tool'));
    }
    public function update(Request $request, Tool $tool)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:alat_kerja,alat_berat',
            'stock' => 'required|integer|min:1',
            'condition' => 'required|in:baik,rusak,perlu_perbaikan',
        ]);

        $tool->update($request->all());
        return redirect()->route('tools.index')->with('success', 'Alat berhasil diperbarui!');
    }

    public function destroy(Tool $tool)
    {
        $tool->delete();
        return redirect()->route('tools.index')->with('success', 'Alat berhasil dihapus!');
    }
}