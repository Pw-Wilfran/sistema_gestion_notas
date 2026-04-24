<?php

namespace App\Services;

use App\Models\Grade;
use App\Models\Activity;
use App\Models\Enrollment;
use App\Models\Final_result;
use App\Models\Period_result;
use Illuminate\Support\Facades\DB;

class ResultService
{
    /**
     * Calculate and persist period result
     */
    public function calculatePeriod(int $enrollmentId, int $periodId, int $gradeSubjectId): Period_result
    {
        $activities = Activity::query()
            ->join('academic_assignments', 'activities.assignment_id', '=', 'academic_assignments.id')
            ->where('activities.period_id', $periodId)
            ->where('academic_assignments.grade_subject_id', $gradeSubjectId)
            ->where('activities.active', true)
            ->select('activities.*')
            ->get();

        $average = $this->calculateWeightedAverage($enrollmentId, $activities);

        $status = $average >= 3.0 ? 'APPROVED' : 'FAILED';

        return Period_result::updateOrCreate(
            [
                'enrollment_id' => $enrollmentId,
                'period_id' => $periodId,
                'grade_subject_id' => $gradeSubjectId
            ],
            [
                'average' => $average,
                'status' => $status
            ]
        );
    }

    /**
     * Calculate final result
     */
    public function calculateFinal(int $enrollmentId): Final_result
    {
        $results = Period_result::query()
            ->join('periods', 'period_results.period_id', '=', 'periods.id')
            ->where('period_results.enrollment_id', $enrollmentId)
            ->select('period_results.average', 'periods.percentage')
            ->get();

        $total = $results->sum(fn($r) => $r->average * ($r->percentage / 100));

        $promoted = $total >= 3.0;
        $status = $promoted ? 'PROMOTED' : 'FAILED';

        $result = Final_result::updateOrCreate(
            ['enrollment_id' => $enrollmentId],
            [
                'final_average' => round($total, 2),
                'final_status' => $status,
                'promoted' => $promoted
            ]
        );

        $this->updateRanking($enrollmentId);

        return $result;
    }

    /**
     * Annual closure
     */
    public function annualClosure(int $yearId, int $gradeId): void
    {
        DB::transaction(function () use ($yearId, $gradeId) {

            $enrollments = Enrollment::where('year_id', $yearId)
                ->where('grade_id', $gradeId)
                ->where('active', true)
                ->pluck('id');

            foreach ($enrollments as $id) {
                $this->calculateFinal($id);
            }
        });
    }

    private function calculateWeightedAverage(int $enrollmentId, $activities): float
    {
        $totalWeight = $activities->sum('percentage');

        if ($totalWeight == 0) return 0;

        $sum = 0;

        foreach ($activities as $activity) {
            $grade = Grade::where('enrollment_id', $enrollmentId)
                ->where('activity_id', $activity->id)
                ->value('value') ?? 0;

            $sum += $grade * ($activity->percentage / $totalWeight);
        }

        return round($sum, 2);
    }

    private function updateRanking(int $enrollmentId): void
    {
        $enrollment = Enrollment::findOrFail($enrollmentId);

        $rankings = Final_result::query()
            ->join('enrollments', 'final_results.enrollment_id', '=', 'enrollments.id')
            ->where('enrollments.grade_id', $enrollment->grade_id)
            ->where('enrollments.year_id', $enrollment->year_id)
            ->orderByDesc('final_results.final_average')
            ->select('final_results.id')
            ->get();

        foreach ($rankings as $index => $r) {
            Final_result::where('id', $r->id)
                ->update(['ranking' => $index + 1]);
        }
    }
}