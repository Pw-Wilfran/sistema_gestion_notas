<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Academic_assignment extends Model
{
    protected $table = 'academic_assignments';
    protected $primaryKey = 'academic_assignment_id';
    public $timestamps = false;

    protected $fillable = [
        'teacher_id',
        'grade_subject_id',
        'academic_year_id',
        'active',
    ];

    protected $casts = ['active' => 'boolean'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }

    public function gradeSubject()
    {
        return $this->belongsTo(Grade_subject::class, 'grade_subject_id', 'id');
    }

    public function AcademicYear()
    {
        return $this->belongsTo(Academic_year::class, 'academic_year_id', 'id');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class, 'academic_assignment_id', 'id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'academic_assignment_id', 'id');
    }
}
