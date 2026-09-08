<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobDescriptionRequest;
use App\Models\Category;
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
    public function __construct(Category $categoryModel, JobListingsUser $jobListingsUserModel,  JobListing $jobListingModel, Company $companyModel, EmployerService $employerService)
    {
        $this->JobListingsUser = $jobListingsUserModel;
        $this->Company =  $companyModel;
        $this->JobListing = $jobListingModel;
        $this->Category = $categoryModel;
        $this->employerService = $employerService;
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
        // $job = $this->JobListing::findOrFail($id);
        // $categories = $this->Category::all();


        $job = $this->JobListing
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $categories = $this->Category::all();
        // dd($job->expires_at->format('d/m/y'));
        // $job->expires_at = explode(" ", $job->expires_at);
        // dd($job->expires_at);

        // $job->expires_at = $job->expires_at->format('d/m/y');
        // dd($job);
        return view('employer.edit_job', compact('job', 'categories'));
    }

    public function register()
    {
        return view('employer.register');
    }

    public function newjob()
    {
        $categories = $this->Category::all();

        return view('employer.new_job', compact('categories'));
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

    // public function jobDescs(string $id)
    // {
    //     //
    // }




    /**
     * Show the form for creating a new resource.
     */
    // public function create(Request $request)
    // {



    //     $validatedJobData =  $request->validate([
    //         'title'                     => 'required|string',
    //         // 'slug'                   => 'required|string',
    //         'description'               => 'required|string',
    //         'company_background_info'   => 'required|string',
    //         'skillset_About'            => 'required|string',
    //         'benefits'                  => 'required|string',
    //         'location'                  => 'required|string',
    //         'category_id'               => 'required|exists:categories,id',
    //         'city'                      => 'required|string',
    //         'address'                   => 'required|string',
    //         'post_code'                 => 'required|string',
    //         'job_type'                  => 'required|string',
    //         // 'salary_min'                => 'numeric:strict',
    //         // 'salary_max'                => 'numeric:strict',
    //         'status'                    => 'required|string',
    //         'expires_at'                => 'required|string'
    //     ]);

    //     $validatedJobData['user_id']        = auth()->user()->id;
    //     $validatedJobData['salary_min']     = $validatedJobData['salary_min'] ?? '';
    //     $validatedJobData['salary_max']     = $validatedJobData['salary_max'] ?? '';

    //     $validatedJobData['expires_at']     =  strtotime($request->expires_at);
    //     $validatedJobData['slug']           =  Str::slug($request->title);
    //     $validatedJobData['company_id']     = $user->company_id;

    //     //dd($validatedJobData);
    //     $newJobDesc = $this->JobListing::create($validatedJobData);

    //     if (!$newJobDesc->id) {
    //         return redirect()->intended(route('employer.newjobdesc.page'))->with('status', false)->with('message', "Unsuccessfully created new Job");
    //     }

    //     return  redirect()->intended(route('employer.dashboard'))->with('status', true)->with('message', "You have successfully created new Job");;
    // }


    public function create(StoreJobDescriptionRequest $request)
    {
        $user = auth()->user();

        $validatedNewJobDetails = $request->validated();
        $newJob = $this->employerService->newJob($validatedNewJobDetails,auth()->user());

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
    public function update(Request $request, string $id)
    {
        $user = auth()->user();



        $validatedUpdatedJobData =  $request->validate([
            'title'                     => 'required|string',
            'description'               => 'required|string',
            'company_background_info'   => 'required|string',
            'skillset_About'            => 'required|string',
            'benefits'                  => 'required|string',
            'location'                  => 'required|string',
            'category_id'               => 'required|exists:categories,id',
            'city'                      => 'required|string',
            'address'                   => 'required|string',
            'post_code'                 => 'required|string',
            'job_type'                  => 'required|string',
            'status'                    => 'required|string',
            'expires_at'                => 'required|date'
        ]);


        $validatedUpdatedJobData['user_id'] = $user->id;
        $validatedUpdatedJobData['salary_min'] = $validatedUpdatedJobData['salary_min'] ?? '';
        $validatedUpdatedJobData['salary_max'] = $validatedUpdatedJobData['salary_max'] ?? '';

        $validatedUpdatedJobData['expires_at'] =  strtotime($request->expires_at);;
        $validatedUpdatedJobData['company_id'] = $user->company_id;

        $updatedJobDesc = $this->JobListing::where('id', $id)->update($validatedUpdatedJobData);
        if (!$updatedJobDesc) {
            return redirect()->intended(route('employer.editjobdesc.page'))->with('status', false)->with('message', "Unsuccessfully  edited" . $request->title . "Job Description");
        }

        return  redirect()->intended(route('employer.dashboard'))->with('status', true)->with('message', "Successfully edited" .  $request->title . " new Job Description");;
    }

    /**
     * Remove the specified resource from storage.
     */



    /**
     * Store a newly created resource in storage.
     */

    /*
    public function store(Request $request)
    {
        //dd($request->all());
        $validated = $request->validate([
            'first_name'   => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'email'         => 'nullable|string',
            'password'  => 'nullable|string',
            'company_name'   => 'required|string|max:255',
            'company_tel'    => 'required|string|max:255',
            'company_size'    => 'required|string|max:255'
        ]);




        $company = Company::create(
            $request->only(['company_name', 'company_tel', 'company_size'])
        );

        // Prepare user data
        $userData = $request->only(['first_name', 'last_name', 'email', 'password']);
        $userData['password'] = isset($validated['password'])
            ? Hash::make($validated['password'])
            : null;
        $userData['role'] = 'employer';
        $userData['company_id'] = $company->id;

        // Create user
        $user = JobListingsUser::create($userData);

        if (is_null($user) && is_null($company)) {
            return  redirect('/employer/register')->wih('status', false)->with('message', "Registration failed, try again please");
        }
        return  redirect('/employer/signin')
            ->with('status', true)
            ->with('message', "Registration successfully");
    }
        */


    public function store(Request $request)
    {

        $validated = $request->validate([
            'first_name'   => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'email'        => 'required|string',
            'password'     => 'required|string',
            'company_name' => 'required|string|max:255',
            'company_tel'  => 'required|string|max:255',
            'company_size' => 'required|string|max:255'
        ]);

        DB::beginTransaction();

        try {

            $company = Company::create(
                $request->only(['company_name', 'company_tel', 'company_size'])
            );

            $userData = $request->only(['first_name', 'last_name', 'email', 'password']);

            if (!empty($validated['password'])) {
                $userData['password'] = Hash::make($validated['password']);
            }

            $userData['role'] = 'employer';
            $userData['company_id'] = $company->id;

            JobListingsUser::create($userData);

            DB::commit();

            return redirect('/employer/signin')
                ->with('status', true)
                ->with('message', 'Registration successfully');
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect('/employer/register')
                ->with('status', false)
                ->with('message', 'Registration failed, try again');
        }
    }

    public function update_profile(Request $request, string $id)
    {
        //dd($request->all());
        $validated = $request->validate([
            'first_name'   => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'email'        => 'required|string',
            'password'     => 'required|string',

        ]);



        $updatedUserData =  $this->JobListingsUser->where('id', $id)->update($validated);


        if (!$updatedUserData) {
            return redirect('/employer/edit/' . $id)
                ->with('status', true)
                ->with('message', 'Profile Update unsuccessfully');
        }

        return redirect('/employer/dashboard')
            ->with('status', true)
            ->with('message', 'Profile Update successfully');
    }




    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');


        if (Auth::attempt($credentials)) {
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
