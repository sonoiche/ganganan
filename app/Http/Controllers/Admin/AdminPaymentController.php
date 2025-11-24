<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Client\Payment;
use App\Models\Client\Subscription;
use App\Models\User;
use App\Http\Controllers\Controller;

class AdminPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['payments'] = Payment::where('status', 'Pending')->latest()->get();
        return view('admin.payments.index', $data);
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
        $payment = Payment::find($id);
        $payment->status = 'Paid';
        $payment->save();

        // Get the subscription and user
        $subscribe = Subscription::find($payment->subscription_id);
        $user = User::find($subscribe->user_id);
        
        // Update user status from Inactive to Active if currently Inactive
        if ($user && $user->status === 'Inactive') {
            $user->status = 'Active';
            $user->save();
        }

        // Update all existing subscriptions for this user to Paid status
        Subscription::where('user_id', $subscribe->user_id)
            ->update(['status' => 'Paid']);

        // generate new invoice for the next 30 days (not calendar month)
        $valid_until    = Carbon::parse($subscribe->valid_until)->addDays(30)->format('Y-m-d');
        $subscription   = new Subscription();
        $subscription->status           = 'Unpaid';
        $subscription->invoice_number   = strtoupper(Str::random(10));
        $subscription->valid_until      = $valid_until;
        $subscription->amount           = 50;
        $subscription->user_id          = $subscribe->user_id;
        $subscription->save();

        return redirect()->back();
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
        $payment = Payment::find($id);
        $payment->delete();

        return response()->json(200);
    }
}
