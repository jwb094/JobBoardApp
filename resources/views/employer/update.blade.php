@extends('layouts.layout')
@section('title', ucfirst($user->first_name) . ' ' . ucfirst($user->last_name) . ' Profile Details')
@section('content')
<div class="auth-page">
    <section class="auth-card">
        <header class="auth-header">
            <p class="dashboard-eyebrow">Employer profile</p>
            <h2>Update your details</h2>
            <p>Keep your account and contact information current.</p>
        </header>

        <x-auth.errors />

        <form action="{{ route('employer.updateprofile', $user->id) }}" method="POST" class="auth-form">
            @csrf
            @method('PUT')

            <x-auth.field
                name="first_name"
                label="First name"
                placeholder="Type your first name"
                :value="$user->first_name"
                autocomplete="given-name"
                required
            />
            <x-auth.field
                name="last_name"
                label="Last name"
                placeholder="Type your last name"
                :value="$user->last_name"
                autocomplete="family-name"
                required
            />
            <x-auth.field
                name="email"
                label="Email"
                type="email"
                placeholder="Type your email address"
                :value="$user->email"
                autocomplete="email"
                required
            />
            <x-auth.field
                name="password"
                label="Password"
                type="password"
                placeholder="Enter a new password"
                autocomplete="new-password"
                required
            />

            <button type="submit" class="auth-submit">Save changes</button>
        </form>
    </section>
</div>
@endsection
