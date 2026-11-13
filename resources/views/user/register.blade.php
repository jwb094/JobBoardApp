@extends('layouts.layout')
@section('title', 'Applicant Registration')
@section('content')
<div class="auth-page">
    <div class="auth-card">
        <div class="auth-header">
            <h2>Create account</h2>
            <p>Join and start exploring opportunities</p>
        </div>

        @if ($errors->any())
            <ul class="auth-errors" role="alert">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action="/user/create" method="POST" class="auth-form">
            @csrf

            <div class="auth-field">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name" placeholder="Type your first name" required>
            </div>

            <div class="auth-field">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" placeholder="Type your last name" required>
            </div>

            <div class="auth-field">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Type your email address" required>
            </div>

            <div class="auth-field">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Type your password" required>
            </div>

            <button type="submit" class="auth-submit">Register</button>
        </form>
    </div>
</div>
@endsection