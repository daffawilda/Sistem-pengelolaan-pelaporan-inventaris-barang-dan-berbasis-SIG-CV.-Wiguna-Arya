<?php

// app/Models/ProgressReport.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgressReport extends Model
{
    protected $fillable = [
        'project_id', 'reporter_id', 'description', 'progress_percentage', 'report_date'
    ];

    // 
    protected $casts = [
        'report_date' => 'date', // otomatis jadi Carbon instance
    ];
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }
}