<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\JobListingsUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class JobListingsEmployer extends Controller
{

    protected JobListingsUser $JobListingsUser;

    protected Company $Company;
    public function __construct(JobListingsUser $jobListingsUserModel, Company $companyModel)
    {
        $this->JobListingsUser = $jobListingsUserModel;
        $this->Company =  $companyModel;
    }

    /** 
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $user = $this->JobListingsUser::findOrFail($id);
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

    public function register()
    {
        return view('employer.register');
    }
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



    /**
     * Sign in Page
     */
    public function signin()
    {
        return view('employer.login');
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
}
