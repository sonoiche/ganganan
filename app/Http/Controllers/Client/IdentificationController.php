<?php

namespace App\Http\Controllers\Client;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client\Identification;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Client\IdentificationRequest;

class IdentificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id        = auth()->user()->id;
        $data['user']   = User::find($user_id);
        $data['identifications'] = Identification::where('user_id', $user_id)->get();
        return view('client.identifications.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user_id        = auth()->user()->id;
        $data['user']   = User::find($user_id);
        return view('client.identifications.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IdentificationRequest $request)
    {
        $identification = new Identification();
        $identification->user_id             = auth()->user()->id;
        $identification->identification_type = $request['identification_type'];

        if(isset($request['file']) && $request->has('file')) {
            $file  = $request->file('file');
            $photo = time().'.'.$file->getClientOriginalExtension();

            $path = Storage::disk('public')->putFileAs(
                'ganganan/uploads/identifications',
                $file,
                $photo,
                'public'
            );
            
            $identification->file_url = Storage::disk('public')->url($path);
        }

        $identification->save();

        return redirect()->to('client/identifications')->with('success', 'Identification has been saved.');
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
        $user_id        = auth()->user()->id;
        $data['user']   = User::find($user_id);
        $data['identification'] = Identification::find($id);
        return view('client.identifications.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(IdentificationRequest $request, string $id)
    {
        $identification = Identification::find($id);
        $identification->identification_type = $request['identification_type'];

        if(isset($request['file']) && $request->has('file')) {
            $file  = $request->file('file');
            $photo = time().'.'.$file->getClientOriginalExtension();

            $path = Storage::disk('s3')->putFileAs(
                'ganganan/uploads/identifications',
                $file,
                $photo,
                'public'
            );
            
            $identification->file_url = Storage::disk('s3')->url($path);
        }

        $identification->save();

        return redirect()->to('client/identifications')->with('success', 'Identification has been saved.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $identification = Identification::find($id);
        $identification->delete();

        return response()->json(200);
    }
}
