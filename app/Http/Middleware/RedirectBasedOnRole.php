<?php

namespace App\Http\Middleware;

use Closure;

class RedirectBasedOnRole
{
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->role === 0) {
            return redirect()->route('admin.dashboard');
        } elseif ($request->user() && $request->user()->role === 1) {
            return redirect()->route('worker.dashboard');
        }
        
        return $next($request);
    }
}