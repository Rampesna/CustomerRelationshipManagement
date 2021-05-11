<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Authority
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (!is_null($permission) && !auth()->user()->authority($permission)) {
            return abort(403);
        }

        return $next($request);
    }
}
