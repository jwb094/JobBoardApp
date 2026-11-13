@extends('layouts.layout')
@section('title', 'Employer Registration')
@section('content')
<div class="auth-page auth-page--registration">
    <section class="auth-card auth-card--wide">
        <header class="auth-header">
            <p class="dashboard-eyebrow">Employer portal</p>
            <h2>Create your company profile</h2>
            <p>Set up your organization and hiring account in a few steps.</p>
        </header>

        <x-auth.errors />

        <div id="form-container" class="employer-registration">
            <div id="steps-bar" aria-label="Registration steps">
                <span class="step-indicator active" aria-label="Step 1">1</span>
                <span class="step-indicator" aria-label="Step 2">2</span>
                <span class="step-indicator" aria-label="Step 3">3</span>
            </div>

            <form action="{{ route('employer.store') }}" method="POST" id="multi-step" class="auth-form">
                @csrf
                <div class="step active">
                    <h3>Company information</h3>
                    <x-auth.field
                        name="company_name"
                        label="Company name"
                        placeholder="Type your company name"
                    />
                    <x-auth.field
                        name="company_tel"
                        label="Company telephone"
                        type="tel"
                        placeholder="Type your company telephone number"
                    />
                    <div class="auth-field">
                        <label for="company_size">Company size</label>
                        <select name="company_size" id="company_size">
                            <option value="1 - 10" @selected(old('company_size') === '1 - 10')>1 - 10</option>
                            <option value="10 - 25" @selected(old('company_size') === '10 - 25')>10 - 25</option>
                            <option value="25 - 50" @selected(old('company_size') === '25 - 50')>25 - 50</option>
                            <option value="50 - 100" @selected(old('company_size') === '50 - 100')>50 - 100</option>
                            <option value="100+" @selected(old('company_size') === '100+')>100+</option>
                        </select>
                    </div>
                </div>

                <div class="step">
                    <h3>Personal details</h3>
                    <x-auth.field
                        name="first_name"
                        label="First name"
                        placeholder="Type your first name"
                    />
                    <x-auth.field
                        name="last_name"
                        label="Last name"
                        placeholder="Type your last name"
                    />
                </div>

                <div class="step">
                    <h3>Account details</h3>
                    <x-auth.field
                        name="email"
                        label="Email"
                        type="email"
                        placeholder="Type your email address"
                        autocomplete="email"
                    />
                    <x-auth.field
                        name="password"
                        label="Password"
                        type="password"
                        placeholder="Create a password"
                        autocomplete="new-password"
                    />
                </div>

                <div class="auth-step-actions">
                    <button type="button" class="auth-step-button auth-step-button--secondary" id="previousBtn" onclick="prevStep()" disabled>Previous</button>
                    <button type="button" class="auth-step-button" id="nextBtn" onclick="nextStep()">Next</button>
                    <button type="submit" class="auth-step-button auth-step-button--submit" id="submitBtn" style="display: none;">Create account</button>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
@push('other-scripts')
<script src="{{ URL::asset('js/multi-step-form.js') }}"></script>
@endpush
