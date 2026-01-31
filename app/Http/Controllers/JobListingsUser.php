<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JobListingsUser as JLUser;
use App\Models\SavedJob;
use App\Models\Application;
use App\Models\JobListing;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class JobListingsUser extends Controller
{

    protected JLUser $JobListingsUser;
    protected SavedJob $savedJobListing;
    protected Application $application;

    protected JobListing $jobListing;
    public function __construct(JLUser $jobListingsUserModel, SavedJob $savedJobListingModel, Application $applicationModel, JobListing $jobListingModel)
    {
        $this->JobListingsUser = $jobListingsUserModel;
        $this->savedJobListing = $savedJobListingModel;
        $this->application = $applicationModel;
        $this->jobListing = $jobListingModel;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = [];
        $userSavedJobsCount = 0;
        $userApplicationsCount = 0;
        //
        if (auth()->user()) {
            $user = auth()->user();
        }


        if ($user) {
            $userSavedJobsCount =  $this->savedJobListing::where('user_id', '=', $user->id)->count();
            $userApplicationsCount =    $this->application::where('user_id', '=', $user->id)->count();
        }

        //dd($userSavedJobsCount);
        return view(
            'user.dashboard',
            [
                'user' => $user,
                'savedJobsCount' => $userSavedJobsCount,
                'savedApplicationsCount' => $userApplicationsCount
            ]
        );
    }

    public function applications($id)
    {
        $user = [];

        if (auth()->user()) {
            $user = auth()->user();
        }

        $userApplications =    $this->application::with('jobListing')->where('user_id', $user->id)->get();
        //dd($userApplications[0]->jobListing);
        return view('user.applications', ['user' => $user, 'userApplications' => $userApplications]);
    }
    public function savedjobs($id)
    {
        $savedJobs = [];
        $savedJobList = $this->savedJobListing::where('user_id', $id)->get();

        foreach ($savedJobList as $key => $value) {
            $savedJobs[] = $this->jobListing::where('id', $value->job_id)->first();
        }
        return view('user.savedjobs', ['savedJobList' => $savedJobs]);
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


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');


        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('user.dashboard'))->with('success', "You have successfully logged in");
        }

        return  redirect('/user/signin')->with('status', true)->with('message', "Registration successfully");;
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
    public function store(Request $request)
    {
        //

        $data = $request->validate([
            'first_name'   => 'required|',
            'last_name'    => 'required|string|max:255',
            'email'   => 'required',
            'password' => 'required',
        ]);

        // $data['user_id'] = auth()->id();
        // $data['slug'] = Str::slug($data['title']);
        //$data['password'] = Hash::make($request->password);
        $data['password'] = Hash::make($request->password);
        $data['role'] = 'applicant';
        //dd($data);

        $newUser = $this->JobListingsUser::create($data);

        if (!$newUser->id) {
            return  redirect('/user/register')->wih('status', false)->with('message', "Registration failed, try again please");;
        }
        return  redirect('/user/signin')->with('status', true)->with('message', "Registration successfully");;
    }


    /**
     * Store documents.
     */
    public function store_documents(Request $request)
    {

        //Create a folder for User applicant to store documents
        $path = public_path('uploads/' . auth()->user()->first_name . '-' . auth()->user()->last_name);

        if (!Storage::exists($path)) {

            Storage::makeDirectory($path, 0777, true, true);
        }

        //Validate input fields
        $data = $request->validate([
            'cover_letter' => 'file|mimes:pdf,doc,docx|max:2048',
            'cv' => 'file|mimes:pdf,doc,docx|max:2048',
            'portfolio_link' => 'nullable|string',
        ]);

        //Capture the files and upload to DIR
        $cover_letter = $request->file('cover_letter');
        $cv = $request->file('cv');

        $request->cover_letter->move($path, $cover_letter->getClientOriginalName());
        $request->cv->move($path, $cv->getClientOriginalName());


        $data['cover_letter'] = $cover_letter->getClientOriginalName();
        $data['cv'] = $cv->getClientOriginalName();

        //update USer Applicant record with documents 
        $updatedUserDocuments =    $this->JobListingsUser::where('id', auth()->user()->id)->update($data);

        if (!$updatedUserDocuments) {
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
    public function update(Request $request, string $id)
    {
        //

        $data = $request->validate([
            'first_name'   => 'required|',
            'last_name'    => 'required|string|max:255',
            'email'   => 'required',
            'password' => 'required',
        ]);

        $data['password'] = Hash::make($request->password);
        $data['role'] = 'applicant';

        $updatedUser =    $this->JobListingsUser::where('id', $id)->update($data);

        if (!$updatedUser) {
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
