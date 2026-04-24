<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade_subject extends Model
{
    protected $table = 'grade_subjects';
    protected $primaryKey = 'grade_subject_id';
    public $timestamps = false;

    protected $fillable = ['school_grade_id', 'subject_id', 'active'];
    protected $casts = ['active' => 'boolean'];

    public function schoolGrade()
    {
        return $this->belongsTo(School_grade::class, 'school_grade_id', 'id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    public function academicAssignments()
    {
        return $this->hasMany(Academic_assignment::class, 'grade_subject_id', 'id');
    }

    public function periodResults()
    {
        return $this->hasMany(Period_result::class, 'grade_subject_id', 'id');
    }
}
