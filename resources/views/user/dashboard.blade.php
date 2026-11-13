@extends('layouts.layout')
@section('title', $user->first_name . ' ' . $user->last_name . ' Dashboard')
@section('content')
<main class="user-dashboard">
    <section class="dashboard-welcome">
        <div class="dashboard-welcome-copy">
            <p class="dashboard-eyebrow">Applicant dashboard</p>
            <h1>Welcome back, {{ $user->first_name }}</h1>
            <p>Keep your profile up to date and stay on top of the opportunities you care about.</p>
        </div>
        <a href="{{ route('user.update.page', $user->id) }}" class="dashboard-profile-link">
            <i class="fa-solid fa-user-pen" aria-hidden="true"></i>
            Update personal details
            <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
        </a>
    </section>

    <section class="dashboard-section" aria-labelledby="dashboard-tools-title">
        <div class="dashboard-section-heading">
            <div>
                <p class="dashboard-eyebrow">Your workspace</p>
                <h2 id="dashboard-tools-title">Manage your job search</h2>
            </div>
        </div>

        <div class="dashboard-grid">
            <x-dashboard.card class="dashboard-card" cardTitle="Applications">
                <span class="dashboard-card-icon"><i class="fa-solid fa-paper-plane" aria-hidden="true"></i></span>
                @if ($savedApplicationsCount === 0)
                    <p>You haven't applied for any roles yet. Find an opportunity that feels right and get started.</p>
                    <a href="{{ route('user.applications', $user->id) }}" class="dashboard-card-link">View your applications <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
                @else
                    <p>You have applied to <strong>{{ $savedApplicationsCount }}</strong> {{ \Illuminate\Support\Str::plural('role', $savedApplicationsCount) }}.</p>
                    <a href="{{ route('user.applications', $user->id) }}" class="dashboard-card-link">View your applications <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
                @endif
            </x-dashboard.card>

            <x-dashboard.card class="dashboard-card" cardTitle="Saved jobs">
                <span class="dashboard-card-icon"><i class="fa-solid fa-bookmark" aria-hidden="true"></i></span>
                @if ($savedJobsCount === 0)
                    <p>You haven't saved any jobs yet. Save roles to make it easy to come back to them.</p>
                    <a href="{{ route('user.savedjobs', $user->id) }}" class="dashboard-card-link">View saved jobs <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
                @else
                    <p>You have <strong>{{ $savedJobsCount }}</strong> saved {{ \Illuminate\Support\Str::plural('job', $savedJobsCount) }}.</p>
                    <a href="{{ route('user.savedjobs', $user->id) }}" class="dashboard-card-link">View saved jobs <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
                @endif
            </x-dashboard.card>

            <x-dashboard.card class="dashboard-card" cardTitle="Your documents">
                <span class="dashboard-card-icon"><i class="fa-solid fa-file-lines" aria-hidden="true"></i></span>
                <p>Manage your CV and cover letter so they're ready when you find the right role.</p>
                <a href="{{ route('user.documents', $user->id) }}" class="dashboard-card-link">Manage documents <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
            </x-dashboard.card>
        </div>
    </section>
</main>
@endsection
