<?php

namespace App\Http\Controllers\Client;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Client\Employment;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\EmploymentRequest;

class EmploymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id             = auth()->user()->id;
        $data['user']        = User::find($user_id);
        $data['employments'] = Employment::where('user_id', $user_id)->orderBy('employment_date', 'desc')->get();
        return view('client.employments.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user_id             = auth()->user()->id;
        $data['user']        = User::find($user_id);
        return view('client.employments.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmploymentRequest $request)
    {
        $employment = new Employment();
        $employment->user_id            = auth()->user()->id;
        $employment->name               = $request['name'];
        $employment->employment_date    = $request['employment_date'];
        $employment->employer           = $request['employer'];
        $employment->save();

        return redirect()->to('client/employments')->with('success', 'Employment has been saved.');
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
        $user_id             = auth()->user()->id;
        $data['user']        = User::find($user_id);
        $data['employment']  = Employment::find($id);
        return view('client.employments.create', $data);
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
