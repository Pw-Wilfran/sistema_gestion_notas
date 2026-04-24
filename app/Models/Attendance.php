<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendances';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'enrollment_id',
        'academic_assignment_id',
        'date',
        'status',
        'observation',
    ];

    protected $casts = ['date' => 'date'];

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class, 'enrollment_id', 'id');
    }

    public function academicAssignment()
    {
        return $this->belongsTo(Academic_assignment::class, 'academic_assignment_id', 'id');
    }
}
