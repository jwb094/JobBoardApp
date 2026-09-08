<?php

namespace App\Services;

use App\Models\Category;
use App\Models\JobListing;

class JobListingService{


    public function home(object $searchData){

    $categories = Category::all();

    $query = JobListing::with('category', 'employer')
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
}