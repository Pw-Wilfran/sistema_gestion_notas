<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnrollmentSubject extends Model
{
    protected $fillable = [
        'enrollment_id', 'grade_subject_id', 'rotation_group_id', 
        'type', 'status', 'selected_at', 'is_active'
    ];

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }

    public function rotationGroup()
    {
        return $this->belongsTo(RotationGroup::class);
    }
}
