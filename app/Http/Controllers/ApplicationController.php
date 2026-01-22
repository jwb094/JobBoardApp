<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobListing;
use App\Models\JobListingsUser;

class ApplicationController extends Controller
{
    protected JobListing $jobListing;
    protected JobListingsUser $jobListingsUser;
    public function __construct(JobListing $jobListingModel, JobListingsUser $jobListingsUserModel)
    {

        $this->jobListing = $jobListingModel;
        $this->jobListingsUser = $jobListingsUserModel;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function store(Request $request, JobListing $jobListing)
    {
        if (!auth()->user()->isApplicant()) {
            abort(403);
        }

        // $request->validate([
        //     'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
        //     'cover_letter' => 'nullable|string',
        // ]);

        // if ($jobListing->applications()
        //     ->where('user_id', auth()->id())
        //     ->exists()
        // ) {
        //     return back()->with('error', 'You already applied.');
        // }

        // $resumePath = $request->file('resume')
        //     ->store('resumes', 'public');

        // Application::create([
        //     'job_listing_id' => $jobListing->id,
        //     'user_id'        => auth()->id(),
        //     'resume_path'    => $resumePath,
        //     'cover_letter'   => $request->cover_letter,
        // ]);

        // return back()->with('success', 'Application submitted.');
    }
}
