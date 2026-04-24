<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';
    protected $primaryKey = 'id_subject';
    public $timestamps = false;

    protected $fillable = ['name', 'code', 'description', 'active'];
    protected $casts = ['active' => 'boolean'];

    public function gradoMaterias()
    {
        return $this->hasMany(Grade_subject::class, 'subject_id', 'id');
    }

    public function schoolGrades()
    {
        return $this->belongsToMany(School_grade::class, 'grade_subjects', 'subject_id', 'school_grade_id')
            ->withPivot('grade_subject_id', 'active');
    }
}
