<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ActiveUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->email_verified_at === NULL) {
            return redirect()->to('otp-password')->with('error', 'We sent an OTP to your email, please check and put it here.');
        }

        $today = Carbon::now()->format('Y-m-d');
        if (auth()->check() && auth()->user()->role == 'Client' && auth()->user()->subscription->valid_until <= $today) {
            return redirect()->to('/client/subscription/create')->with('error', 'Pay the monthy subscription to use the services.');
        }

        return $next($request);
    }
}
