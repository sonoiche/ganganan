<?php

namespace App\Http\Controllers\Client;

use App\Models\User;
use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client\UserSkill;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id            = auth()->user()->id;
        $data['user']       = User::find($user_id);
        $data['skills']     = Skill::orderBy('name')->get();
        return view('client.skills.index', $data);
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
        $content_skills = '';
        $skills = $request['skills'];
        foreach ($skills as $skill) {
            $content_skills .= "'" .$skill. "',";
        }

        UserSkill::updateOrCreate(
            ['user_id' => auth()->user()->id],
            ['skills'  => count($skills) ? substr($content_skills, 0, -1) : '']
        );

        return redirect()->back()->with('success', 'Skill set has been saved.');
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
