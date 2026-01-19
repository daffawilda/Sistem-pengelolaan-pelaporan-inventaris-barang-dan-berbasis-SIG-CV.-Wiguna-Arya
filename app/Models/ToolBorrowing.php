<?php

// app/Models/ToolBorrowing.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ToolBorrowing extends Model
{
    protected $fillable = [
        'tool_id', 'borrower_id', 'project_id', 'quantity',
        'borrow_date', 'return_date', 'status', 'approved_by', 'approved_at', 'verified',
        'condition_before', 'condition_after', 'notes', 'received_by', 'received_at'
    ];

    protected $casts = [
        'borrow_date' => 'date',
        'return_date' => 'date',
        'approved_at' => 'datetime',
        'received_at' => 'datetime',
    ];

    public function tool()
    {
        return $this->belongsTo(Tool::class);
    }

    public function borrower()
    {
        return $this->belongsTo(User::class, 'borrower_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function receivedBy()
    {
        return $this->belongsTo(User::class, 'received_by');
    }
}
