<?php

namespace App\Http\Controllers\Client;

use App\Models\Skill;
use App\Models\JobOpening;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Client\JobRequest;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()->role == 'Admin') {
            return redirect()->to('home');
        }

        $user_id        = auth()->user()->id;
        $data['jobs']   = JobOpening::with(['applications' => function ($query) {
                return $query->where('status', 'Applied');
            }])->where('user_id', $user_id)->latest()->get();

        return view('client.jobs.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(auth()->user()->role == 'Admin') {
            return redirect()->to('home');
        }

        // Check if user has active subscription
        if (!auth()->user()->hasActiveSubscription()) {
            return redirect()->to('client/subscription/create')
                ->with('error', 'You must have an active subscription to post jobs. Please subscribe first.');
        }

        $data['skills'] = Skill::orderBy('name')->get();
        return view('client.jobs.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobRequest $request)
    {
        // Check if user has active subscription
        if (!auth()->user()->hasActiveSubscription()) {
            return redirect()->to('client/subscription/create')
                ->with('error', 'You must have an active subscription to post jobs. Please subscribe first.');
        }

        $content_skills = '';
        $skills = $request['skills'] ?? [];
        foreach ($skills as $skill) {
            $content_skills .= "'" .$skill. "',";
        }

        $job = new JobOpening();
        $job->user_id           = auth()->user()->id;
        $job->job_order_number  = strtoupper(Str::random(10));
        $job->job_title         = $request['job_title'];
        $job->workers_need      = $request['workers_need'];
        $job->workers_gender    = $request['workers_gender'];
        $job->salary            = $request['salary'];
        $job->salary_rate       = $request['salary_rate'];
        $job->status            = $request['status'];
        $job->date_needed       = $request['date_needed'];
        $job->date_until        = $request['date_until'];
        $job->skills            = count($skills) ? substr($content_skills, 0, -1) : '';
        $job->job_description   = $request['job_description'];
        $job->location          = $request['location'];
        
        if(isset($request['photo']) && $request->has('photo')) {
            $file  = $request->file('photo');
            $photo = time().'.'.$file->getClientOriginalExtension();

            $path = Storage::disk('s3')->putFileAs(
                'ganganan/uploads/jobs',
                $file,
                $photo,
                'public'
            );
            
            $job->photo = Storage::disk('s3')->url($path);
        }

        $job->save();

        return redirect()->to('client/jobs')->with('success', 'Job has been added successfully.');
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
        if(auth()->user()->role == 'Admin') {
            return redirect()->to('home');
        }
        
        $data['skills'] = Skill::orderBy('name')->get();
        $data['job']    = JobOpening::find($id);
        return view('client.jobs.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $content_skills = '';
        $skills = $request['skills'];
        foreach ($skills as $skill) {
            $content_skills .= "'" .$skill. "',";
        }

        $job = JobOpening::find($id);
        $job->job_title         = $request['job_title'];
        $job->workers_need      = $request['workers_need'];
        $job->workers_gender    = $request['workers_gender'];
        $job->salary            = $request['salary'];
        $job->salary_rate       = $request['salary_rate'];
        $job->status            = $request['status'];
        $job->date_needed       = $request['date_needed'];
        $job->date_until        = $request['date_until'];
        $job->skills            = count($skills) ? substr($content_skills, 0, -1) : '';
        $job->job_description   = $request['job_description'];
        $job->location          = $request['location'];
        
        if(isset($request['photo']) && $request->has('photo')) {
            $file  = $request->file('photo');
            $photo = time().'.'.$file->getClientOriginalExtension();

            $path = Storage::disk('s3')->putFileAs(
                'ganganan/uploads/jobs',
                $file,
                $photo,
                'public'
            );
            
            $job->photo = Storage::disk('s3')->url($path);
        }

        $job->save();

        return redirect()->to('client/jobs')->with('success', 'Job has been saved successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $job = JobOpening::find($id);
        $job->delete();

        return response()->json(200);
    }
}
