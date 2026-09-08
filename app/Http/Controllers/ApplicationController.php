<?php

namespace App\Http\Controllers;

use App\Services\UserAuthService;
use Illuminate\Http\Request;
use App\Models\JobListing;
use App\Models\JobListingsUser;
use App\Models\Application;
use App\Http\Requests;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    protected JobListing $jobListing;
    protected JobListingsUser $jobListingsUser;

    protected UserAuthService $userAuthServices;
    protected Application $application;
    public function __construct(JobListing $jobListingModel, JobListingsUser $jobListingsUserModel, Application $applicationModel, UserAuthService $userAuthServices)
    {

        $this->jobListing = $jobListingModel;
        $this->jobListingsUser = $jobListingsUserModel;
        $this->application = $applicationModel;
        $this->userAuthServices = $userAuthServices;
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function store(Request $request,string $job_id,string $userId)
    {

        $user = auth()->user();

        $applicationCreated =  $this->userAuthServices->createApplication( $request,  $job_id,  $userId, $user);




        if (!$applicationCreated->id) {
            return redirect(route('job.apply',['job_id' => $job_id, 'user_id' => $userId]))
                ->with('success', false)
                ->with('message', "uploads Documents failed")
                ->with(compact($request));
        }

        return  redirect(route('user.dashboard'))
        ->with('success', true)->with('message', "You have successfully completed your applicztion");
    }
}
