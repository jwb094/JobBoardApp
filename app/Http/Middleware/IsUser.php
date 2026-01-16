<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\JobListingsUser;

class IsUser
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
        dd($this->JobListingsUser->isApplicant());



        if (!auth()->check() || $this->JobListingsUser->isApplicant()) {
            abort(403, 'User access only.');
        }
        return $next($request);
    }
}
