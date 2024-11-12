<?php

namespace App\Http\Controllers\Client;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id        = auth()->user()->id;
        $data['user']   = User::find($user_id);
        return view('client.profile.index', $data);
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
    public function update(ProfileRequest $request, string $id)
    {
        $user = User::find($id);
        $user->fname            = $request['fname'];
        $user->mname            = $request['mname'];
        $user->lname            = $request['lname'];
        $user->email            = $request['email'];
        $user->contact_number   = $request['contact_number'];

        if(isset($request['password'])){
            $user->password = bcrypt($request['password']);
        }

        $user->address          = $request['address'];
        $user->city             = $request['city'];
        $user->zip_code         = $request['zip_code'];
        $user->user_type        = $request['user_type'];

        if(isset($request['photo']) && $request->has('photo')) {
            $file  = $request->file('photo');
            $photo = time().'.'.$file->getClientOriginalExtension();

            $path = Storage::disk('s3')->putFileAs(
                'ganganan/uploads/users',
                $file,
                $photo,
                'public'
            );
            
            $user->photo = Storage::disk('s3')->url($path);
        }

        $user->save();

        return redirect()->back()->with('success', 'Client information has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
