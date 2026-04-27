<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Final_result extends Model
{
    protected $table = 'final_results';
    protected $primaryKey = 'final_result_id';
    public $timestamps = false;

    protected $fillable = [
        'enrollment_id',
        'final_average',
        'final_status',
        'ranking',
        'promoted',
        'performance_level_id',
    ];

    protected $casts = [
        'final_average' => 'decimal:2',
        'promoted'      => 'boolean',
    ];

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class, 'enrollment_id', 'id');
    }

    public function performanceLevel()
    {
        return $this->belongsTo(PerformanceLevel::class);
    }
}
