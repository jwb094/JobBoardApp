<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JobListingsUser as JLUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class JobListingsUser extends Controller
{

    protected JLUser $JobListingsUser;
    public function __construct(JLUser $jobListingsUserModel)
    {
        $this->JobListingsUser = $jobListingsUserModel;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = [];
        //
        if (auth()->user()) {
            $user = auth()->user();
        }
        //dd($user);
        return view('user.dashboard', ['user' => $user]);
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
        return view('user.edit', $user);
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
        //delete application from 
        $user->delete();
        return view('home');
    }
}
