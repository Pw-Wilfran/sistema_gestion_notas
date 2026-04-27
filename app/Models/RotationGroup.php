<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RotationGroup extends Model
{
    protected $fillable = ['school_grade_id', 'academic_year_id', 'name', 'description', 'is_active'];

    public function schoolGrade()
    {
        return $this->belongsTo(School_grade::class, 'school_grade_id');
    }

    public function academicYear()
    {
        return $this->belongsTo(Academic_year::class, 'academic_year_id');
    }

    public function subjects()
    {
        return $this->hasMany(RotationGroupSubject::class);
    }
}
