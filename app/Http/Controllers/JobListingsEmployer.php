<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckSignInUserRequest;
use App\Http\Requests\CreateEmployerUserRequest;
use App\Http\Requests\EditJobDescriptionRequest;
use App\Http\Requests\StoreJobDescriptionRequest;
use App\Http\Requests\CreateApplicantUserRequest;
use App\Models\Category;
use App\Services\UserAuthService;
use Illuminate\Http\Request;
use App\Models\JobListingsUser;
use App\Models\Company;
use App\Models\JobListing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Services\EmployerService;
use Illuminate\Support\Str;

class JobListingsEmployer extends Controller
{

    protected JobListingsUser $JobListingsUser;

    protected Category $Category;

    protected JobListing $JobListing;

    protected Company $Company;

    protected  EmployerService $employerService;

    protected UserAuthService $userAuthService;
    public function __construct(Category $categoryModel, JobListingsUser $jobListingsUserModel,  JobListing $jobListingModel, Company $companyModel, EmployerService $employerService,   UserAuthService $userAuthServices)
    {
        $this->JobListingsUser = $jobListingsUserModel;
        $this->Company =  $companyModel;
        $this->JobListing = $jobListingModel;
        $this->Category = $categoryModel;
        $this->employerService = $employerService;
        $this->userAuthService = $userAuthServices;
    }

    /** 
     * Display a listing of the resource.
     */
    public function index()
    {


        $user = auth()->user();

        $dashboardInfo = $this->employerService->dashboard($user);


        return view(
            'employer.dashboard',
            [
                'user' => $user,
                'jobCount' => $dashboardInfo['jobCount'],
                'applicantCount' => $dashboardInfo['applicantCount']
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit_profile(string $id)
    {

        $user = $this->JobListingsUser::findOrFail($id);
        return view('employer.update', compact('user'));
    }

    public function edit_job(string $id)
    {


        $job = $this->JobListing
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $categories = $this->Category::all();
        $formfieldsData = $this->employerService->newJobFormsValue();

        return view(
            'employer.edit_job',
            [
                "job" => $job,
                "categories" => $categories,
                "jobTypes" =>  $formfieldsData['jobTypes'],
                "jobStatuses" =>  $formfieldsData['jobStatuses']
            ]
        );
    }

    public function register()
    {
        return view('employer.register');
    }

    public function newjob()
    {
        $categories = $this->Category::all();
        $formfieldsData = $this->employerService->newJobFormsValue();
        return view(
            'employer.new_job',
            [
                "categories" => $categories,
                "jobTypes" =>  $formfieldsData['jobTypes'],
                "jobStatuses" =>  $formfieldsData['jobStatuses'],
            ]
        );
    }

    /**
     * Sign in Page
     */
    public function signin()
    {
        return view('employer.login');
    }

    public function applicantsAndJob()
    {
        $user = auth()->user();


        $jobsAndApplicants = $this->employerService->getJobsAndApplicants($user);
        $companyName = $this->employerService->getCompanyDetails($user);

        return view(
            'employer.jobs_and_applicants',
            compact('jobsAndApplicants', 'companyName')
        );
    }


    public function create(StoreJobDescriptionRequest $request)
    {
        $user = auth()->user();

        $validatedNewJobDetails = $request->validated();
        $newJob = $this->employerService->newJob($validatedNewJobDetails, auth()->user());

        if (!$newJob->id) {
            return redirect()
                ->route('employer.newjobdesc.page')
                ->with('status', false)
                ->with('message', "Unsuccessfully created new Job");
        }

        return redirect()
            ->route('employer.dashboard')
            ->with('status', true)
            ->with('message', "You have successfully created new Job");
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(EditJobDescriptionRequest $request, string $id)
    {
        $user = auth()->user();

        $validatedEditedJobDetails = $request->validated();
        $editedJob = $this->employerService->editJob($validatedEditedJobDetails, (int) $id, $user);

        if (!$editedJob) {
            return redirect()->intended(route('employer.editjobdesc.page'))->with('status', false)->with('message', "Unsuccessfully  edited" . $request->title . "Job Description");
        }

        return  redirect()->intended(route('employer.dashboard'))->with('status', true)->with('message', "Successfully edited" .  $request->title . " new Job Description");;
    }

    /**
     * Remove the specified resource from storage.
     */



    public function store(CreateEmployerUserRequest $request)
    {
        $validatedEmployerDetails = $request->validated();

        $newEmployer = $this->employerService->register($validatedEmployerDetails);

        if ($newEmployer["success"] === true) {
            return redirect('/employer/signin')
                ->with('status', true)
                ->with('message', 'Registration successfully');
        }

        return redirect('/employer/register')
            ->with('status', false)
            ->with('message', 'Registration failed, try again');
    }

    public function update_profile(CreateApplicantUserRequest $request, string $id)
    {
        $request->validated();

        $updatedApplicantUser = $this->userAuthService->update($request->validated(), (int)  $id, $type = "employer");

        if (!$updatedApplicantUser) {
            return redirect(route('employer.profile.page', $id))
                ->with('status', true)
                ->with('message', 'Profile Update unsuccessfully');
        }

        return redirect(route('employer.dashboard'))
            ->with('status', true)
            ->with('message', 'Profile Update successfully');
    }




    public function login(CheckSignInUserRequest $request)
    {
        $loginCredentials = $request->validated();

        $authenciated =  $this->userAuthService->login($loginCredentials);


        if ($authenciated) {
            return redirect()->intended(route('employer.dashboard'))->with('success', "You have successfully logged in");
        }

        return  redirect('/employer/signin')->with('status', true)->with('message', "login and password incorrect");;
    }

    public function logOut()
    {
        Session::flush();
        Auth::logout();

        return  redirect(route('home'));
    }


    public function destroy(string $id)
    {
        //
        $user = $this->JobListingsUser::find($id);

        $user->delete();
        return view('home');
    }

    public function destroy_jobDesc(string $id)
    {

        $job = $this->JobListing::find($id);
        $job->delete();
        return view('employer.dashboard')
            ->with('status', true)
            ->with('message', 'Job record has been deleted');;
    }
}
