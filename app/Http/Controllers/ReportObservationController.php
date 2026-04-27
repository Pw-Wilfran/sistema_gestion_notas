<?php

namespace App\Http\Controllers;

use App\Models\Period_result;
use App\Models\Report_observation;
use Illuminate\Http\Request;
use App\Models\Final_result;
use App\Models\Grade;
use App\Services\ReportService;

class ReportObservationController extends Controller
{
    public function __construct(private ReportService $service) {}

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
        //
    }

    /**
     * Display the specified resource.
     */
    // Get report
    public function show($enrollmentId, $periodId)
    {
        return $this->service->generateReport($enrollmentId, $periodId);
    }

    // Save observation
    public function saveObservation(Request $request)
    {
        $data = $request->validate([
            'enrollment_id' => 'required|integer',
            'period_id'     => 'required|integer',
            'teacher_id'    => 'required|integer',
            'text'          => 'required|string'
        ]);

        return $this->service->saveObservation(
            $data['enrollment_id'],
            $data['period_id'],
            $data['teacher_id'],
            $data['text']
        );
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
