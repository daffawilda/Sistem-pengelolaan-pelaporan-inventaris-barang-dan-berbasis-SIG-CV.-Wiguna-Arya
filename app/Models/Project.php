<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'location',
        'latitude',
        'longitude',
        'status',
        'supervisor_id',
        'executor_id',
    ];
    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    public function executor()
    {
        return $this->belongsTo(User::class, 'executor_id');
    }
    public function progressReports()
    {
        return $this->hasMany(ProgressReport::class);
    }
    public function latestReport()
    {
        return $this->hasOne(ProgressReport::class)->latest('report_date');
    }
}
