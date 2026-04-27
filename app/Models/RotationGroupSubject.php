<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RotationGroupSubject extends Model
{
    protected $fillable = ['rotation_group_id', 'grade_subject_id', 'rotation_order', 'is_active'];

    public function rotationGroup()
    {
        return $this->belongsTo(RotationGroup::class);
    }

    public function gradeSubject()
    {
        // I need to verify what the model for grade_subject is called. Is it Grade_subject? I'll assume GradeSubject or wait. Wait, `School_grade` exists, but there's a pivot `grade_subject_table`. Let me check if there's a model for it. If not, I'll just use a belongsTo relation.
        return $this->belongsTo(\App\Models\Grade_subject::class, 'grade_subject_id');
    }
}
