@extends('layouts.layout')
@section('title', 'Applicant Login')
@section('content')
<main class="auth flex min-h-[calc(100svh-150px)] items-center justify-center px-4 py-8">
    <section class="auth__card w-full max-w-md rounded-3xl border p-6 shadow-xl sm:p-8">
        <header class="auth__header mb-6 text-center">
            <p class="auth__eyebrow">Applicant portal</p>
            <h1 class="auth__title">Welcome back</h1>
            <p class="auth__description">Sign in to continue your job search</p>
        </header>

        <x-auth.errors />

        <form action="/user/login" method="POST" class="auth__form flex flex-col gap-4">
            @csrf
            <x-auth.field name="email" label="Email" type="email" placeholder="Type your email address" autocomplete="email" required />
            <x-auth.field name="password" label="Password" type="password" placeholder="Type your password" autocomplete="current-password" required />
            <button type="submit" class="auth__submit mt-2 w-full rounded-xl px-5 py-3 font-bold">Login</button>
        </form>
    </section>
</main>
@endsection