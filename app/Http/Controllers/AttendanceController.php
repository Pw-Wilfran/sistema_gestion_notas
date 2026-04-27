<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Services\AttendanceService;



class AttendanceController extends Controller
{

    public function __construct(private AttendanceService $service) {}

    public function storeBulk(Request $request)
    {
        $data = $request->validate([
            'assignment_id' => 'required|integer',
            'date'          => 'required|date',
            'records'       => 'required|array'
        ]);

        $this->service->storeBulk(
            $data['assignment_id'],
            $data['date'],
            $data['records']
        );

        return response()->json(['message' => 'Attendance saved']);
    }

    public function summary($enrollmentId, $assignmentId)
    {
        return $this->service->studentSummary($enrollmentId, $assignmentId);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
