<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class BannedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!(Auth::check() && !Auth::user()->isBlocked()))
        {
            return redirect('home')->withErrors('You are banned from that activity! Contact an administrator to do that! admin@marketplace.lv');
        }
        return $next($request);
    }
}
