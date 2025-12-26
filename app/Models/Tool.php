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
    public function toolBorrowings()
    {
        return $this->hasMany(ToolBorrowing::class);
    }
}
