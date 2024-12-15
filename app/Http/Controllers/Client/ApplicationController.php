<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client\JobApplication;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $data['applications'] = JobApplication::with(['user','job'])->where('user_id', $user_id)->latest()->get();
        return view('client.applications.index', $data);
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
    public function show(string $id, Request $request)
    {
        $job_id = $request['job_id'];
        $application = JobApplication::where('user_id', $id)
            ->where('job_id', $job_id)
            ->where('status', 'Applied')
            ->first();

        $application->status = 'Hired';
        $application->save();

        return redirect()->to('client/hired');
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
        $application = JobApplication::find($id);
        $application->delete();

        return response()->json(200);
    }
}
