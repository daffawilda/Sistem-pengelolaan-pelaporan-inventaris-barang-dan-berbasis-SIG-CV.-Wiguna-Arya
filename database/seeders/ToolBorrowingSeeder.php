<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tool;
use App\Models\ToolBorrowing;

class ToolBorrowingSeeder extends Seeder
{
    public function run()
    {
        // Data peminjaman - jangan mengurangi stok karena logic sudah dihitung dari quantity peminjaman
        // Stok di table tools = stok asli di gudang
        // Available stock = stok total - total quantity yang sedang dipinjam (status='dipinjam')
        
        $borrowings = [
            // Proyek 9: Drainase - Sasak, Tanggungharjo (Berjalan)
            [
                'tool_id' => 11, // Excavator PC75 (stock 1)
                'borrower_id' => 6, // Pelaksana
                'project_id' => 9,
                'quantity' => 1,
                'borrow_date' => '2026-01-15',
                'return_date' => null,
                'verified' => 'approved',
                'status' => 'dipinjam',
                'approved_by' => 10, // Mandor
                'approved_at' => '2026-01-15 08:30:00',
            ],
            [
                'tool_id' => 12, // Cangkul (stock 5)
                'borrower_id' => 6,
                'project_id' => 9,
                'quantity' => 2,
                'borrow_date' => '2026-01-15',
                'return_date' => null,
                'verified' => 'approved',
                'status' => 'dipinjam',
                'approved_by' => 10,
                'approved_at' => '2026-01-15 08:30:00',
            ],
            [
                'tool_id' => 13, // Cetok (stock 5)
                'borrower_id' => 6,
                'project_id' => 9,
                'quantity' => 3,
                'borrow_date' => '2026-01-15',
                'return_date' => null,
                'verified' => 'approved',
                'status' => 'dipinjam',
                'approved_by' => 10,
                'approved_at' => '2026-01-15 08:30:00',
            ],
            [
                'tool_id' => 14, // Molen (stock 3)
                'borrower_id' => 6,
                'project_id' => 9,
                'quantity' => 2,
                'borrow_date' => '2026-01-16',
                'return_date' => null,
                'verified' => 'approved',
                'status' => 'dipinjam',
                'approved_by' => 10,
                'approved_at' => '2026-01-16 08:00:00',
            ],
            // Proyek 10: Peningkatan Jalan
            [
                'tool_id' => 12, // Cangkul
                'borrower_id' => 7, // Pelaksana
                'project_id' => 10,
                'quantity' => 2,
                'borrow_date' => '2026-01-12',
                'return_date' => null,
                'verified' => 'approved',
                'status' => 'dipinjam',
                'approved_by' => 12, // Mandor
                'approved_at' => '2026-01-12 09:00:00',
            ],
            [
                'tool_id' => 15, // Palu (stock 4)
                'borrower_id' => 7,
                'project_id' => 10,
                'quantity' => 1,
                'borrow_date' => '2026-01-12',
                'return_date' => null,
                'verified' => 'approved',
                'status' => 'dipinjam',
                'approved_by' => 12,
                'approved_at' => '2026-01-12 09:00:00',
            ],
            [
                'tool_id' => 18, // Rompi (stock 12)
                'borrower_id' => 7,
                'project_id' => 10,
                'quantity' => 8,
                'borrow_date' => '2026-01-12',
                'return_date' => null,
                'verified' => 'approved',
                'status' => 'dipinjam',
                'approved_by' => 12,
                'approved_at' => '2026-01-12 09:00:00',
            ],
            [
                'tool_id' => 19, // Sepatu Bot (stock 13)
                'borrower_id' => 7,
                'project_id' => 10,
                'quantity' => 7,
                'borrow_date' => '2026-01-12',
                'return_date' => null,
                'verified' => 'approved',
                'status' => 'dipinjam',
                'approved_by' => 12,
                'approved_at' => '2026-01-12 09:00:00',
            ],
            // Proyek 11: Talud
            [
                'tool_id' => 13, // Cetok
                'borrower_id' => 6, // Pelaksana
                'project_id' => 11,
                'quantity' => 2,
                'borrow_date' => '2026-01-14',
                'return_date' => null,
                'verified' => 'approved',
                'status' => 'dipinjam',
                'approved_by' => 8, // Mandor
                'approved_at' => '2026-01-14 07:30:00',
            ],
            [
                'tool_id' => 17, // Roskam (stock 3)
                'borrower_id' => 6,
                'project_id' => 11,
                'quantity' => 3,
                'borrow_date' => '2026-01-14',
                'return_date' => null,
                'verified' => 'approved',
                'status' => 'dipinjam',
                'approved_by' => 8,
                'approved_at' => '2026-01-14 07:30:00',
            ],
        ];

        // Create borrowings
        foreach ($borrowings as $data) {
            $borrowing = ToolBorrowing::create($data);
            
            // Kurangi stok tool saat peminjaman dibuat (status='dipinjam')
            if ($borrowing->status === 'dipinjam') {
                $borrowing->tool->decrement('stock', $borrowing->quantity);
            }
        }
    }
}

