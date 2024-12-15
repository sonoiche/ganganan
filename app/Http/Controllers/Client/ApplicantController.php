<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client\JobApplication;
use App\Models\Client\UserSkill;
use App\Models\JobOpening;
use App\Models\User;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $today   = now()->format('Y-m-d');
        $applicant_ids = UserSkill::pluck('user_id');

        $jobs = JobOpening::where('status', 'Publish')
            ->where('user_id', $user_id)
            ->where('date_until', '>', $today)
            ->get();

        $matchedApplicants  = collect();
        $data['applicants'] = [];

        if(count($jobs)) {
            foreach ($jobs as $job) {
                $location   = $job->location; 
                $jobSkills  = $job->array_skills;
                $applicants = User::where('role', 'User')
                    ->whereIn('id', $applicant_ids)
                    ->when($location, function ($query, $location) {
                        return $query->where('city', 'LIKE', '%'.$location.'%');
                    })
                    ->where('status', 'Active')
                    ->get()
                    ->map(function ($applicant) use ($jobSkills) {
                        $applicantSkills = $applicant->user_skill->array_skills ?? [];
                        $matchedCount = count(array_intersect($jobSkills, $applicantSkills));
                        return [
                            'applicant' => $applicant,
                            'matched_skills' => $matchedCount,
                        ];
                    });

                    foreach ($applicants as $applicant) {
                        if ($applicant['matched_skills'] > 0) {
                            $matchedApplicants[] = $applicant;
                        }
                    }
            }

            $matchedApplicants = $matchedApplicants->unique(function ($item) {
                return $item['applicant']->id;
            });
            
            $matchedApplicants = $matchedApplicants->sortByDesc('matched_skills');

            foreach ($matchedApplicants as  $matchedApplicant) {
                $data['applicants'][] = $matchedApplicant['applicant'];
            }
        }

        return view('client.applicants.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $job_id         = $request['job_id'];
        $applicant_ids  = JobApplication::where('job_id', $job_id)->pluck('user_id');
        $data['applicants'] = User::whereIn('id', $applicant_ids)->with(['user_skill'])->get();
        return view('client.applicants.create', $data);
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
    public function show(string $id)
    {
        $data['applicant'] = User::find($id);
        return view('client.applicants.show', $data);
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
