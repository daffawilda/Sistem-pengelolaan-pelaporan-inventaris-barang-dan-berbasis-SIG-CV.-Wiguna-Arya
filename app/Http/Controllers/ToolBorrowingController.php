<?php

// app/Http/Controllers/ToolBorrowingController.php
namespace App\Http\Controllers;

use App\Models\Tool;
use App\Models\Project;
use App\Models\ToolBorrowing;
use Illuminate\Http\Request;

class ToolBorrowingController extends Controller
{
    // Daftar peminjaman
    public function index()
    {
        $borrowings = ToolBorrowing::with('tool', 'borrower', 'project')->get();
        return view('borrowings.index', compact('borrowings'));
    }

    // Form pinjam alat
    public function create()
    {
        $tools = Tool::where('stock', '>', 0)->get();
        $projects = Project::all();
        return view('borrowings.create', compact('tools', 'projects'));
    }

    // Simpan peminjaman
    public function store(Request $request)
    {
        $request->validate([
            'tool_id' => 'required|exists:tools,id',
            'project_id' => 'required|exists:projects,id',
            'quantity' => 'required|integer|min:1',
            'borrow_date' => 'required|date',
        ]);

        $tool = Tool::findOrFail($request->tool_id);

        // Pastikan stok cukup
        if ($request->quantity > $tool->stock) {
            return back()->withErrors(['quantity' => 'Stok alat tidak mencukupi!']);
        }

        // Kurangi stok
        $tool->decrement('stock', $request->quantity);

        // Simpan peminjaman
        ToolBorrowing::create([
            'tool_id' => $request->tool_id,
            'borrower_id' => auth()->id(),
            'project_id' => $request->project_id,
            'quantity' => $request->quantity,
            'borrow_date' => $request->borrow_date,
            'status' => 'dipinjam',
        ]);

        return redirect()->route('borrowings.index')->with('success', 'Alat berhasil dipinjam dan stok telah diperbarui!');
    }

    // Kembalikan alat
    public function returnTool($id)
    {
        $borrowing = ToolBorrowing::with('tool')->findOrFail($id);

        if ($borrowing->status === 'dikembalikan') {
            return back()->withErrors(['error' => 'Alat ini sudah dikembalikan.']);
        }

        // Tambahkan kembali stok
        $borrowing->tool->increment('stock', $borrowing->quantity);

        // Update status
        $borrowing->update([
            'return_date' => now(),
            'status' => 'dikembalikan'
        ]);

        return back()->with('success', 'Alat berhasil dikembalikan dan stok diperbarui!');
    }
}
