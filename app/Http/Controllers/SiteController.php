<?php

namespace App\Http\Controllers;

use App\Models\Client\JobApplication;
use App\Models\User;
use App\Models\JobOpening;
use Illuminate\Http\Request;
use App\Models\Client\UserSkill;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    public function otp()
    {
        return view('auth.passwords.otp_password');
    }

    public function store_otp(Request $request)
    {
        $otp_password   = $request['otp_password'];
        $user           = User::where('otp_password', $otp_password)->first();

        if(!isset($user->id)) {
            return redirect()->to('otp-password')->with('error', 'Invalid OTP password, please input the correct OTP.');
        }

        $user->email_verified_at    = now();
        $user->otp_password         = NULL;
        $user->save();

        return redirect()->to('home');
    }

    public function jobs()
    {
        $today          = now()->format('Y-m-d');
        $applicant_ids  = UserSkill::pluck('user_id');
        $applicants = User::where('role', 'User')
            ->with('user_skill')
            ->where('status', 'Active')
            ->whereIn('id', $applicant_ids)
            ->get();

        $matchedJobs    = collect();
        
        foreach ($applicants as $applicant) {
            $applicantSkills = $applicant->user_skill->array_skills ?? [];

            $jobs = JobOpening::where('status', 'Publish')
                ->when(auth()->check(), function($query) {
                    return $query->where('location', 'LIKE', '%'.auth()->user()->city.'%');
                })
                ->where('date_until', '>', $today)
                ->get()
                ->map(function ($job) use ($applicantSkills) {
                    $jobSkills      = $job->array_skills;
                    $matchedCount   = count(array_intersect($applicantSkills, $jobSkills));
                    
                    return [
                        'job'               => $job,
                        'matched_skills'    => $matchedCount,
                    ];
            });

            foreach ($jobs as $job) {
                if ($job['matched_skills'] > 0) {
                    $matchedJobs->push($job);
                }
            }
        }

        // Use unique() to filter out duplicates based on job ID
        $matchedJobs = $matchedJobs->unique(function ($item) {
            return $item['job']->id;
        });

        // Order by the number of matched skills
        $matchedJobs = $matchedJobs->sortByDesc('matched_skills');
        
        $data['jobs'] = [];
        foreach ($matchedJobs as  $matchedJob) {
            $data['jobs'][] = $matchedJob['job'];
        }
        
        return view('site.jobs.index', $data);
    }

    public function apply($id)
    {
        $job = JobOpening::find($id);

        $application = new JobApplication();
        $application->user_id = auth()->user()->id;
        $application->employer_id = $job->user_id;
        $application->job_id = $job->id;
        $application->status = 'Applied';
        $application->save();

        return redirect()->to('client/applications');
    }
}
