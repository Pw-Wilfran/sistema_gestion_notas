<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class AttendanceService
{
    /**
     * Bulk attendance register
     */
    public function storeBulk(int $assignmentId, string $date, array $records): void
    {
        DB::transaction(function () use ($assignmentId, $date, $records) {
            foreach ($records as $r) {
                \App\Models\Attendance::updateOrCreate(
                    [
                        'enrollment_id' => $r['enrollment_id'],
                        'assignment_id' => $assignmentId,
                        'date' => $date
                    ],
                    [
                        'status' => $r['status'],
                        'observation' => $r['observation'] ?? null
                    ]
                );
            }
        });
    }

    /**
     * Student attendance summary
     */
    public function studentSummary(int $enrollmentId, int $assignmentId): array
    {
        $records = \App\Models\Attendance::where('enrollment_id', $enrollmentId)
            ->where('assignment_id', $assignmentId)
            ->get();

        $total = $records->count();

        return [
            'total' => $total,
            'present' => $records->where('status', 'P')->count(),
            'absent' => $records->where('status', 'A')->count(),
            'justified' => $records->where('status', 'J')->count(),
            'attendance_percentage' => $total > 0
                ? round($records->where('status', 'P')->count() / $total * 100, 1)
                : 0,
        ];
    }
}