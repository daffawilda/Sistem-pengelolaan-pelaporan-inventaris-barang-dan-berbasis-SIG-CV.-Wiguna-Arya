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
        $tool = Tool::find($request->tool_id);
        $verified = auth()->user()->role==='admin' ? 'approved' : 'pending';
        // Kurangi stok
        
        // Simpan peminjaman
        ToolBorrowing::create([
            'tool_id' => $request->tool_id,
            'borrower_id' => auth()->id(),
            'project_id' => $request->project_id,
            'quantity' => $request->quantity,
            'borrow_date' => $request->borrow_date,
            'status' => 'dipinjam',
            'verified' => $verified
        ]);
        if ($verified === 'approved') {
            $tool->decrement('stock', $request->quantity); 
        }

        return redirect()->route('borrowings.index')->with('success', $verified?'Peminjaman alat berhasil disimpan dan stok dikurangi!':'Peminjaman alat berhasil disimpan!');
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

    public function approveBorrowing($id)
    {
        $borrowing = ToolBorrowing::findOrFail($id);

        // Cek apakah sudah diproses
        if ($borrowing->verified !== 'pending') {
            return back()->with('error', 'Peminjaman ini sudah diproses sebelumnya.');
        }

        // Cek stok
        if ($borrowing->quantity > $borrowing->tool->stock) {
            return back()->with('error', 'Stok alat "' . $borrowing->tool->name . '" tidak mencukupi. Stok tersedia: ' . $borrowing->tool->stock);
        }

        // Update status verifikasi
        $borrowing->update([
            'verified' => 'approved',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
        ]);

        // Kurangi stok
        $borrowing->tool->decrement('stock', $borrowing->quantity);

        return back()->with('success', 'Peminjaman alat "' . $borrowing->tool->name . '" berhasil disetujui.');
    }

    public function rejectBorrowing(ToolBorrowing $borrowing)
    {
        // Cek apakah sudah diproses
        if ($borrowing->verified !== 'pending') {
            return back()->with('error', 'Peminjaman ini sudah diproses sebelumnya.');
        }

        // Update status verifikasi
        $borrowing->update([
            'verified' => 'rejected',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
        ]);

        return back()->with('success', 'Peminjaman alat "' . $borrowing->tool->name . '" telah ditolak.');
    }
}
