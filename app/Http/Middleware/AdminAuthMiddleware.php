<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminAuthMiddleware
{
    public function handle(Request $request, Closure $next): mixed
    {
       if (Auth::user() && Auth::user()->role == 'admin') {
            return $next($request);
        }

        return redirect()->route('home.index');
    }

    
}
