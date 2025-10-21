<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class TrackReferralMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // 1️⃣ If "tracking_id" is passed in URL, store it in cookie and session
        if ($request->has('tracking_id')) {
            $trackingId = $request->get('tracking_id');
            session(['tracking_id' => $trackingId]);
            Cookie::queue('tracking_id', $trackingId, 60 * 24 * 30); // 30 days
        }

        // 2️⃣ If session lost but cookie exists, restore it
        if (!session()->has('tracking_id') && $request->hasCookie('tracking_id')) {
            session(['tracking_id' => $request->cookie('tracking_id')]);
        }

        return $next($request);
    }
}
