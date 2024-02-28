<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    public function handle($request, Closure $next)
    {
        // Check if the authenticated user has the 'admin' role or a specific permission
        if (auth()->user()->role == 'admin') {
            return $next($request);
        }

        // If not authorized, redirect or show an error message
        return redirect()->route('home')->with('error', 'Não estas autorizado a fazer esta operação.');
    }

}
