<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Client\Assessment;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ExamRequest;
use App\Models\Client\AssessmentTest;

class AssessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['assessments'] = Assessment::latest()->get();
        return view('admin.assessments.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.assessments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExamRequest $request)
    {
        $assessment = new Assessment();
        $assessment->name           = $request['name'];
        $assessment->items          = $request['items'];
        $assessment->passing_grade  = $request['passing_grade'];
        $assessment->status         = $request['status'];
        $assessment->save();

        return redirect()->to('admin/assessment-tests?assessment_id=' . $assessment->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['assessment'] = Assessment::find($id);
        return view('admin.assessments.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $assessment = Assessment::find($id);
        $assessment->name           = $request['name'];
        $assessment->items          = $request['items'];
        $assessment->passing_grade  = $request['passing_grade'];
        $assessment->status         = $request['status'];
        $assessment->save();

        return redirect()->to('admin/assessments');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $assessment = Assessment::find($id);
        AssessmentTest::where('assessment_id', $assessment->id)->delete();
        $assessment->delete();

        return response()->json(200);
    }
}
