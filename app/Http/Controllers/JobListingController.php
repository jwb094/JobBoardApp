<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobListings;
use App\Models\Category;

class JobListingController extends Controller
{

    protected JobListings $jobListings;
    protected Category $categories;
    public function __construct(JobListings $jobListingsModel, Category $categoryModel)
    {
        $this->jobListings = $jobListingsModel;
        $this->categories = $categoryModel;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = $this->jobListings->getLatestJobs();

        //if search
        if (isset($request)) {
            $query = $this->jobListings->filterSearch($query, $request);
        }

        //dd($query);
        //default loading homepage
        if (empty($request)) {
            $query->take(10);
        }

        $jobListings = $query;

        return view('home', [$jobListings]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = $this->categories::all();
        return view('job_listings.create', compact('categories'));
    }

    /**
     * Store a newly created Job
     */
    public function store(Request $request)
    {
        //

        return view('job_listings.dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        $jobDesc = $this->jobListings::findOrFail($id);

        return view('job_listings.dashboard', compact('jobDesc'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $jobDesc = $this->jobListings::findOrFail($id);
        $categories = $this->categories::all();
        return view('job', compact($jobDesc,  $categories));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        return view('job_listings.dashboard', compact('jobDesc'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $jobDesc = $this->jobListings::find($id);
        $jobDesc->delete();
        return redirect('/dashboard');
    }
}
