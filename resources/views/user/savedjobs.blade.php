@extends('layouts.layout')
@section('title', 'Saved Jobs')
@section('content')
<main class="saved-jobs-page">
    <header class="saved-jobs-header">
        <div>
            <p class="dashboard-eyebrow">Your shortlist</p>
            <h1>Saved jobs</h1>
            <p>Keep the opportunities you’re interested in close at hand.</p>
        </div>
        <span class="applications-count">
            <i class="fa-solid fa-bookmark" aria-hidden="true"></i>
            {{ $savedJobs->count() }} {{ \Illuminate\Support\Str::plural('saved job', $savedJobs->count()) }}
        </span>
    </header>

    @if ($savedJobs->isEmpty())
        <section class="applications-empty">
            <span class="applications-empty-icon"><i class="fa-regular fa-bookmark" aria-hidden="true"></i></span>
            <h2>No saved jobs yet</h2>
            <p>Save roles that catch your eye and they’ll be waiting for you here.</p>
            <a href="/" class="applications-browse-link">Explore open jobs <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
        </section>
    @else
        <section class="saved-jobs-grid" aria-label="Your saved jobs">
            @foreach ($savedJobs as $savedJob)
                <a href="/job/{{ $savedJob->jobListing->id }}/{{ $savedJob->jobListing->slug }}" class="saved-job-card">
                    <span class="saved-job-icon"><i class="fa-solid fa-briefcase" aria-hidden="true"></i></span>
                    <span class="saved-job-content">
                        <span class="saved-job-title">{{ $savedJob->jobListing->title }}</span>
                        @if ($savedJob->jobListing?->company?->company_name)
                            <span class="saved-job-company">{{ $savedJob->jobListing->company->company_name }}</span>
                        @endif
                    </span>
                    <i class="fa-solid fa-arrow-right saved-job-arrow" aria-hidden="true"></i>
                </a>
            @endforeach
        </section>
    @endif
</main>
@endsection
