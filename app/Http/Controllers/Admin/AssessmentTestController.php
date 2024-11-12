<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Client\Assessment;
use App\Http\Controllers\Controller;
use App\Models\Client\AssessmentTest;
use App\Http\Requests\Admin\QuestionRequest;
use App\Http\Requests\Admin\AssessmentTestRequest;

class AssessmentTestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $assessment_id = $request['assessment_id'];
        $data['assessment'] = Assessment::find($assessment_id);
        $data['questions']  = AssessmentTest::where('assessment_id', $assessment_id)->get();
        return view('admin.assessment-tests.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $assessment_id = $request['assessment_id'];
        $data['assessment'] = Assessment::find($assessment_id);
        return view('admin.assessment-tests.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AssessmentTestRequest $request)
    {
        $options = implode(',', $request['options']);

        $question = new AssessmentTest();
        $question->question         = $request['question'];
        $question->answer           = $request['answer'];
        $question->options          = $options;
        $question->assessment_id    = $request['assessment_id'];
        $question->save();

        return redirect()->to('admin/assessment-tests?assessment_id=' . $question->assessment_id);
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
    public function edit(string $id, Request $request)
    {
        $assessment_id = $request['assessment_id'];
        $data['assessment'] = Assessment::find($assessment_id);
        $data['question']   = AssessmentTest::find($id);
        return view('admin.assessment-tests.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $options = implode(',', $request['options']);

        $question = AssessmentTest::find($id);
        $question->question         = $request['question'];
        $question->answer           = $request['answer'];
        $question->options          = $options;
        $question->assessment_id    = $request['assessment_id'];
        $question->save();

        return redirect()->to('admin/assessment-tests?assessment_id=' . $question->assessment_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $question = AssessmentTest::find($id);
        $question->delete();

        return response()->json(200);
    }
}
