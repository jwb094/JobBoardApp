@extends('layouts.layout')
@section('title', 'Applicant Login')
@section('content')
<div class="auth-page">
    <div class="auth-card">
        <div class="auth-header">
            <h2>Welcome back</h2>
            <p>Sign in to continue your job search</p>
        </div>

        <x-auth.errors />

        <form action="/user/login" method="POST" class="auth-form">
            @csrf
            <x-auth.field name="email" label="Email" type="email" placeholder="Type your email address" autocomplete="email" required />
            <x-auth.field name="password" label="Password" type="password" placeholder="Type your password" autocomplete="current-password" required />
            <button type="submit" class="auth-submit">Login</button>
        </form>
    </div>
</div>
@endsection