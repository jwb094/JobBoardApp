<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobListingsUsers;

class JobListingsUser extends Controller
{

    protected JobListingsUsers $jobListingsUsers;
    public function __construct(JobListingsUsers $JobListingsUsersModel)
    {
        $this->jobListingsUsers = $JobListingsUsersModel;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        //$user = $this->jobListingsUsers::findOrFail()

        return view('user.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        return view('user.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $user = $this->jobListingsUsers::findOrFail($id);
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
        $user = $this->jobListingsUsers::find($id);
        $user->delete();
        //need to delete session
        return view('home');
    }
}
