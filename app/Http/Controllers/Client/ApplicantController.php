<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
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

        $matchedApplicants = collect();

        foreach ($jobs as $job) {
            $jobSkills = $job->array_skills;
            $applicants = User::where('role', 'User')
                ->whereIn('id', $applicant_ids)
                ->where('city', 'LIKE', '%'.$job->location.'%')
                ->where('status', 'Active')
                ->get()->map(function ($applicant) use ($jobSkills) {
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

        $data['applicants'] = [];
        foreach ($matchedApplicants as  $matchedApplicant) {
            $data['applicants'][] = $matchedApplicant['applicant'];
        }

        return view('client.applicants.index', $data);
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
