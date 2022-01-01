<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isRegistrationCompleted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(is_null(auth()->user()->dob) && is_null(auth()->user()->address) &&
            is_null(auth()->user()->phone) && is_null(auth()->user()->country) &&
            is_null(auth()->user()->currency) && is_null(auth()->user()->dob)){
            return redirect()->route('setupForm');
        }
        return $next($request);
    }
}
