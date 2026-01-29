<?php

namespace App\Http\Controllers;

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

    protected Application $application;
    public function __construct(JobListing $jobListingModel, JobListingsUser $jobListingsUserModel, Application $applicationModel)
    {

        $this->jobListing = $jobListingModel;
        $this->jobListingsUser = $jobListingsUserModel;
        $this->application = $applicationModel;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function store(Request $request, $job_id, $userId)
    {
        // if ($this->jobListing->where('job_id',  $job_id)->where('user_id', auth()->id())->exists()) {
        //     return back()->with('error', 'You already applied.');
        // }
        // if ($jobListing->applications()
        //     ->where('user_id', auth()->id())
        //     ->exists()
        // ) {
        //     return back()->with('error', 'You already applied.');
        // }

        //Create a folder for User applicant to store documents
        $doesPathExists = public_path('uploads/' . auth()->user()->first_name . '-' . auth()->user()->last_name);

        $path = "";
        if (Storage::exists($doesPathExists)) {
            $path =  $doesPathExists;
        }
        //dd($path);

        $data = $request->validate([
            'resume_path' => 'required',
            'cover_letter' => 'required',
        ]);

        // dd($request);

        //create datas array for sql query
        $data['job_id'] = $job_id;
        $data['user_id'] = $userId;
        $data['resume_path'] = $path . '/' . $data['resume_path'];
        $data['cover_letter'] = $path . '/' . $data['cover_letter'];
        $data['status'] = 'Received/Submitted';

        //dd($data);

        $updatedUserDocuments = $this->application::create($data);
        //     'job_listing_id' => $jobListing->id,
        //     'user_id'        => auth()->id(),
        //     'resume_path'    => $resumePath,
        //     'cover_letter'   => $request->cover_letter,
        // ]);

        // return back()->with('success', 'Application submitted.');


        if (!$updatedUserDocuments->id) {
            return redirect(route('user.documents'))->with('success', false)->with('message', "uploads Documents failed")->with(compact($data));
        }

        return  redirect(route('user.dashboard'))->with('success', true)->with('message', "documents  uploaded succesfully");
    }
}
