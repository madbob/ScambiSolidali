<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    public function handle($request, Closure $next, $guard = null)
    {
        $user = $request->user();
        if ($user->role != 'admin') {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
