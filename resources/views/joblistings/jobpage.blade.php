@extends('layouts.layout')
@section('title', $job->title . ' Job Page')
@section('content')
<main class="job-detail mx-auto flex min-h-[calc(100svh-180px)] max-w-7xl flex-col gap-6 px-4 py-8 sm:px-6 lg:py-12">
    <section class="job-detail__hero rounded-3xl p-5 sm:p-8 lg:p-10" aria-labelledby="job-title">
        <div class="job-detail__hero-heading">
            <p class="job-detail__eyebrow"><i class="fa-solid fa-sparkles" aria-hidden="true"></i> Career opportunity</p>
            <h1 id="job-title" class="job-detail__title">{{ $job->title }}</h1>
            <p class="job-detail__company">
                <i class="fa-regular fa-building" aria-hidden="true"></i>
                {{ $job->company?->company_name ?? 'Company not available' }}
            </p>
        </div>

        <dl class="job-detail__meta grid grid-cols-1 gap-3 sm:grid-cols-2 xl:grid-cols-3">
            <div class="job-detail__meta-item">
                <dt><i class="fa-solid fa-layer-group" aria-hidden="true"></i> Category</dt>
                <dd>{{ $job->category->name }}</dd>
            </div>
            <div class="job-detail__meta-item">
                <dt><i class="fa-solid fa-briefcase" aria-hidden="true"></i> Job type</dt>
                <dd>{{ $job->job_type }}</dd>
            </div>
            <div class="job-detail__meta-item">
                <dt><i class="fa-solid fa-money-bill-wave" aria-hidden="true"></i> Salary</dt>
                <dd>
                    @if (!empty($job->salary_min) && !empty($job->salary_max))
                        <span class="job-detail__salary">£{{ $job->salary_min }} – £{{ $job->salary_max }}</span>
                    @elseif (!empty($job->salary_min))
                        <span class="job-detail__salary">From £{{ $job->salary_min }}</span>
                    @elseif (!empty($job->salary_max))
                        <span class="job-detail__salary">Up to £{{ $job->salary_max }}</span>
                    @else
                        <span class="job-detail__salary job-detail__salary--muted">Salary not listed</span>
                    @endif
                </dd>
            </div>
            <div class="job-detail__meta-item">
                <dt><i class="fa-regular fa-calendar" aria-hidden="true"></i> Posted</dt>
                <dd>{{ $job->created_at->format('d.m.Y') }}</dd>
            </div>
            @if (!empty($job->location))
                <div class="job-detail__meta-item">
                    <dt><i class="fa-solid fa-location-dot" aria-hidden="true"></i> Location</dt>
                    <dd>{{ $job->location }}</dd>
                </div>
            @endif
            @if (!empty($job->city))
                <div class="job-detail__meta-item">
                    <dt><i class="fa-solid fa-city" aria-hidden="true"></i> City</dt>
                    <dd>{{ $job->city }}</dd>
                </div>
            @endif
            @if (!empty($job->address))
                <div class="job-detail__meta-item">
                    <dt><i class="fa-solid fa-map-location-dot" aria-hidden="true"></i> Address</dt>
                    <dd>{{ $job->address }}</dd>
                </div>
            @endif
            @if (!empty($job->post_code))
                <div class="job-detail__meta-item">
                    <dt><i class="fa-solid fa-map" aria-hidden="true"></i> Post code</dt>
                    <dd>{{ $job->post_code }}</dd>
                </div>
            @endif
        </dl>

        <div class="job-detail__bookmark-row flex flex-wrap items-center justify-between gap-3">
            <p class="job-detail__bookmark-hint">Save this role to revisit it later.</p>
            <div class="job-detail__bookmark-control">
                <button
                    type="button"
                    class="job-detail__bookmark-button bookmark-job-button"
                    @disabled(empty(auth()->id()))
                    @if (!empty(auth()->id())) data-user-id="{{ auth()->id() }}" @endif
                    data-job-id="{{ $job->id }}"
                    data-token="{{ csrf_token() }}"
                    aria-label="{{ !empty($savedJobExists) ? 'Remove job from saved jobs' : 'Save job' }}"
                    title="{{ empty(auth()->id()) ? 'Log in to save this job' : (!empty($savedJobExists) ? 'Remove saved job' : 'Save job') }}"
                >
                    <i class="bookmark fa-bookmark {{ !empty($savedJobExists) ? 'fa-solid' : 'fa-regular' }}" aria-hidden="true"></i>
                    <span>{{ !empty($savedJobExists) ? 'Saved' : 'Save job' }}</span>
                </button>
                <p class="bookmark-message job-detail__bookmark-message" aria-live="polite"></p>
            </div>
        </div>
    </section>

    <div class="job-detail__body grid grid-cols-1 items-start gap-6 lg:grid-cols-[minmax(0,1fr)_20rem]">
        <article class="job-detail__description-card rounded-3xl p-5 sm:p-8">
            <section class="job-detail__section">
                <p class="job-detail__section-eyebrow">The role</p>
                <h2 class="job-detail__section-title">Job description</h2>
                <div class="job-detail__rich-text">{!! $job->description !!}</div>
            </section>

            <section class="job-detail__section">
                <p class="job-detail__section-eyebrow">What you bring</p>
                <h2 class="job-detail__section-title">Skills and experience</h2>
                <div class="job-detail__rich-text">{!! $job->skillset_About !!}</div>
            </section>

            <section class="job-detail__section">
                <p class="job-detail__section-eyebrow">Why join</p>
                <h2 class="job-detail__section-title">Key features and benefits</h2>
                <div class="job-detail__rich-text">{!! $job->benefits !!}</div>
            </section>
        </article>

        <aside class="job-detail__apply-card rounded-3xl p-5 sm:p-6">
            <span class="job-detail__apply-icon" aria-hidden="true"><i class="fa-solid fa-paper-plane"></i></span>
            <h2 class="job-detail__apply-title">Interested in this role?</h2>
            <p class="job-detail__apply-description">Take the next step and send in your application.</p>

            @if (!empty($user) && !empty($hasApplied))
                <p class="job-detail__applied" role="status">
                    <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                    You have already applied for this job.
                </p>
            @elseif (!empty($user))
                <a class="job-detail__apply-button mt-5 inline-flex w-full items-center justify-center gap-2 rounded-xl px-5 py-3 font-bold" href="/job/{{ $job->id }}/{{ $job->slug }}/apply">
                    Apply for this job
                    <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                </a>
            @else
                <p class="job-detail__login-prompt">
                    <a href="{{ route('user.login') }}">Log in</a> or
                    <a href="{{ route('user.register') }}">create an account</a>
                    to apply.
                </p>
            @endif
        </aside>
    </div>
</main>
@endsection
@push('other-scripts')
<script src="https://code.jquery.com/jquery-4.0.0.min.js" integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao=" crossorigin="anonymous"></script>
<script src="{{ URL::asset('js/bookmark-job.js') }}"></script>
@endpush
