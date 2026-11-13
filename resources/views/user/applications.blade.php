@extends('layouts.layout')
@section('title', 'Applications')
@section('content')
<main class="user-applications mx-auto flex min-h-[calc(100svh-220px)] max-w-6xl flex-col justify-center px-4 py-8">
    <header class="user-applications__header">
        <div>
            <p class="user-applications__eyebrow">Your job search</p>
            <h1 class="user-applications__title">Applications</h1>
            <p class="user-applications__description">Keep track of the roles you’ve applied for and their latest status.</p>
        </div>
        <span class="user-applications__count">
            <i class="fa-solid fa-paper-plane" aria-hidden="true"></i>
            {{ $userApplications->count() }} {{ \Illuminate\Support\Str::plural('application', $userApplications->count()) }}
        </span>
    </header>

    @if ($userApplications->isEmpty())
        <section class="user-applications__empty">
            <span class="user-applications__empty-icon"><i class="fa-regular fa-folder-open" aria-hidden="true"></i></span>
            <h2 class="user-applications__empty-title">No applications yet</h2>
            <p class="user-applications__empty-description">When you apply for a role, it will appear here so you can keep track of it.</p>
            <a href="/" class="user-applications__browse-link">Explore open jobs <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
        </section>
    @else
        <section class="user-applications__table-wrap overflow-x-auto" aria-label="Your job applications">
            <table class="user-applications__table w-full">
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
                                <span class="user-applications__job-title">{{ $application->jobListing->title }}</span>
                            </th>
                            <td data-label="Applied date">{{ $application->created_at->format('F d, Y') }}</td>
                            <td data-label="Status">
                                <span class="user-applications__status">{{ $application->status }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    @endif
</main>
@endsection
