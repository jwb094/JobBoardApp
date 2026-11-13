@extends('layouts.layout')
@section('title', $job->title . ' Job Application Page')
@section('content')
<div class="application-page">
    @if ($errors->any())
        <div class="application-alert" role="alert">
            @foreach ($errors->all() as $error)
                <span>{{ $error }}</span>
            @endforeach
        </div>
    @endif

    <section class="application-hero">
        <div>
            <p class="eyebrow">Application</p>
            <h1>{{ $job->title }}</h1>

            <div class="application-meta">
                <span class="meta-chip"><i class="fa-solid fa-briefcase"></i> {{ $job->category->name }}</span>
                <span class="meta-chip"><i class="fa-solid fa-clock"></i> {{ ucfirst($job->job_type) }}</span>
                <span class="meta-chip"><i class="fa-solid fa-calendar"></i> {{ $job->created_at->format('d.m.Y') }}</span>
            </div>
        </div>

        <aside class="summary-card">
            <h2>Role summary</h2>
            <ul class="summary-list">
                <li>
                    <i class="fa-solid fa-briefcase"></i>
                    <span><strong>Category:</strong> {{ $job->category->name }}</span>
                </li>
                <li>
                    <i class="fa-solid fa-money-bill-wave"></i>
                    @if (!empty($job->salary_min) && !empty($job->salary_max))
                        <span><strong>Salary:</strong> £{{ $job->salary_min }} - £{{ $job->salary_max }}</span>
                    @elseif (empty($job->salary_min) && empty($job->salary_max))
                        <span><strong>Salary:</strong> No information received</span>
                    @elseif (empty($job->salary_min) && !empty($job->salary_max))
                        <span><strong>Salary:</strong> Starting from £{{ $job->salary_max }}</span>
                    @else
                        <span><strong>Salary:</strong> Up to £{{ $job->salary_min }}</span>
                    @endif
                </li>
                @if (!empty($job->location))
                    <li>
                        <i class="fa-solid fa-location-dot"></i>
                        <span><strong>Location:</strong> {{ $job->location }}</span>
                    </li>
                @endif
            </ul>
        </aside>
    </section>

    <div class="application-content">
        <section class="panel">
            <h2>Personal details</h2>
            <ul class="profile-list">
                <li>
                    <i class="fa-solid fa-user"></i>
                    <span>{{ $user->first_name }} {{ $user->last_name }}</span>
                </li>
                <li>
                    <i class="fa-solid fa-envelope"></i>
                    <span>{{ $user->email }}</span>
                </li>
            </ul>
        </section>

        @if (empty($user->cover_letter) && empty($user->cv))
            <section class="panel">
                <h2>Documents required</h2>
                <div class="application-alert" role="alert">
                    <span>Please upload a CV and cover letter</span>
                    <a href="{{ route('user.documents', $user->id) }}">here</a>
                    <span>to apply for this role.</span>
                </div>
            </section>
        @endif

        @if (!empty($user->cover_letter) && !empty($user->cv))
            <section class="panel" style="grid-column: 1 / -1;">
                <h2>Upload your documents</h2>
                <form action="{{ route('job.apply', ['job_id' => $job->id, 'user_id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="job_id" value="{{ $job->id }}">

                    <div class="form-grid">
                        <div class="app-field">
                            <label for="cover_letter">Cover letter</label>
                            @if (empty($user->cover_letter))
                                <input type="file" name="cover_letter" id="cover_letter">
                            @else
                                <input type="text" name="cover_letter" value="{{ $user->cover_letter }}">
                            @endif
                        </div>

                        <div class="app-field">
                            <label for="resume_path">CV</label>
                            @if (empty($user->cv))
                                <input type="file" name="resume_path" id="resume_path">
                            @else
                                <input type="text" name="resume_path" value="{{ $user->cv }}">
                            @endif
                        </div>

                        <button type="submit" class="submit-btn">Apply now</button>
                    </div>
                </form>
            </section>
        @endif
    </div>
</div>
@endsection
