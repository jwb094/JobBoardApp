@extends('layouts.layout')
@section('title','home')
@section('content')
<div class="jobboard-shell">
    <section class="job-hero">
        <div class="hero-content">
            <span class="hero-badge">
                <i class="fa-solid fa-bolt"></i>
                Hiring now
            </span>
            <h1>Find the next role that matches your ambition.</h1>
            <p>Explore curated opportunities from fast-growing teams and discover the job that helps you build the future you want.</p>

            <div class="hero-stats" aria-label="Platform stats">
                <span class="stat-pill"><strong>1.2k+</strong> jobs</span>
                <span class="stat-pill"><strong>240</strong> companies</span>
                <span class="stat-pill"><strong>Weekly</strong> updates</span>
            </div>
        </div>

        <aside class="search-panel">
            <form method="GET" action="/" class="search-form">
                <div class="field-group">
                    <x-form.label for="search">Search</x-form.label>
                    <x-form.form-input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Search e.g. Manager"></x-form.form-input>
                </div>

                <div class="field-group">
                    <x-form.label for="category">Category</x-form.label>
                    <x-form.form-select-category id="category" name="category" :categories="$categories"></x-form.form-select-category>
                </div>

                <div class="form-actions">
                    <x-form.form-button type="submit" class="primary-btn">
                        Search jobs
                    </x-form.form-button>
                    <a href="/" class="secondary-btn">Reset</a>
                </div>
            </form>
        </aside>
    </section>
</div>

<div class="job-board-wrap">
    <div class="job-board-header">
        <div>
            <p class="eyebrow">Latest openings</p>
            <h2>Fresh opportunities</h2>
        </div>
        <div class="job-results-badge">{{ $jobListings->total() }} jobs</div>
    </div>

    <div class="job-grid">
        @foreach ($jobListings as $jobListing)
            <x-job-card :jobId="$jobListing->id" :jobSlug="$jobListing->slug" :jobTitle="$jobListing->title" :jobType="$jobListing->job_type" :jobCategory="$jobListing->category->name" :jobSalaryMin="$jobListing->salary_min" :jobSalaryMax="$jobListing->salary_max" :jobLocation="$jobListing->location" />
        @endforeach
    </div>

    <div class="pagination-wrap">
        {{ $jobListings->links() }}
    </div>
</div>
@endsection
