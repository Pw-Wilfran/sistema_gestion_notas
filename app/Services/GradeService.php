<?php

namespace App\Services;

use App\Models\Grade;
use App\Models\Activity;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Services\ResultService;

class GradeService
{
    /**
     * Store or update a grade for a student in an activity
     */
    public function store(int $enrollmentId, int $activityId, float $value): Grade
    {
        $this->validateValue($value);

        $grade = Grade::updateOrCreate(
            ['enrollment_id' => $enrollmentId, 'activity_id' => $activityId],
            ['value' => $value, 'updated_at' => now(), 'created_at' => now()]
        );

        // Recalculate period result automatically
        $activity = Activity::findOrFail($activityId);

        app(ResultService::class)->calculatePeriod(
            $enrollmentId,
            $activity->period_id,
            $activity->assignment->grade_subject_id
        );

        return $grade;
    }

    /**
     * Bulk insert grades for an activity
     */
    public function storeBulk(int $activityId, array $grades): void
    {
        DB::transaction(function () use ($activityId, $grades) {
            foreach ($grades as $item) {
                $this->store($item['enrollment_id'], $activityId, $item['value']);
            }
        });
    }

    /**
     * Get student grades grouped by subject in a period
     */
    public function getByStudentAndPeriod(int $enrollmentId, int $periodId): Collection
    {
        return Grade::query()
            ->join('activities', 'grades.activity_id', '=', 'activities.id')
            ->join('academic_assignments', 'activities.assignment_id', '=', 'academic_assignments.id')
            ->join('grade_subjects', 'academic_assignments.grade_subject_id', '=', 'grade_subjects.id')
            ->join('subjects', 'grade_subjects.subject_id', '=', 'subjects.id')
            ->where('grades.enrollment_id', $enrollmentId)
            ->where('activities.period_id', $periodId)
            ->select([
                'subjects.name as subject',
                'activities.name as activity',
                'activities.type',
                'activities.percentage',
                'grades.value',
                'grades.updated_at',
            ])
            ->get()
            ->groupBy('subject');
    }

    private function validateValue(float $value): void
    {
        if ($value < 0 || $value > 10) {
            throw new \InvalidArgumentException('Grade must be between 0 and 10.');
        }
    }
}