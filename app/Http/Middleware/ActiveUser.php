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

        // Check subscription for users (not admins)
        // Allow access to subscription and payment pages even without active subscription
        $allowedPaths = ['client/subscription', 'client/payments'];
        $currentPath = $request->path();
        $isSubscriptionRelated = false;
        
        foreach ($allowedPaths as $path) {
            if (strpos($currentPath, $path) === 0) {
                $isSubscriptionRelated = true;
                break;
            }
        }

        if (auth()->check() && auth()->user()->role == 'User' && !$isSubscriptionRelated) {
            $user = auth()->user();
            $subscription = $user->subscription;
            
            // Check if subscription exists and is active
            if (!$subscription || !$user->hasActiveSubscription()) {
                return redirect()->to('/client/subscription/create')->with('error', 'You must have an active subscription to access this feature. Please subscribe first.');
            }
        }

        return $next($request);
    }
}
