<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client\JobApplication;
use App\Models\Client\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $application_id = $request['application_id'];
        $application    = JobApplication::find($application_id);
        $status = $request['status'];
        $review = new Review();
        $review->rating         = $request['rating'];
        $review->review         = $request['review'];
        $review->user_id        = $application->user_id;
        $review->employer_id    = auth()->user()->id;
        $review->save();

        if(isset($status)) {
            $application->status = 'Completed';
            $application->save();
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $application = JobApplication::find($id);
        $application->status = 'Completed';
        $application->save();

        return response()->json(200);
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
