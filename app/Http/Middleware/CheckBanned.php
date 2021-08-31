<?php

namespace App\Http\Middleware;

use Closure;
use Str;

class CheckBanned
{
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->banned_until && now()->lessThan(auth()->user()->banned_until)) {
            $banned_days = now()->diffInDays(auth()->user()->banned_until);
            auth()->logout();

            // old code 
            // if ($banned_days > 14) {
            //     $message = 'Your account has been suspended. Please contact administrator.';
            // } else {
            //     $message = 'Your account has been suspended for ' . $banned_days . ' ' . Str::plural('day', $banned_days) . '. Please contact administrator.';
            // }

            // new 
            $message = "Wrong Credentials!";

            return redirect()->route('login')->withMessage($message);
        }

        return $next($request);
    }
}
