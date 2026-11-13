@extends('layouts.layout')
@section('title', 'Saved Jobs')
@section('content')
<main class="user-saved-jobs mx-auto flex min-h-[calc(100svh-220px)] max-w-6xl flex-col justify-center px-4 py-8">
    <header class="user-saved-jobs__header">
        <div>
            <p class="user-saved-jobs__eyebrow">Your shortlist</p>
            <h1 class="user-saved-jobs__title">Saved jobs</h1>
            <p class="user-saved-jobs__description">Keep the opportunities you’re interested in close at hand.</p>
        </div>
        <span class="user-saved-jobs__count">
            <i class="fa-solid fa-bookmark" aria-hidden="true"></i>
            {{ $savedJobs->count() }} {{ \Illuminate\Support\Str::plural('saved job', $savedJobs->count()) }}
        </span>
    </header>

    @if ($savedJobs->isEmpty())
        <section class="user-saved-jobs__empty">
            <span class="user-saved-jobs__empty-icon"><i class="fa-regular fa-bookmark" aria-hidden="true"></i></span>
            <h2 class="user-saved-jobs__empty-title">No saved jobs yet</h2>
            <p class="user-saved-jobs__empty-description">Save roles that catch your eye and they’ll be waiting for you here.</p>
            <a href="/" class="user-saved-jobs__browse-link">Explore open jobs <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
        </section>
    @else
        <section class="user-saved-jobs__grid grid grid-cols-1 gap-4 md:grid-cols-2" aria-label="Your saved jobs">
            @foreach ($savedJobs as $savedJob)
                <a href="/job/{{ $savedJob->jobListing->id }}/{{ $savedJob->jobListing->slug }}" class="user-saved-jobs__card">
                    <span class="user-saved-jobs__icon"><i class="fa-solid fa-briefcase" aria-hidden="true"></i></span>
                    <span class="user-saved-jobs__content">
                        <span class="user-saved-jobs__title">{{ $savedJob->jobListing->title }}</span>
                        @if ($savedJob->jobListing?->company?->company_name)
                            <span class="user-saved-jobs__company">{{ $savedJob->jobListing->company->company_name }}</span>
                        @endif
                    </span>
                    <i class="fa-solid fa-arrow-right user-saved-jobs__arrow" aria-hidden="true"></i>
                </a>
            @endforeach
        </section>
    @endif
</main>
@endsection
