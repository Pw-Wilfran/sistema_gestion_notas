<?php

namespace App\Services;

use App\Models\Enrollment;

class EnrollmentService
{
    /**
     * Enroll a student
     */
    public function enroll(int $studentId, int $gradeId, int $yearId): Enrollment
    {
        $existing = Enrollment::where('student_id', $studentId)
            ->where('year_id', $yearId)
            ->where('active', true)
            ->first();

        if ($existing) {
            throw new \RuntimeException('Student already has an active enrollment in this academic year.');
        }

        return Enrollment::create([
            'student_id'      => $studentId,
            'grade_id'        => $gradeId,
            'year_id'         => $yearId,
            'status'          => 'ACTIVE',
            'enrollment_date' => now()->toDateString(),
            'active'          => true,
        ]);
    }

    /**
     * Cancel enrollment
     */
    public function cancel(int $enrollmentId): void
    {
        Enrollment::findOrFail($enrollmentId)->update([
            'status' => 'CANCELLED',
            'active' => false,
        ]);
    }

    /**
     * Get enrollments by grade and year
     */
    public function getByGradeAndYear(int $gradeId, int $yearId)
    {
        return Enrollment::with('student')
            ->where('grade_id', $gradeId)
            ->where('year_id', $yearId)
            ->where('active', true)
            ->orderBy('id')
            ->get();
    }
}