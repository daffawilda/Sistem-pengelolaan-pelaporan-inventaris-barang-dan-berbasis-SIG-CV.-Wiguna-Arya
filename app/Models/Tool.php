<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    /** @use HasFactory<\Database\Factories\ToolFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'type',
        'stock',
        'condition',
    ];

    // Validasi stok tidak boleh negatif
    protected $casts = [
        'stock' => 'integer',
    ];

    public function toolBorrowings()
    {
        return $this->hasMany(ToolBorrowing::class);
    }

    // Scope untuk mendapatkan tools yang masih ada stok
    public function scopeWithAvailableStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    // Get available stock (total stock - active borrowings)
    public function getAvailableStockAttribute()
    {
        $borrowed = $this->toolBorrowings()
            ->where('status', 'dipinjam')
            ->sum('quantity');
        
        return $this->stock - $borrowed;
    }
}
