@extends('layouts.layout')
@section('title', $user->first_name . ' ' . $user->last_name . ' Dashboard')
@section('content')
<main class="employer-dashboard">
    <section class="dashboard-welcome">
        <div class="dashboard-welcome-copy">
            <p class="dashboard-eyebrow">Employer dashboard</p>
            <h1>Welcome back, {{ $user->first_name }}</h1>
            <p>Manage your company profile, track applicants, and keep your hiring moving.</p>
        </div>
        <a href="{{ route('employer.profile.page', $user->id) }}" class="dashboard-profile-link">
            <i class="fa-solid fa-building-user" aria-hidden="true"></i>
            Update profile
            <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
        </a>
    </section>

    <section class="dashboard-section" aria-labelledby="employer-tools-title">
        <div class="dashboard-section-heading">
            <div>
                <p class="dashboard-eyebrow">Hiring workspace</p>
                <h2 id="employer-tools-title">Manage your hiring</h2>
            </div>
        </div>

        <div class="employer-dashboard-grid">
            <x-dashboard.card class="dashboard-card" cardTitle="Jobs &amp; applications">
                <span class="dashboard-card__icon"><i class="fa-solid fa-briefcase" aria-hidden="true"></i></span>
                <div class="employer-metrics">
                    <div class="employer-metric">
                        <strong>{{ $jobCount }}</strong>
                        <span>{{ \Illuminate\Support\Str::plural('job', $jobCount) }} posted</span>
                    </div>
                    <div class="employer-metric">
                        <strong>{{ $applicantCount }}</strong>
                        <span>{{ \Illuminate\Support\Str::plural('applicant', $applicantCount) }}</span>
                    </div>
                </div>
                <a href="{{ route('employer.applicantsAndJob.page') }}" class="dashboard-card__link">
                    View jobs &amp; applications
                    <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                </a>
            </x-dashboard.card>

            <x-dashboard.card class="dashboard-card employer-create-card" cardTitle="New job">
                <span class="dashboard-card__icon"><i class="fa-solid fa-circle-plus" aria-hidden="true"></i></span>
                <p>Have a role to fill? Create a posting and connect with your next great hire.</p>
                <a href="{{ route('employer.newjobdesc.page') }}" class="dashboard-card__link">
                    Create a new posting
                    <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                </a>
            </x-dashboard.card>
        </div>
    </section>
</main>
@endsection
