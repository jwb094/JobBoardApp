@extends('layouts.layout')
@section('title', $companyName . ' Jobs & Applicants')
@section('content')
<main class="employer-jobs-page">
    <header class="employer-jobs-header">
        <div>
            <p class="dashboard-eyebrow">Employer workspace</p>
            <h1>Jobs &amp; applicants</h1>
            <p>Review your open roles and the applicants interested in joining {{ $companyName }}.</p>
        </div>
        <a href="{{ route('employer.newjobdesc.page') }}" class="dashboard-profile-link">
            <i class="fa-solid fa-plus" aria-hidden="true"></i>
            Create a job
        </a>
    </header>

    @if ($jobsAndApplicants->isEmpty())
        <section class="applications-empty">
            <span class="applications-empty-icon"><i class="fa-solid fa-briefcase" aria-hidden="true"></i></span>
            <h2>No job postings yet</h2>
            <p>Create your first job posting to start connecting with applicants.</p>
            <a href="{{ route('employer.newjobdesc.page') }}" class="applications-browse-link">Create a job posting <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
        </section>
    @else
        <section class="employer-job-list" aria-label="Your job postings">
            @foreach ($jobsAndApplicants as $job)
                <article class="employer-job-card">
                    <details class="employer-job-details">
                        <summary>
                            <span class="employer-job-icon"><i class="fa-solid fa-briefcase" aria-hidden="true"></i></span>
                            <span class="employer-job-summary">
                                <span class="employer-job-title">{{ $job->title }}</span>
                                <span class="employer-job-applicant-count">
                                    {{ $job->applications->count() }} {{ \Illuminate\Support\Str::plural('applicant', $job->applications->count()) }}
                                </span>
                            </span>
                            <i class="fa-solid fa-chevron-down employer-job-chevron" aria-hidden="true"></i>
                        </summary>

                        <div class="employer-applicants">
                            @if ($job->applications->isEmpty())
                                <p class="employer-no-applicants">No applicants for this posting yet. Check back later.</p>
                            @else
                                <h2>Applicants</h2>
                                <ul>
                                    @foreach ($job->applications as $applicant)
                                        <li>
                                            <span class="employer-applicant-avatar" aria-hidden="true">
                                                {{ strtoupper(substr($applicant->applicantUsers->first_name, 0, 1)) }}
                                            </span>
                                            <span>{{ $applicant->applicantUsers->first_name }} {{ $applicant->applicantUsers->last_name }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </details>

                    <div class="employer-job-actions">
                        <a href="{{ route('employer.editjobdesc.page', $job->id) }}" class="employer-job-edit">
                            <i class="fa-solid fa-pen" aria-hidden="true"></i>
                            Edit
                        </a>
                        <form action="{{ route('employer.deletejob', $job->id) }}" method="POST" onsubmit="return confirm('Delete this job posting?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="employer-job-delete">
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
