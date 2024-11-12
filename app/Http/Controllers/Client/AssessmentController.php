<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client\Assessment;
use App\Models\Client\AssessmentClient;
use App\Models\Client\AssessmentTest;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['assessments'] = Assessment::with(['client' => function ($query) {
                $query->where('user_id', auth()->user()->id);
            }])
            ->latest()
            ->get();

        return view('client.assessments.index', $data);
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
        $answers = $request['answers'];
        $assessment_id = $request['assessment_id'];
        $correct = 0;

        $assessment = Assessment::find($assessment_id);
        $questions  = AssessmentTest::where('assessment_id', $assessment_id)->get();
        foreach ($questions as $key => $question) {
            if($question->answer == $answers[$key]) {
                $correct++;
            }
        }

        $score = ($correct / count($questions)) * 100;

        $user_assess = new AssessmentClient();
        $user_assess->assessment_id = $assessment_id;
        $user_assess->user_id       = auth()->user()->id;
        $user_assess->correct       = $correct;
        $user_assess->items         = count($questions);
        $user_assess->status        = ($score > $assessment->passing_grade) ? 'Passed' : 'Failed';
        $user_assess->score         = $score;
        $user_assess->save();

        return redirect()->to('client/assessments');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['assessment'] = Assessment::find($id);
        $data['questions']  = AssessmentTest::where('assessment_id', $id)->get();

        return view('client.assessments.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
