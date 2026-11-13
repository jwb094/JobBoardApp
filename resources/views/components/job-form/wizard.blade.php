@props([
    'title',
    'description',
    'action',
    'submitLabel' => 'Save job',
    'method' => 'POST',
])

<main class="job-form-page">
    <section class="job-form-card">
        <header class="job-form-header">
            <span class="job-form-icon"><i class="fa-solid fa-briefcase" aria-hidden="true"></i></span>
            <p class="dashboard-eyebrow">Employer workspace</p>
            <h1>{{ $title }}</h1>
            <p>{{ $description }}</p>
        </header>

        <x-auth.errors />

        <div id="form-container" class="job-wizard">
            <div id="steps-bar" class="job-steps-bar" aria-label="Job form steps">
                <span class="step-indicator active" aria-label="Step 1">1</span>
                <span class="step-indicator" aria-label="Step 2">2</span>
                <span class="step-indicator" aria-label="Step 3">3</span>
            </div>

            <form action="{{ $action }}" method="POST" id="multi-step" class="job-form">
                @csrf
                @if (strtoupper($method) !== 'POST')
                    @method($method)
                @endif

                {{ $slot }}

                <div class="auth-step-actions">
                    <button type="button" class="auth-step-button auth-step-button--secondary" id="previousBtn" onclick="prevStep()" disabled>Previous</button>
                    <button type="button" class="auth-step-button" id="nextBtn" onclick="nextStep()">Next</button>
                    <button type="submit" class="auth-step-button auth-step-button--submit" id="submitBtn" style="display: none;">{{ $submitLabel }}</button>
                </div>
            </form>
        </div>
    </section>
</main>
