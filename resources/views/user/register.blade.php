@extends('layouts.layout')
@section('title', 'Applicant Registration')
@section('content')
<div class="auth-page">
    <div class="auth-card">
        <div class="auth-header">
            <h2>Create account</h2>
            <p>Join and start exploring opportunities</p>
        </div>

        <x-auth.errors />

        <form action="/user/create" method="POST" class="auth-form">
            @csrf
            <x-auth.field name="first_name" label="First name" placeholder="Type your first name" required />
            <x-auth.field name="last_name" label="Last name" placeholder="Type your last name" required />
            <x-auth.field name="email" label="Email" type="email" placeholder="Type your email address" autocomplete="email" required />
            <x-auth.field name="password" label="Password" type="password" placeholder="Type your password" autocomplete="new-password" required />
            <button type="submit" class="auth-submit">Register</button>
        </form>
    </div>
</div>
@endsection