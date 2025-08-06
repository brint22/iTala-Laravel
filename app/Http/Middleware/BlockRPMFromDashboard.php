<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlockRPMFromDashboard
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'registered psychometrician') {
            return redirect('/homepage');
        }

        return $next($request);
    }
}
