<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;
use App\Services\GradeService;

class GradeController extends Controller
{
    protected $service;
    
    public function __construct(GradeService $service)
    {
        $this->service = $service;
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
        $validated = $request->validate([
            'enrollment_id' => 'required|exists:enrollments,id',
            'activity_id' => 'required|exists:activities,id',
            'value' => 'required|numeric|min:0',
            'period_id' => 'required|exists:periods,id',
            'grade_subject_id' => 'required|exists:grade_subject,id',
        ]);

        $grade = Grade::create([
            'enrollment_id' => $validated['enrollment_id'],
            'activity_id' => $validated['activity_id'],
            'value' => $this->service->normalizeGrade($validated['value']),
        ]);

        // 🔥 recalcular automáticamente
        $this->service->storePeriodResult(
            $validated['enrollment_id'],
            $validated['period_id'],
            $validated['grade_subject_id']
        );

        return response()->json($grade, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grade $grade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Grade $grade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grade $grade)
    {
        //
    }

}
