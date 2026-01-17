<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobListingsUser as JLUser;

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

        $data = $request->validate([
            'first_name'   => 'required|exists:categories,id',
            'last_name'         => 'required|string|max:255',
            'email'   => 'required',
            'password' => 'required',
        ]);

        $data['user_id'] = auth()->id();
        $data['slug'] = Str::slug($data['title']);


        $this->JobListingsUser::create($data);
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
        $user->delete();
        //need to delete session
        return view('home');
    }
}
