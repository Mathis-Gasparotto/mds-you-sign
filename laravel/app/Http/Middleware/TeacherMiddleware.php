<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class TeacherMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'teacher') {
            return $next($request);
        } elseif (!Auth::check()) {
            return redirect('/login');
        }

        return redirect('/')->with('error', 'Accès interdit.');
    }
}
