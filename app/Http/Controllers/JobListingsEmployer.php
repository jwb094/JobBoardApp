<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobListingsUser;

class JobListingsEmployer extends Controller
{

    protected JobListingsUser $JobListingsUser;
    public function __construct(JobListingsUser $jobListingsUserModel)
    {
        $this->JobListingsUser = $jobListingsUserModel;
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
}
