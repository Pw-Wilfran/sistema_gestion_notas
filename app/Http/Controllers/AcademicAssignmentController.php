<?php

namespace App\Http\Controllers;

use App\Models\Academic_assignment;
use Illuminate\Http\Request;
use App\Services\AcademicAssignmentService;

class AcademicAssignmentController extends Controller
{
    public function __construct(private AcademicAssignmentService $service) {}
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
            'teacher_id'       => 'required|integer',
            'grade_subject_id' => 'required|integer',
            'year_id'          => 'required|integer'
        ]);

        return $this->service->assign(
            $data['teacher_id'],
            $data['grade_subject_id'],
            $data['year_id']
        );
    }

    public function byTeacher($teacherId, $yearId)
    {
        return $this->service->getByTeacher($teacherId, $yearId);
    }

    /**
     * Display the specified resource.
     */
    public function show(Academic_assignment $academic_assignment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Academic_assignment $academic_assignment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Academic_assignment $academic_assignment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Academic_assignment $academic_assignment)
    {
        //
    }
}
