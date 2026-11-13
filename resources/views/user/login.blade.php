@extends('layouts.layout')
@section('title', 'Applicant Login')
@section('content')
<div class="auth-page">
    <div class="auth-card">
        <div class="auth-header">
            <h2>Welcome back</h2>
            <p>Sign in to continue your job search</p>
        </div>

        @if ($errors->any())
            <ul class="auth-errors" role="alert">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action="/user/login" method="POST" class="auth-form">
            @csrf

            <div class="auth-field">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Type your email address" required>
            </div>

            <div class="auth-field">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Type your password" required>
            </div>

            <button type="submit" class="auth-submit">Login</button>
        </form>
    </div>
</div>
@endsection