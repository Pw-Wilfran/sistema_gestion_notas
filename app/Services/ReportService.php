<?php

namespace App\Services;

use App\Models\Enrollment;
use App\Models\Period;
use App\Models\Period_result;
use App\Models\Report_observation;

class ReportService
{
    public function __construct(protected GradeService $gradeService) {}

    /**
     * Generate student report (report card)
     */
    public function generateReport(int $enrollmentId, int $periodId): array
    {
        $enrollment = Enrollment::with([
            'student',
            'grade',
            'academicYear',
        ])->findOrFail($enrollmentId);

        $period = Period::with('academicYear')->findOrFail($periodId);

        $gradesBySubject = $this->gradeService
            ->getByStudentAndPeriod($enrollmentId, $periodId);

        $results = Period_result::with('gradeSubject.subject')
            ->where('enrollment_id', $enrollmentId)
            ->where('period_id', $periodId)
            ->get()
            ->keyBy(fn($r) => $r->grade_subject_id);

        $observations = Report_observation::with('teacher')
            ->where('enrollment_id', $enrollmentId)
            ->where('period_id', $periodId)
            ->get();

        return [
            'student' => [
                'name'       => $enrollment->student->name . ' ' . $enrollment->student->last_name,
                'document'   => $enrollment->student->document,
                'grade'      => $enrollment->grade->name,
                'year'       => $enrollment->academicYear->year,
            ],
            'period' => [
                'name'       => $period->name,
                'number'     => $period->number,
                'start_date' => $period->start_date,
                'end_date'   => $period->end_date,
            ],
            'subjects' => $results->map(fn($r) => [
                'name'        => $r->gradeSubject->subject->name,
                'average'     => $r->average,
                'status'      => $r->status,
                'grades'      => $gradesBySubject->get($r->gradeSubject->subject->name, collect()),
            ])->values(),
            'observations' => $observations->map(fn($o) => [
                'teacher'     => $o->teacher->name . ' ' . $o->teacher->last_name,
                'observation' => $o->observation,
            ])->values(),
        ];
    }

    /**
     * Save or update report observation
     */
    public function saveObservation(int $enrollmentId, int $periodId, int $teacherId, string $text): Report_observation
    {
        return Report_observation::updateOrCreate(
            [
                'enrollment_id' => $enrollmentId,
                'period_id'     => $periodId,
                'teacher_id'    => $teacherId
            ],
            [
                'observation' => $text,
                'created_at'  => now()
            ]
        );
    }
}