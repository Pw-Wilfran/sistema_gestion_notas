<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Period_result extends Model
{
    protected $table = 'Period_results';
    protected $primaryKey = 'period_result_id';
    public $timestamps = false;

    protected $fillable = [
        'enrollment_id',
        'period_id',
        'grade_subject_id',
        'average',
        'status',
        'performance_level_id',
    ];

    protected $casts = ['average' => 'decimal:2'];

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class, 'enrollment_id', 'id');
    }

    public function period()
    {
        return $this->belongsTo(Period::class, 'period_id', 'id');
    }

    public function grade_subject()
    {
        return $this->belongsTo(Grade_subject::class, 'grade_subject_id', 'id');
    }

    public function performanceLevel()
    {
        return $this->belongsTo(PerformanceLevel::class);
    }
}
