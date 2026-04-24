<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report_observation extends Model
{
    protected $table = 'report_observations';
    protected $primaryKey = 'report_observation_id';
    public $timestamps = false;

    protected $fillable = [
        'enrollment_id',
        'period_id',
        'teacher_id',
        'observation',
    ];

    protected $casts = ['created_at' => 'datetime'];

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class, 'enrollment_id', 'id');
    }

    public function period()
    {
        return $this->belongsTo(Period::class, 'period_id', 'id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }
}
