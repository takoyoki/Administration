<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsApproved
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && !Auth::user()->is_approved) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'ユーザーが承認されていません');
        } elseif (Auth::check() && !Auth::user()->is_approved) {
            return abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}