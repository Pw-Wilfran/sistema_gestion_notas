<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activities';
    protected $primaryKey = 'activity_id';
    public $timestamps = false;

    protected $fillable = [
        'academic_assignment_id',
        'period_id',
        'name',
        'type',
        'percentage',
        'active',
    ];

    protected $casts = [
        'active'     => 'boolean',
        'percentage' => 'decimal:2',
    ];

    public function academicAssignment()
    {
        return $this->belongsTo(Academic_assignment::class, 'academic_assignment_id', 'id');
    }

    public function period()
    {
        return $this->belongsTo(Period::class, 'period_id', 'id');
    }

    public function grades()
    {
        return $this->hasMany(Grade::class, 'activity_id', 'id');
    }
}
