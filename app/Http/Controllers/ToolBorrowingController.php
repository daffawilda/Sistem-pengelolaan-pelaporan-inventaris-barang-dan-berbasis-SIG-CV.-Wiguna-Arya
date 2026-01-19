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
        // Get available stock (total stock - all active borrowings)
        $tools = Tool::all()->map(function ($tool) {
            // Hitung SEMUA peminjaman yang masih aktif (status dipinjam)
            // Termasuk yang pending, approved, atau apapun - selama belum dikembalikan
            $borrowed = ToolBorrowing::where('tool_id', $tool->id)
                ->where('status', 'dipinjam')
                ->sum('quantity');
            
            $tool->available_stock = $tool->stock - $borrowed;
            return $tool;
        });
        
        $projects = Project::all();
        return view('borrowings.create', compact('tools', 'projects'));
    }

    // Simpan peminjaman
    public function store(Request $request)
    {
        $tool = Tool::find($request->tool_id);
        
        // Hitung stok yang tersedia
        $borrowed = ToolBorrowing::where('tool_id', $tool->id)
            ->where('status', 'dipinjam')
            ->sum('quantity');
        $available_stock = $tool->stock - $borrowed;
        
        $request->validate([
            'tool_id' => 'required|exists:tools,id',
            'project_id' => 'required|exists:projects,id',
            'quantity' => "required|integer|min:1|max:{$available_stock}",
            'borrow_date' => 'required|date|after_or_equal:today',
            'return_date' => 'nullable|date|after_or_equal:borrow_date',
        ], [
            'borrow_date.after_or_equal' => 'Tanggal pinjam tidak boleh tanggal masa lalu.',
            'return_date.after_or_equal' => 'Tanggal pengembalian harus setelah atau sama dengan tanggal pinjam.',
            'quantity.max' => "Jumlah peminjaman alat \"{$tool->name}\" tidak boleh melebihi stok tersedia ({$available_stock} unit).",
        ]);
        
        $verified = auth()->user()->role === 'admin' ? 'approved' : 'pending';
        
        // Simpan peminjaman
        $borrowing = ToolBorrowing::create([
            'tool_id' => $request->tool_id,
            'borrower_id' => auth()->id(),
            'project_id' => $request->project_id,
            'quantity' => $request->quantity,
            'borrow_date' => $request->borrow_date,
            'return_date' => $request->return_date,
            'status' => 'dipinjam',
            'verified' => $verified
        ]);
        
        // Kurangi stok alat saat peminjaman dibuat
        $tool->decrement('stock', $request->quantity);

        return redirect()->route('borrowings.index')
            ->with('success', 'Peminjaman alat berhasil disimpan! Stok berkurang sebesar ' . $request->quantity . ' unit.');
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

        return back()->with('success', 'Alat berhasil dikembalikan! Stok bertambah sebesar ' . $borrowing->quantity . ' unit.');
    }

    public function approveBorrowing($id)
    {
        $borrowing = ToolBorrowing::findOrFail($id);

        // Cek apakah sudah diproses
        if ($borrowing->verified !== 'pending') {
            return back()->with('error', 'Peminjaman ini sudah diproses sebelumnya.');
        }

        // Cek stok sebelum approve
        $borrowed = ToolBorrowing::where('tool_id', $borrowing->tool_id)
            ->where('status', 'dipinjam')
            ->where('verified', 'approved')
            ->sum('quantity');
        
        $available_stock = $borrowing->tool->stock - $borrowed;
        
        if ($borrowing->quantity > $available_stock) {
            return back()->with('error', 'Stok alat "' . $borrowing->tool->name . '" tidak mencukupi. Stok tersedia: ' . $available_stock);
        }

        // Update status verifikasi
        $borrowing->update([
            'verified' => 'approved',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
        ]);

        // Kurangi stok saat di-approve
        $borrowing->tool->decrement('stock', $borrowing->quantity);

        return back()->with('success', 'Peminjaman alat "' . $borrowing->tool->name . '" berhasil disetujui. Stok berkurang sebesar ' . $borrowing->quantity);
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
