<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Models\Client\Payment;
use App\Http\Controllers\Controller;
use App\Models\Client\Subscription;
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
        $subscription = Subscription::where('user_id', $user_id)
            ->where('status', 'Unpaid')
            ->latest()
            ->first();

        if (!$subscription) {
            return redirect()->back()->with('error', 'No unpaid subscription found to attach the proof of payment.');
        }

        if (!$request->hasFile('photo')) {
            return redirect()->back()->with('error', 'Please upload a valid proof of payment.');
        }

        $file  = $request->file('photo');
        $photo = time().'.'.$file->getClientOriginalExtension();

        $path = Storage::disk('cj')->putFileAs(
            'ganganan/uploads/subscriptions',
            $file,
            $photo,
            'public'
        );

        $baseAmount = $subscription->amount ?? 0;
        if ($baseAmount <= 0) {
            $baseAmount = 50;
        }

        $additionalFee = round($baseAmount * 0.06, 2);
        $totalAmount = round($baseAmount + $additionalFee, 2);

        $payment = new Payment();
        $payment->user_id           = $user_id;
        $payment->subscription_id   = $subscription->id;
        $payment->proof             = Storage::disk('cj')->url($path);
        $payment->amount            = $totalAmount;
        $payment->status            = 'Pending';
        $payment->save();

        return redirect()->to('client/subscription')->with('success', 'Proof of payment uploaded successfully.');
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
