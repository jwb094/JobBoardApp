@extends('layouts.layout')
@section('title', 'Find Your Next Job')
@section('content')
<main class="home-page">
    <section class="home-page__hero mx-auto grid max-w-7xl items-center gap-8 lg:grid-cols-[1.1fr_0.9fr]">
        <div class="home-page__intro">
            <span class="home-page__eyebrow">
                <i class="fa-solid fa-sparkles" aria-hidden="true"></i>
                Your next opportunity starts here
            </span>
            <h1 class="home-page__title">Find work that moves you forward.</h1>
            <p class="home-page__description">Explore opportunities from teams looking for people like you. Find a role that fits your skills, goals, and life.</p>
            <div class="home-page__quick-facts">
                <span class="home-page__quick-fact">
                    <strong>{{ number_format($jobListings->total()) }}</strong>
                    jobs to explore
                </span>
                <span class="home-page__quick-fact">
                    <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                    New opportunities added regularly
                </span>
            </div>
        </div>

        <div class="home-page__search-card">
            <div class="home-page__search-heading">
                <span class="home-page__search-icon"><i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i></span>
                <div>
                    <h2>Search jobs</h2>
                    <p>Find your next great opportunity.</p>
                </div>
            </div>

            <form method="GET" action="/" class="home-page__search-form">
                <div class="home-page__field">
                    <label class="home-page__label" for="search">Job title or keyword</label>
                    <input class="home-page__control" type="search" id="search" name="search" value="{{ request('search') }}" placeholder="e.g. Marketing Manager">
                </div>

                <div class="home-page__field">
                    <label class="home-page__label" for="category">Category</label>
                    <x-form.form-select-category id="category" name="category" class="home-page__control" :categories="$categories" />
                </div>

                <div class="home-page__search-actions">
                    <button type="submit" class="home-page__button home-page__button--primary">
                        Search jobs
                        <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                    </button>
                    <a href="/" class="home-page__reset">Clear filters</a>
                </div>
            </form>
        </div>
    </section>

    <section class="home-page__results mx-auto max-w-7xl" aria-labelledby="job-results-heading">
        <header class="home-page__results-header">
            <div>
                <p class="home-page__section-eyebrow">Curated for your next move</p>
                <h2 id="job-results-heading">Latest opportunities</h2>
            </div>
            <span class="home-page__result-count">
                {{ number_format($jobListings->total()) }} {{ \Illuminate\Support\Str::plural('role', $jobListings->total()) }}
            </span>
        </header>

        @if ($jobListings->isEmpty())
            <div class="home-page__empty">
                <span class="home-page__empty-icon"><i class="fa-regular fa-folder-open" aria-hidden="true"></i></span>
                <h3>No jobs found</h3>
                <p>Try changing your keywords or category to see more opportunities.</p>
                <a href="/" class="home-page__button home-page__button--primary">Clear search</a>
            </div>
        @else
            <div class="home-page__job-grid grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($jobListings as $jobListing)
                    <x-job-card :jobId="$jobListing->id" :jobSlug="$jobListing->slug" :jobTitle="$jobListing->title" :jobType="$jobListing->job_type" :jobCategory="$jobListing->category->name" :jobSalaryMin="$jobListing->salary_min" :jobSalaryMax="$jobListing->salary_max" :jobLocation="$jobListing->location" />
                @endforeach
            </div>

            <nav class="home-page__pagination" aria-label="Job listings pagination">
                {{ $jobListings->links() }}
            </nav>
        @endif
    </section>
</main>
@endsection
