<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Models\Application;
use App\Models\JobListingsUser;
use App\Models\JobListing;

class JobListingsEmployer extends Controller
{
    protected JobListing $jobListing;
    protected Application $application;
    protected JobListingsUser $JobListingsUser;
    public function __construct(JobListing $jobListingModel, JobListingsUser $jobListingsUserModel, Application $applicationModel)
    {

        $this->jobListing = $jobListingModel;

        $this->JobListingsUser = $jobListingsUserModel;

        $this->application = $applicationModel;
    }

    // Display the Sign In Page
    public function signin()
    {
        return view('employer.login');
    }

    // Display the Register Page
    public function register()
    {
        return view('employer.register');
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

        return  redirect('/employer/signin')->with('status', true)->with('message', "Registration successfully");;
    }

    public function logOut()
    {
        Session::flush();
        Auth::logout();

        return  redirect(route('home'));
    }

    /** 
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = [];

        if (auth()->user()) {
            $user = auth()->user();
        }

        return view(
            'employer.dashboard',
            [
                'user' => $user
            ]
        );
    }

    // Display the Create  A Job In Page
    public function newJob()
    {
        return view('employer.createJob');
    }

    /**
     * Store an updated Job .
     */
    public function storeJob()
    {



        $newJob = $this->jobListing::create($data);

        if (!$newJob->id) {
            return  redirect(route('employer.dashboard'))->wih('status', false)->with('message', "Registration failed, try again please");;
        }
        return  redirect('/employer/new-job')->with('status', true)->with('message', "Registration successfully");;
    }

    // Display the Update Job In Page
    public function editJob($id)
    {

        $Job = $this->jobListing::findOrFail($id);
        return view('employer.updateJob');
    }

    /**
     * Store an updated Job .
     */
    public function updateJob($id)
    {


        $updatedJob =    $this->jobListing::where('id', $id)->update($data);

        if (!$updatedJob) {
            return redirect('/employer/edit/' . $id)->with('success', false)->with('message', false)->with(compact($data));
        }

        return  redirect(route('employer.dashboard'))->with('success', true);
    }




    /**
     * Store a newly created employer User in storage.
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

        $data['password_hash'] = Hash::make($request->password);
        $data['role'] = 'employer';

        $newUser = $this->JobListingsUser::create($data);

        if (!$newUser->id) {
            return  redirect('/employer/register')->wih('status', false)->with('message', "Registration failed, try again please");;
        }
        return  redirect('/employer/signin')->with('status', true)->with('message', "Registration successfully");;
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    // Display the viewJobApplications Page
    public function viewJobApplications(string $id)
    {
        //
        //$user = $this->JobListingsUser::findOrFail($id);

        return view('employer.applications',);
    }

    // Display the Update Employer details Page
    public function edit(string $id)
    {
        //
        $user = $this->JobListingsUser::findOrFail($id);

        return view('employer.update', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user = $this->JobListingsUser::find($id);
        $user->delete();
        //need to delete session
        return view('home');
    }
}
