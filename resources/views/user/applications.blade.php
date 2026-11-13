@extends('layouts.layout')
@section('title', 'Applications')
@section('content')
<main class="applications-page">
    <header class="applications-header">
        <div>
            <p class="dashboard-eyebrow">Your job search</p>
            <h1>Applications</h1>
            <p>Keep track of the roles you’ve applied for and their latest status.</p>
        </div>
        <span class="applications-count">
            <i class="fa-solid fa-paper-plane" aria-hidden="true"></i>
            {{ $userApplications->count() }} {{ \Illuminate\Support\Str::plural('application', $userApplications->count()) }}
        </span>
    </header>

    @if ($userApplications->isEmpty())
        <section class="applications-empty">
            <span class="applications-empty-icon"><i class="fa-regular fa-folder-open" aria-hidden="true"></i></span>
            <h2>No applications yet</h2>
            <p>When you apply for a role, it will appear here so you can keep track of it.</p>
            <a href="/" class="applications-browse-link">Explore open jobs <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
        </section>
    @else
        <section class="applications-table-wrap" aria-label="Your job applications">
            <table class="applications-table">
                <thead>
                    <tr>
                        <th scope="col">Job title</th>
                        <th scope="col">Applied date</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($userApplications as $application)
                        <tr>
                            <th scope="row" data-label="Job title">
                                <span class="application-job-title">{{ $application->jobListing->title }}</span>
                            </th>
                            <td data-label="Applied date">{{ $application->created_at->format('F d, Y') }}</td>
                            <td data-label="Status">
                                <span class="application-status">{{ $application->status }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    @endif
</main>
@endsection
