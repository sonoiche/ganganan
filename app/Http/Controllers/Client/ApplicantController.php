<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client\Identification;
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
        $applicantIds = UserSkill::pluck('user_id')->unique();

        $jobs = JobOpening::where('status', 'Publish')
            ->where('user_id', $user_id)
            ->where('date_until', '>', $today)
            ->get();

        $potentialApplicants = User::where('role', 'User')
            ->whereIn('id', $applicantIds)
            ->where('status', 'Active')
            ->with('user_skill')
            ->get();

        $data['applicants'] = [];

        if ($jobs->isNotEmpty() && $potentialApplicants->isNotEmpty()) {
            $scoredApplicants = collect();

            foreach ($jobs as $job) {
                $jobSkills = $job->array_skills;
                $jobLocation = strtolower(trim($job->location ?? ''));

                foreach ($potentialApplicants as $applicant) {
                    $applicantSkills = $applicant->user_skill->array_skills ?? [];
                    $matchedSkillCount = count(array_intersect($jobSkills, $applicantSkills));
                    $skillMatchRatio = count($jobSkills) ? $matchedSkillCount / count($jobSkills) : 0;
                    $skillCoverage = count($applicantSkills) ? $matchedSkillCount / count($applicantSkills) : 0;

                    $applicantLocation = strtolower(trim($applicant->city ?? ''));
                    $locationScore = 0;

                    if ($jobLocation && $applicantLocation) {
                        if ($jobLocation === $applicantLocation) {
                            $locationScore = 1;
                        } elseif (str_contains($jobLocation, $applicantLocation) || str_contains($applicantLocation, $jobLocation)) {
                            $locationScore = 0.85;
                        } else {
                            $similarity = 0;
                            similar_text($jobLocation, $applicantLocation, $similarity);
                            $distance = levenshtein($jobLocation, $applicantLocation);
                            $maxLength = max(strlen($jobLocation), strlen($applicantLocation));
                            $normalizedDistance = $maxLength > 0 ? max(0, 1 - ($distance / $maxLength)) : 0;
                            $locationScore = max($similarity / 100, $normalizedDistance);
                        }
                    }

                    $overallScore = ($skillMatchRatio * 0.6) + ($skillCoverage * 0.2) + ($locationScore * 0.2);

                    $shouldInclude = $matchedSkillCount > 0;

                    if (!$shouldInclude && empty($jobSkills) && $locationScore > 0) {
                        $shouldInclude = true;
                    }

                    if ($shouldInclude && $overallScore > 0) {
                        $scoredApplicants->push([
                            'applicant' => $applicant,
                            'score' => $overallScore,
                            'matched_skills' => $matchedSkillCount,
                            'location_score' => $locationScore,
                        ]);
                    }
                }
            }

            $data['applicants'] = $scoredApplicants
                ->groupBy(fn ($item) => $item['applicant']->id)
                ->map(fn ($items) => $items->sort(function ($a, $b) {
                    if ($a['score'] === $b['score']) {
                        if ($a['matched_skills'] === $b['matched_skills']) {
                            return $b['location_score'] <=> $a['location_score'];
                        }

                        return $b['matched_skills'] <=> $a['matched_skills'];
                    }

                    return $b['score'] <=> $a['score'];
                })->first())
                ->sort(function ($a, $b) {
                    if ($a['score'] === $b['score']) {
                        if ($a['matched_skills'] === $b['matched_skills']) {
                            return $b['location_score'] <=> $a['location_score'];
                        }

                        return $b['matched_skills'] <=> $a['matched_skills'];
                    }

                    return $b['score'] <=> $a['score'];
                })
                ->pluck('applicant')
                ->values()
                ->all();
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
        $data['applicants'] = User::whereIn('id', $applicant_ids)->where('status', 'Active')->with(['user_skill'])->get();
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
        $data['identifications'] = Identification::where('user_id', $id)->latest()->get();
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
