@extends('layouts.layout')
@section('title', $companyName . ' Jobs & Applicants')
@section('content')
<main class="employer-jobs mx-auto flex min-h-[calc(100svh-220px)] max-w-6xl flex-col justify-center px-4 py-8">
    <header class="employer-jobs__header mb-6 flex flex-col gap-5 rounded-3xl p-6 sm:flex-row sm:items-center sm:justify-between sm:p-10">
        <div>
            <p class="employer-jobs__eyebrow">Employer workspace</p>
            <h1 class="employer-jobs__title">Jobs &amp; applicants</h1>
            <p class="employer-jobs__description">Review your roles and the applicants interested in joining {{ $companyName }}.</p>
        </div>
        <a href="{{ route('employer.newjobdesc.page') }}" class="employer-jobs__create inline-flex items-center justify-center gap-2 rounded-xl px-5 py-3 font-bold">
            <i class="fa-solid fa-plus" aria-hidden="true"></i>
            Create a job
        </a>
    </header>

    @if ($jobsAndApplicants->isEmpty())
        <section class="employer-jobs__empty flex min-h-80 flex-col items-center justify-center rounded-3xl p-8 text-center">
            <span class="employer-jobs__empty-icon"><i class="fa-solid fa-briefcase" aria-hidden="true"></i></span>
            <h2 class="employer-jobs__empty-title">No job postings yet</h2>
            <p class="employer-jobs__empty-description">Create your first job posting to start connecting with applicants.</p>
            <a href="{{ route('employer.newjobdesc.page') }}" class="employer-jobs__empty-action mt-5 inline-flex items-center gap-2 rounded-xl px-4 py-3 font-bold">
                Create a job posting
                <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
            </a>
        </section>
    @else
        <section class="employer-jobs__list flex flex-col gap-4" aria-label="Your job postings">
            @foreach ($jobsAndApplicants as $job)
                <article class="employer-jobs__card grid grid-cols-1 gap-2 rounded-2xl p-4 sm:grid-cols-[minmax(0,1fr)_auto] sm:gap-4 sm:px-5">
                    <details class="employer-jobs__details min-w-0">
                        <summary class="employer-jobs__summary flex min-h-18 cursor-pointer items-center gap-3">
                            <span class="employer-jobs__icon"><i class="fa-solid fa-briefcase" aria-hidden="true"></i></span>
                            <span class="employer-jobs__summary-copy min-w-0 flex-1">
                                <span class="employer-jobs__job-title">{{ $job->title }}</span>
                                <span class="employer-jobs__applicant-count">
                                    {{ $job->applications->count() }} {{ \Illuminate\Support\Str::plural('applicant', $job->applications->count()) }}
                                </span>
                            </span>
                            <i class="fa-solid fa-chevron-down employer-jobs__chevron" aria-hidden="true"></i>
                        </summary>

                        <div class="employer-jobs__applicants pb-4">
                            @if ($job->applications->isEmpty())
                                <p class="employer-jobs__no-applicants">No applicants for this posting yet. Check back later.</p>
                            @else
                                <h2 class="employer-jobs__applicants-title">Applicants</h2>
                                <ul class="flex flex-wrap gap-2">
                                    @foreach ($job->applications as $applicant)
                                        <li class="employer-jobs__applicant inline-flex items-center gap-2 rounded-full py-1 pl-1 pr-3">
                                            <span class="employer-jobs__avatar" aria-hidden="true">
                                                {{ strtoupper(substr($applicant->applicantUsers->first_name, 0, 1)) }}
                                            </span>
                                            <span>{{ $applicant->applicantUsers->first_name }} {{ $applicant->applicantUsers->last_name }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </details>

                    <div class="employer-jobs__actions flex items-center justify-end gap-2 sm:pt-4">
                        <a href="{{ route('employer.editjobdesc.page', $job->id) }}" class="employer-jobs__edit inline-flex items-center justify-center gap-2 rounded-lg px-3 py-2 font-bold">
                            <i class="fa-solid fa-pen" aria-hidden="true"></i>
                            Edit
                        </a>
                        <form action="{{ route('employer.deletejob', $job->id) }}" method="POST" onsubmit="return confirm('Delete this job posting?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="employer-jobs__delete inline-flex items-center justify-center gap-2 rounded-lg px-3 py-2 font-bold">
                                <i class="fa-solid fa-trash" aria-hidden="true"></i>
                                Delete
                            </button>
                        </form>
                    </div>
                </article>
            @endforeach
        </section>
    @endif
</main>
@endsection
