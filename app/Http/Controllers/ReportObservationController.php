<?php

namespace App\Http\Controllers;

use App\Models\Period_result;
use App\Models\Report_observation;
use Illuminate\Http\Request;
use App\Models\Final_result;
use App\Models\Grade;

class ReportObservationController extends Controller
{
    protected $service;

    public function getStudentReport($enrollmentId)
    {
        return Period_result::with(['gradeSubject.subject'])
            ->where('enrollment_id', $enrollmentId)
            ->get();
    }

    public function getFinalReport($enrollmentId)
    {
        return Final_result::where('enrollment_id', $enrollmentId)->first();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $max = setting('max_grade', 5.0);

        if ($request->value > $max) {
            return response()->json([
                'error' => 'Grade exceeds maximum allowed'
            ], 422);
        }

        $grade = Grade::create($request->all());

        $this->service->storePeriodResult(
            $request->enrollment_id,
            $request->period_id,
            $request->grade_subject_id
        );

        return $grade;
    }

    /**
     * Display the specified resource.
     */
    public function show(Report_observation $report_observation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report_observation $report_observation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report_observation $report_observation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report_observation $report_observation)
    {
        //
    }
}
