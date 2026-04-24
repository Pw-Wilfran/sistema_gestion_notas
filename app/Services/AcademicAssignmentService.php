<?php

namespace App\Services;

use App\Models\Academic_assignment;

class AcademicAssignmentService
{
    /**
     * Assign teacher to subject-grade
     */
    public function assign(int $teacherId, int $gradeSubjectId, int $yearId): Academic_assignment
    {
        $existing = Academic_assignment::where('grade_subject_id', $gradeSubjectId)
            ->where('year_id', $yearId)
            ->where('active', true)
            ->first();

        if ($existing) {
            throw new \RuntimeException('An active assignment already exists for this subject and year.');
        }

        return Academic_assignment::create([
            'teacher_id'      => $teacherId,
            'grade_subject_id'=> $gradeSubjectId,
            'year_id'         => $yearId,
            'active'          => true,
        ]);
    }

    /**
     * Get assignments by teacher
     */
    public function getByTeacher(int $teacherId, int $yearId)
    {
        return Academic_assignment::with(['gradeSubject.grade', 'gradeSubject.subject'])
            ->where('teacher_id', $teacherId)
            ->where('year_id', $yearId)
            ->where('active', true)
            ->get();
    }
}