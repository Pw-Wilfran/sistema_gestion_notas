<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;
use App\Services\GradeService;

class GradeController extends Controller
{

    public function __construct(private GradeService $service) {}

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
            'enrollment_id' => 'required|integer',
            'activity_id'   => 'required|integer',
            'value'         => 'required|numeric'
        ]);

        return $this->service->store(
            $data['enrollment_id'],
            $data['activity_id'],
            $data['value']
        );
    }

    // Bulk store
    public function storeBulk(Request $request)
    {
        $data = $request->validate([
            'activity_id' => 'required|integer',
            'grades'      => 'required|array'
        ]);

        $this->service->storeBulk($data['activity_id'], $data['grades']);

        return response()->json(['message' => 'Grades saved']);
    }

    // Get grades by student and period
    public function byStudentPeriod($enrollmentId, $periodId)
    {
        return $this->service->getByStudentAndPeriod($enrollmentId, $periodId);
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
