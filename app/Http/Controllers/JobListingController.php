<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobListing;
use App\Models\Category;
use App\Models\SavedJob;
use App\Services\JobListingService;
use Illuminate\Support\Str;

class JobListingController extends Controller
{

    protected JobListing $jobListing;
    protected Category $categories;

    protected JobListingService $jobListingService;

    protected SavedJob $savedJob;
    public function __construct(
        JobListing $jobListingsModel,
        Category $categoryModel,
        SavedJob $savedJobModel,
        JobListingService $jobListingService
    ) {
        $this->jobListing = $jobListingsModel;
        $this->categories = $categoryModel;
        $this->savedJob = $savedJobModel;
        $this->jobListingService = $jobListingService;
    }

    /**
     * Display a listing of Job & filtered Search Jobs.
     */
    public function index(Request $request)
    {

       $jobs = $this->jobListingService->home($request);

  
        return view('home', 
                [
                    'categories' => $jobs['categories'], 
                    'jobListings' => $jobs['jobListings']
                ]);
    }




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {


        $user_id = auth()->user()->id;
        $job = $this->jobListingService->getJobDesc( $user_id, $id);


        return view('joblistings.jobpage',
         [
            'job' => $job['job'], 
            'user' => auth()->user(), 
            'savedJobExists' => $job['savedJobExists'],
            'hasApplied'=> $job['hasApplied']

         ]
         );
    }

    public function apply(string $id)
    {
        //
        $user = [];
        if (auth()->user()) {
            $user = auth()->user();
        }

        $job = $this->jobListing::findOrFail($id);

        return view('joblistings.job_application_form', ['job' => $job, 'user' => $user]);
    }
}
