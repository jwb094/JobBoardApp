@props([
    'title',
    'description',
    'action',
    'submitLabel' => 'Save job',
    'method' => 'POST',
])

<main class="employer-job-form mx-auto flex min-h-[calc(100svh-150px)] items-center justify-center px-4 py-8">
    <section class="employer-job-form__card w-full max-w-5xl rounded-3xl p-6 sm:p-9">
        <header class="employer-job-form__header mb-6 text-center">
            <span class="employer-job-form__icon"><i class="fa-solid fa-briefcase" aria-hidden="true"></i></span>
            <p class="employer-job-form__eyebrow">Employer workspace</p>
            <h1 class="employer-job-form__title">{{ $title }}</h1>
            <p class="employer-job-form__description">{{ $description }}</p>
        </header>

        <x-auth.errors />

        <div id="form-container" class="employer-job-form__wizard rounded-2xl p-4 sm:p-7">
            <div id="steps-bar" class="employer-job-form__steps flex justify-between" aria-label="Job form steps">
                <span class="step-indicator employer-job-form__step-indicator active" aria-label="Step 1">1</span>
                <span class="step-indicator employer-job-form__step-indicator" aria-label="Step 2">2</span>
                <span class="step-indicator employer-job-form__step-indicator" aria-label="Step 3">3</span>
            </div>

            <form action="{{ $action }}" method="POST" id="multi-step" class="employer-job-form__form flex flex-col gap-5">
                @csrf
                @if (strtoupper($method) !== 'POST')
                    @method($method)
                @endif

                {{ $slot }}

                <div class="employer-job-form__actions flex justify-between gap-3">
                    <button type="button" class="employer-job-form__button employer-job-form__button--secondary" id="previousBtn" onclick="prevStep()" disabled>Previous</button>
                    <button type="button" class="employer-job-form__button" id="nextBtn" onclick="nextStep()">Next</button>
                    <button type="submit" class="employer-job-form__button employer-job-form__button--submit" id="submitBtn" style="display: none;">{{ $submitLabel }}</button>
                </div>
            </form>
        </div>
    </section>
</main>
