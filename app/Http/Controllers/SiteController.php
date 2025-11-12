<?php

namespace App\Http\Controllers;

use App\Models\Client\JobApplication;
use App\Models\User;
use App\Models\JobOpening;
use App\Models\Skill;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function otp()
    {
        return view('auth.passwords.otp_password');
    }

    public function store_otp(Request $request)
    {
        $otp_password = trim((string) $request->input('otp_password'));
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in before entering your OTP.');
        }

        if ($otp_password === '') {
            return redirect()->back()->with('error', 'Please enter the 6-digit OTP we sent to your email.');
        }

        if ((string) $user->otp_password !== $otp_password) {
            return redirect()->to('otp-password')->with('error', 'Invalid OTP password, please input the correct OTP.');
        }

        $user->email_verified_at    = now();
        $user->otp_password         = NULL;
        $user->save();

        return redirect()->to('home');
    }

    public function jobs(Request $request)
    {
        $today = now()->format('Y-m-d');
        $searchTerm = trim((string) $request->query('search', ''));

        $jobTitles = JobOpening::where('status', 'Publish')
            ->where('date_until', '>', $today)
            ->orderBy('job_title')
            ->pluck('job_title')
            ->filter()
            ->unique()
            ->values();

        if ($searchTerm !== '') {
            $jobs = JobOpening::with('employer')
                ->where('status', 'Publish')
                ->where('date_until', '>', $today)
                ->where(function ($query) use ($searchTerm) {
                    $query->where('job_title', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('location', 'LIKE', "%{$searchTerm}%");
                })
                ->orderBy('job_title')
                ->get();
        } elseif (auth()->check()) {
            $user = auth()->user()->load('user_skill');
            $applicantSkills = $user->user_skill->array_skills ?? [];
            $applicantSkills = is_array($applicantSkills) ? $applicantSkills : [];

            $jobs = JobOpening::with('employer')
                ->where('date_until', '>', $today)
                ->when($user->city, function ($query) use ($user) {
                    $query->where('location', 'LIKE', '%'.$user->city.'%');
                })
                ->get()
                ->map(function ($job) use ($applicantSkills) {
                    $jobSkills = $job->array_skills;
                    $jobSkills = is_array($jobSkills) ? $jobSkills : [];
                    $matchedCount = count(array_intersect($applicantSkills, $jobSkills));

                    return [
                        'job' => $job,
                        'matched_skills' => $matchedCount,
                    ];
                })
                ->filter(function ($job) {
                    return $job['matched_skills'] > 0;
                })
                ->sortByDesc('matched_skills')
                ->pluck('job')
                ->values();

            if ($jobs->isEmpty()) {
                $jobs = JobOpening::with('employer')
                    ->where('date_until', '>', $today)
                    ->orderBy('created_at', 'desc')
                    ->get();
            }
        } else {
            $jobs = JobOpening::with('employer')
                ->where('date_until', '>', $today)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('site.jobs.index', [
            'jobs' => $jobs,
            'search' => $searchTerm,
            'jobTitles' => $jobTitles,
        ]);
    }

    public function jobDetails($id)
    {
        $job = JobOpening::with('employer')->findOrFail($id);

        $skillIds = $job->array_skills ?? [];
        $skills = collect();
        if (!empty($skillIds)) {
            $skills = Skill::whereIn('id', $skillIds)->orderBy('name')->pluck('name');
        }

        $otherJobs = JobOpening::with('employer')
            ->where('user_id', $job->user_id)
            ->where('id', '!=', $job->id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('site.jobs.show', [
            'job' => $job,
            'skills' => $skills,
            'otherJobs' => $otherJobs,
        ]);
    }

    public function companyProfile($id)
    {
        $company = User::findOrFail($id);

        $jobOpenings = JobOpening::with('employer')
            ->where('user_id', $company->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('site.companies.show', [
            'company' => $company,
            'jobOpenings' => $jobOpenings,
            'totalJobs' => $jobOpenings->count(),
        ]);
    }

    public function apply($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $job = JobOpening::findOrFail($id);

        $application = new JobApplication();
        $application->user_id = auth()->user()->id;
        $application->employer_id = $job->user_id;
        $application->job_id = $job->id;
        $application->status = 'Applied';
        $application->save();

        return redirect()->to('client/applications');
    }
}
