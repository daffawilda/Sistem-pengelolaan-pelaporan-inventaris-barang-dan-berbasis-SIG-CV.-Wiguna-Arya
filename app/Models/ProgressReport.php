<?php

// app/Models/ProgressReport.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgressReport extends Model
{
    protected $fillable = [
        'project_id', 'reporter_id', 'description', 'progress_percentage', 'report_date', 'image'
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
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'report_id');
    }
    public function image_url()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
}