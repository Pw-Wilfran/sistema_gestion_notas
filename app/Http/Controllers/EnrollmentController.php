<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Services\EnrollmentService;



class EnrollmentController extends Controller
{
    public function __construct(private EnrollmentService $service) {}
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
        $data = $request->validate([
            'student_id' => 'required|integer',
            'grade_id'   => 'required|integer',
            'year_id'    => 'required|integer'
        ]);

        return $this->service->enroll(
            $data['student_id'],
            $data['grade_id'],
            $data['year_id']
        );
    }

    public function cancel($id)
    {
        $this->service->cancel($id);
        return response()->json(['message' => 'Enrollment cancelled']);
    }

    public function list($gradeId, $yearId)
    {
        return $this->service->getByGradeAndYear($gradeId, $yearId);
    }

    /**
     * Display the specified resource.
     */
    public function show(Enrollment $enrollment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Enrollment $enrollment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Enrollment $enrollment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enrollment $enrollment)
    {
        //
    }
}
