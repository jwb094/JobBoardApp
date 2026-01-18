<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobListing;
use App\Models\Category;
use Illuminate\Support\Str;

class JobListingController extends Controller
{

    protected JobListing $jobListing;
    protected Category $categories;
    public function __construct(JobListing $jobListingsModel, Category $categoryModel)
    {
        $this->jobListing = $jobListingsModel;
        $this->categories = $categoryModel;
    }

    /**
     * Display a listing of the resource.
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = $this->categories::with('category')::all();
        return view('joblistings.create', compact('categories'));
    }

    /**
     * Store a newly created Job
     */
    public function store(Request $request)
    {
        //
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

        $job = $this->jobListing::findOrFail($id);

        return view('joblistings.jobpage', ['job' => $job]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $job = $this->jobListing::findOrFail($id);
        $categories = $this->categories::all();
        return view('job', ['job' => $job,  'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:255',
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $jobDesc = $this->jobListing::find($id);
        $jobDesc->delete();
        return redirect('/dashboard');
    }
}
