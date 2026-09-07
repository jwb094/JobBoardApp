<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckSignInUserRequest;
use App\Http\Requests\CreateApplicantUserRequest;
use App\Http\Requests\StoreApplicantUserDocumentsRequest;
use App\Services\UserDocumentsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JobListingsUser as JLUser;
use App\Models\SavedJob;
use App\Models\Application;
use App\Models\JobListing;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Services\UserAuthService;

class JobListingsUser extends Controller
{

    protected JLUser $JobListingsUser;
    protected SavedJob $savedJobListing;
    protected Application $application;

    protected UserAuthService $userAuthService;


    protected UserDocumentsService $UserDocumentsService;

    protected JobListing $jobListing;
    public function __construct(
        JLUser $jobListingsUserModel,
        SavedJob $savedJobListingModel,
        Application $applicationModel,
        JobListing $jobListingModel,
        UserAuthService $userAuthServices,
        UserDocumentsService $UserDocumentsService
    ) {
        $this->JobListingsUser = $jobListingsUserModel;
        $this->savedJobListing = $savedJobListingModel;
        $this->application = $applicationModel;
        $this->jobListing = $jobListingModel;
        $this->userAuthService = $userAuthServices;
        $this->UserDocumentsService = $UserDocumentsService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user = auth()->user();


        $dashboardInfo = $this->userAuthService->dashboard($user);

        return view(
            'user.dashboard',
            [
                'user' => $user,
                'savedJobsCount' => $dashboardInfo['userSavedJobsCount'],
                'savedApplicationsCount' => $dashboardInfo['userApplicationsCount']
            ]
        );
    }

    public function applications($id)
    {

        $user = auth()->user();

        $userApplications =    $this->application::with('jobListing')->where('user_id', $user->id)->get();

        return view('user.applications', ['user' => $user, 'userApplications' => $userApplications]);
    }
    public function savedjobs(int $id)
    {
        $savedJobs = $this->savedJobListing
            ::where('user_id', $id)
            ->with('jobListing.company')
            ->get();

        //dd($savedJobs);
        return view('user.savedjobs', compact('savedJobs'));
    }

    public function documents($id)
    {
        $user = [];

        if (auth()->user()) {
            $user = auth()->user();
        }

        return view('user.user-documents', ['user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }


    public function login(CheckSignInUserRequest $request)
    {

        $loginCredentials = $request->validated();

        $authenciated =  $this->userAuthService->login($loginCredentials);

        if ($authenciated) {
            return redirect()->intended(route('user.dashboard'))
                ->with('success', "You have successfully logged in");
        }

        return  redirect(route('user.login'))->with('status', true)
            ->with('message', "Registration unsuccessfully");
    }

    /**
     * Logout
     * 
     */
    public function logOut()
    {
        Session::flush();
        Auth::logout();

        return  redirect(route('home'));
    }

    /**
     * Store a new user applicant record
     */
    public function store(CreateApplicantUserRequest $request)
    {

        $newApplicantUser = $this->userAuthService->register($request->validated());


        if (!$newApplicantUser->id) {
            return  redirect('/user/register')->wih('status', false)->with('message', "Registration failed, try again please");;
        }
        return  redirect('/user/signin')->with('status', true)->with('message', "Registration successfully");;
    }


    /**
     * Store documents.
     */
    public function store_documents(StoreApplicantUserDocumentsRequest $request)
    {


        $validatedFormDetails = $request->validated();

        $storedApplicantDocuments = $this->UserDocumentsService->uploadDocuments($request,auth()->user()->first_name,auth()->user()->last_name,(int) auth()->user()->id);
        /*
        //Create a folder for User applicant to store documents
        $path = public_path('uploads/' . auth()->user()->first_name . '-' . auth()->user()->last_name);

        if (!Storage::exists($path)) {
            Storage::makeDirectory($path, 0777, true, true);
        }

        //Validate input fields
        // $data = $request->validate([
        //     'cover_letter' => 'file|mimes:pdf,doc,docx|max:2048',
        //     'cv' => 'file|mimes:pdf,doc,docx|max:2048',
        //     'portfolio_link' => 'nullable|string',
        // ]);

        //Capture the files and upload to DIR
        $cover_letter = $request->file('cover_letter');
        $cv = $request->file('cv');

        $request->cover_letter->move($path, $cover_letter->getClientOriginalName());
        $request->cv->move($path, $cv->getClientOriginalName());


        $data['cover_letter'] = $cover_letter->getClientOriginalName();
        $data['cv'] = $cv->getClientOriginalName();

        //update USer Applicant record with documents 
        $updatedUserDocuments =    $this->JobListingsUser::where('id', auth()->user()->id)->update($data);
        */
        // if (!$updatedUserDocuments) {
         if (!$storedApplicantDocuments) {
            return redirect(route('user.documents'))->with('success', false)->with('message', "uploads Documents failed")->with(compact($data));
        }

        return  redirect(route('user.dashboard'))->with('success', true)->with('message', "documents  uploaded succesfully");
    }
    /**
     * Sign in Page
     */
    public function signin()
    {
        return view('user.login');
    }


    // Register PAge
    public function register()
    {
        return view('user.register');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $user = $this->JobListingsUser::findOrFail($id);
        // dd($user);
        return view('user.update', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateApplicantUserRequest $request, string $id)
    {
        //

        $UpdatedApplicantUser = $this->userAuthService->update($request->validated(), (int)  $id);


        if (!$UpdatedApplicantUser) {
            return redirect(route('user-update-page'))->with('success', false)->with('message', false)->with(compact($data));
        }

        return  redirect(route('user.dashboard'))->with('success', true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user = $this->JobListingsUser::find($id);
        //delete application from 
        $user->delete();
        return view('home');
    }
}
