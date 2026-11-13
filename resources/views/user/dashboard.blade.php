@extends('layouts.layout')
@section('title', $user->first_name . ' ' . $user->last_name . ' Dashboard')
@section('content')
<main class="applicant-dashboard mx-auto flex min-h-[calc(100svh-220px)] max-w-7xl flex-col justify-center px-4 py-8">
    <section class="applicant-dashboard__welcome">
        <div class="applicant-dashboard__intro">
            <p class="applicant-dashboard__eyebrow">Applicant dashboard</p>
            <h1 class="applicant-dashboard__title">Welcome back, {{ $user->first_name }}</h1>
            <p class="applicant-dashboard__description">Keep your profile up to date and stay on top of the opportunities you care about.</p>
        </div>
        <a href="{{ route('user.update.page', $user->id) }}" class="applicant-dashboard__profile-link">
            <i class="fa-solid fa-user-pen" aria-hidden="true"></i>
            Update personal details
            <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
        </a>
    </section>

    <section class="applicant-dashboard__section" aria-labelledby="dashboard-tools-title">
        <div class="applicant-dashboard__section-heading">
            <div>
                <p class="applicant-dashboard__eyebrow">Your workspace</p>
                <h2 class="applicant-dashboard__section-title" id="dashboard-tools-title">Manage your job search</h2>
            </div>
        </div>

        <div class="applicant-dashboard__grid grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-3">
            <x-dashboard.card class="dashboard-card applicant-dashboard__card" cardTitle="Applications">
                <span class="dashboard-card__icon"><i class="fa-solid fa-paper-plane" aria-hidden="true"></i></span>
                @if ($savedApplicationsCount === 0)
                    <p>You haven't applied for any roles yet. Find an opportunity that feels right and get started.</p>
                    <a href="{{ route('user.applications', $user->id) }}" class="dashboard-card__link">View your applications <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
                @else
                    <p>You have applied to <strong>{{ $savedApplicationsCount }}</strong> {{ \Illuminate\Support\Str::plural('role', $savedApplicationsCount) }}.</p>
                    <a href="{{ route('user.applications', $user->id) }}" class="dashboard-card__link">View your applications <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
                @endif
            </x-dashboard.card>

            <x-dashboard.card class="dashboard-card applicant-dashboard__card" cardTitle="Saved jobs">
                <span class="dashboard-card__icon"><i class="fa-solid fa-bookmark" aria-hidden="true"></i></span>
                @if ($savedJobsCount === 0)
                    <p>You haven't saved any jobs yet. Save roles to make it easy to come back to them.</p>
                    <a href="{{ route('user.savedjobs', $user->id) }}" class="dashboard-card__link">View saved jobs <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
                @else
                    <p>You have <strong>{{ $savedJobsCount }}</strong> saved {{ \Illuminate\Support\Str::plural('job', $savedJobsCount) }}.</p>
                    <a href="{{ route('user.savedjobs', $user->id) }}" class="dashboard-card__link">View saved jobs <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
                @endif
            </x-dashboard.card>

            <x-dashboard.card class="dashboard-card applicant-dashboard__card" cardTitle="Your documents">
                <span class="dashboard-card__icon"><i class="fa-solid fa-file-lines" aria-hidden="true"></i></span>
                <p>Manage your CV and cover letter so they're ready when you find the right role.</p>
                <a href="{{ route('user.documents', $user->id) }}" class="dashboard-card__link">Manage documents <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
            </x-dashboard.card>
        </div>
    </section>
</main>
@endsection
