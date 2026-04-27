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
        'rotation_group_id',
        'active',
    ];

    protected $casts = ['active' => 'boolean'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }

    public function gradeSubject()
    {
        // Adjust if Grade_subject model is named differently
        return $this->belongsTo(Grade_subject::class, 'grade_subject_id', 'id');
    }

    public function academicYear()
    {
        return $this->belongsTo(Academic_year::class, 'academic_year_id', 'id');
    }

    public function rotationGroup()
    {
        return $this->belongsTo(RotationGroup::class, 'rotation_group_id', 'id');
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
