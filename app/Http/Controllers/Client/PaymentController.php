<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Models\Client\Payment;
use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
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
        $user_id     = auth()->user()->id;
        $suscription = Subscription::where('user_id', $user_id)->where('status', 'Unpaid')->latest()->first();
        $payment = new Payment();
        if(isset($request['photo']) && $request->has('photo')) {
            $file  = $request->file('photo');
            $photo = time().'.'.$file->getClientOriginalExtension();

            $path = Storage::disk('s3')->putFileAs(
                'ganganan/uploads/subscriptions',
                $file,
                $photo,
                'public'
            );
            
            $payment->user_id           = $user_id;
            $payment->subscription_id   = $suscription->id;
            $payment->proof             = Storage::disk('s3')->url($path);
            $payment->amount            = 50;
            $payment->status            = 'Pending';
            $payment->save();
        }

        return redirect()->to('client/subscription');
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
