<?php

// app/Models/ToolBorrowing.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ToolBorrowing extends Model
{
    protected $fillable = [
        'tool_id', 'borrower_id', 'project_id', 'quantity',
        'borrow_date', 'return_date', 'status', 'approved_by', 'approved_at', 'verified'
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
    public function approveby()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
