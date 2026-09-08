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
     * Show the form for creating a new Job.
     */
    // public function create()
    // {
    //     $categories = $this->categories::with('category')::all();
    //     return view('joblistings.create', compact('categories'));
    // }

    /**
     * Store a newly created Job
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id'   => 'required|exists:categories,id',
            'title'         => 'required|string|max:255',
            'description'   => 'required|string',
            'skillset_About' => 'required|string',
            'benefits'      => 'required|string',
            'location'      => 'required|string',
            'job_type'      => 'required',
            'salary_min'    => 'nullable|integer',
            'salary_max'    => 'nullable|integer',
            'expires_at'    => 'nullable|date',
        ]);

        $data['user_id'] = auth()->id();
        $data['slug'] = Str::slug($data['title']);


        JobListing::create($data);

        return view('job_listings.dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {


        $user_id = auth()->user()->id;
        //dd($user);
        $job = $this->jobListingService->getJobDesc( $user_id, $id);


        return view('joblistings.jobpage',
        // compact('job', 'user', 'savedJobExists', 'hasApplied')
         [
            'job' => $job['job'], 
            'user' => auth()->user(), 
            'savedJobExists' => $job['savedJobExists'],
            'hasApplied'=> $job['hasApplied']

         ]
         );
    }

    /**
     * Show Job Details
     */
    // public function edit(string $id)
    // {

    //     $job = $this->jobListing::findOrFail($id);
    //     $categories = $this->categories::all();
    //     return view('job', ['job' => $job,  'categories' => $categories]);
    // }

    /**
     * Update a Job Details.
     */
    // public function update(Request $request, string $id)
    // {
    //     //
    //     $data = $request->validate([
    //         'category_id' => 'required|exists:categories,id',
    //         'title'       => 'required|string|max:255',
    //         'company_background'       => 'required|string',
    //         'address'       => 'required|string',
    //         'description'   => 'required|string',
    //         'skillset_About' => 'required|string',
    //         'benefits'      => 'required|string',
    //         'location'    => 'required|string',
    //         'job_type'    => 'required',
    //         'salary_min'  => 'nullable|integer',
    //         'salary_max'  => 'nullable|integer',
    //         'expires_at'  => 'nullable|date',
    //     ]);


    //     return view('job_listings.dashboard', compact('jobDesc'));
    // }

    /**
     * Remove A Job.
     */
    // public function destroy(string $id)
    // {
    //     //
    //     $jobDesc = $this->jobListing::find($id);
    //     $jobDesc->delete();
    //     return redirect('/dashboard');
    // }

    /**
     * Show Job Application form page
     */
    public function apply($id)
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
