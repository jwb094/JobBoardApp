<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (!auth()->check() || !auth()->user()->isEmployer()) {
            abort(403, 'Only employers can access this resource.');
        }

        //dd("middleware");
        return $next($request);
    }


    public function checkAdmin(Request $request, Closure $next): Response
    {

        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Admin access only.');
        }
    }
}
