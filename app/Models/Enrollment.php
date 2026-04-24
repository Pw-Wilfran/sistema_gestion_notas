<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $table = 'enrollments';
    protected $primaryKey = 'id_enrollment_id';
    public $timestamps = false;

    protected $fillable = [
        'student_id',
        'school_grade_id',
        'academic_year_id',
        'status',
        'enrollment_date',
        'active',
    ];

    protected $casts = [
        'active'         => 'boolean',
        'enrollment_date' => 'date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function schoolGrade()
    {
        return $this->belongsTo(School_grade::class, 'school_grade_id', 'id');
    }

    public function academicYear()
    {
        return $this->belongsTo(Academic_year::class, 'academic_year_id', 'id');
    }

    public function grades()
    {
        return $this->hasMany(Grade::class, 'enrollment_id', 'id');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'enrollment_id', 'id');
    }

    public function periodResults()
    {
        return $this->hasMany(Period_result::class, 'enrollment_id', 'id');
    }

    public function finalResult()
    {
        return $this->hasOne(Final_result::class, 'enrollment_id', 'id');
    }

    public function reportObservations()
    {
        return $this->hasMany(Report_observation::class, 'enrollment_id', 'id');
    }
}
