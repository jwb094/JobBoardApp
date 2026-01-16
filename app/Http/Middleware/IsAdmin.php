<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\JobListingsUser;

class IsAdmin
{
    protected JobListingsUser $JobListingsUser;
    public function __construct(JobListingsUser $jobListingsUserModel)

    {
        $this->JobListingsUser = $jobListingsUserModel;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Admin access only.');
        }
        return $next($request);
    }
}
