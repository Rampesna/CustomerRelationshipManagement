<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MobileDetect
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ((new \App\Helper\MobileDetect)->isMobile()) {
            return redirect()->route('mobile.dashboard.index');
        }

        return $next($request);
    }
}
