<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JobListingsUser as JLUser;
use App\Models\SavedJob;
use App\Models\Application;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class JobListingsUser extends Controller
{

    protected JLUser $JobListingsUser;
    protected SavedJob $savedJobListing;
    protected Application $application;
    public function __construct(JLUser $jobListingsUserModel, SavedJob $savedJobListingModel, Application $applicationModel)
    {
        $this->JobListingsUser = $jobListingsUserModel;
        $this->savedJobListing = $savedJobListingModel;
        $this->application = $applicationModel;
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
        return view(
            'user.dashboard',
            [
                'user' => $user,
                'savedJobsCount' => $userSavedJobsCount,
                'savedApplicationsCount' => $userApplicationsCount
            ]
        );
    }

    public function applications($id) {}
    public function savedjobs($id) {}
    public function documents($id) {}

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
     * Store a newly created resource in storage.
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
        $data['password_hash'] = Hash::make($request->password);
        $data['role'] = 'applicant';
        //dd($data);

        $newUser = $this->JobListingsUser::create($data);

        if (!$newUser->id) {
            return  redirect('/user/register')->wih('status', false)->with('message', "Registration failed, try again please");;
        }
        return  redirect('/user/signin')->with('status', true)->with('message', "Registration successfully");;
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

        $data['password_hash'] = Hash::make($request->password);
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
