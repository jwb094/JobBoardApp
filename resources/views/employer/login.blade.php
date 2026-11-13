@extends('layouts.layout')
@section('title', 'Employer Login')
@section('content')
<div class="auth-page">
    <section class="auth-card">
        <header class="auth-header">
            <p class="dashboard-eyebrow">Employer portal</p>
            <h2>Welcome back</h2>
            <p>Sign in to manage your company’s hiring.</p>
        </header>

        <x-auth.errors />

        <form action="/employer/login" method="POST" class="auth-form">
            @csrf
            <x-auth.field
                name="email"
                label="Email"
                type="email"
                placeholder="Type your email address"
                autocomplete="email"
                required
            />
            <x-auth.field
                name="password"
                label="Password"
                type="password"
                placeholder="Type your password"
                autocomplete="current-password"
                required
            />
            <button type="submit" class="auth-submit">Login</button>
        </form>
    </section>
</div>
@endsection
