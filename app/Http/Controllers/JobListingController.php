<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobListing;
use App\Models\Category;
use App\Models\SavedJob;
use Illuminate\Support\Str;

class JobListingController extends Controller
{

    protected JobListing $jobListing;
    protected Category $categories;

    protected SavedJob $savedJob;
    public function __construct(JobListing $jobListingsModel, Category $categoryModel, SavedJob $savedJobModel)
    {
        $this->jobListing = $jobListingsModel;
        $this->categories = $categoryModel;
        $this->savedJob = $savedJobModel;
    }

    /**
     * Display a listing of Job & filtered Search Jobs.
     */
    public function index(Request $request)
    {
        $categories = $this->categories::all();
        //dd($request->search);
        $query = JobListing::with('category', 'employer')
            ->where('status', 'open');

        if (!empty($request->search)) {
            // dd($request->search);
            $query->when($request->search, fn($q) => $q->orWhere('title', $request->search));
            // $query->Where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->category) {
            // $query->orWhere('category_id', 'like', '%' . $request->category_id . '%');
            $query->when($request->category, fn($q) => $q->where('category_id', $request->category));
        }


        $jobListings = $query->latest()->paginate(10);

        //dd($jobListings);
        return view('home', ['categories' => $categories, 'jobListings' => $jobListings]);
    }

    /**
     * Show the form for creating a new Job.
     */
    public function create()
    {
        $categories = $this->categories::with('category')::all();
        return view('joblistings.create', compact('categories'));
    }

    /**
     * Store a newly created Job
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id'   => 'required|exists:categories,id',
            'title'         => 'required|string|max:255',
            'description'   => 'required|string',
            'skillset_About' => 'required|string',
            'benefits'      => 'required|string',
            'location'      => 'required|string',
            'job_type'      => 'required',
            'salary_min'    => 'nullable|integer',
            'salary_max'    => 'nullable|integer',
            'expires_at'    => 'nullable|date',
        ]);

        $data['user_id'] = auth()->id();
        $data['slug'] = Str::slug($data['title']);


        JobListing::create($data);

        return view('job_listings.dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $user = [];
        if (auth()->user()) {
            $user = auth()->user();
        }
        $job = $this->jobListing::findOrFail($id);

        $savedJobExists = $this->savedJob::where('user_id', $user->id)
            ->where('job_id', $job->id)
            ->exists();



        //dd($savedJobExists);
        return view('joblistings.jobpage', ['job' => $job, 'user' => $user, 'savedJobExists' => $savedJobExists]);
    }

    /**
     * Show Job Details
     */
    public function edit(string $id)
    {

        $job = $this->jobListing::findOrFail($id);
        $categories = $this->categories::all();
        return view('job', ['job' => $job,  'categories' => $categories]);
    }

    /**
     * Update a Job Details.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:255',
            'company_background'       => 'required|string',
            'address'       => 'required|string',
            'description'   => 'required|string',
            'skillset_About' => 'required|string',
            'benefits'      => 'required|string',
            'location'    => 'required|string',
            'job_type'    => 'required',
            'salary_min'  => 'nullable|integer',
            'salary_max'  => 'nullable|integer',
            'expires_at'  => 'nullable|date',
        ]);


        return view('job_listings.dashboard', compact('jobDesc'));
    }

    /**
     * Remove A Job.
     */
    public function destroy(string $id)
    {
        //
        $jobDesc = $this->jobListing::find($id);
        $jobDesc->delete();
        return redirect('/dashboard');
    }

    /**
     * Show Job Application form page
     */
    public function apply($id)
    {
        //
        $user = [];
        if (auth()->user()) {
            $user = auth()->user();
        }

        $job = $this->jobListing::findOrFail($id);

        return view('joblistings.job_application_form', ['job' => $job, 'user' => $user]);
    }
}
