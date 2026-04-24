<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School_grade extends Model
{
    protected $table = 'school_grades';
    protected $primaryKey = 'school_grade_id';
    public $timestamps = false;

    protected $fillable = ['name', 'level', 'description', 'active'];
    protected $casts = ['active' => 'boolean'];

    public function subjectsSubjects()
    {
        return $this->hasMany(Grade_subject::class, 'school_grade_id', 'id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'grado_materias', 'school_grade_id', 'enrollment_id')
            ->withPivot('id_grado_materia', 'active');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'school_grade_id', 'id');
    }
}
