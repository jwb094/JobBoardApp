<?php

namespace App\Services;

use App\Models\Category;
use App\Models\JobListing as JL;
use App\Models\SavedJob;

class JobListingService
{

    protected JL $jobListing;
    protected SavedJob $savedJob;
    public function __construct(SavedJob $savedJobModel,    JL $jobListingsModel)
    {
        $this->savedJob = $savedJobModel;
        $this->jobListing = $jobListingsModel;
    }

    public function home(object $searchData): array
    {

        $categories = Category::all();

        $query = JL::with('category', 'employer')
            ->where('status', 'open');


        if (!empty($searchData->search)) {
            $query->Where('title', 'like', '%' . $searchData->search . '%');
        }

        if ($searchData->category) {
            $query->orWhere('category_id', 'like', '%' . $searchData->category_id . '%');
        }
        $jobListings = $query->latest()->paginate(10);

        return [
            'jobListings' => $jobListings,
            'categories' => $categories
        ];
    }


    public function getJobDesc(string $user, string $id): array
    {

        $job = $this->jobListing->with('company')
            ->findOrFail($id);

        $hasApplied = false;
        $savedJobExists = false;


        if ($user) {
            $hasApplied = $this->jobListing->hasApplied($user, $id);
            $savedJobExists = $this->savedJob
                ->where('user_id', $user)
                ->where('job_id', $job->id)
                ->exists();
        }

        return [
            "job" =>  $job,
            "hasApplied" => $hasApplied,
            "savedJobExists" => $savedJobExists
        ];
    }
}
