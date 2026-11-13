@extends('layouts.layout')
@section('title', $user->first_name . ' ' . $user->last_name . ' Applicant Profile')
@section('content')
<main class="auth flex min-h-[calc(100svh-150px)] items-center justify-center px-4 py-8">
    <section class="auth__card w-full max-w-md rounded-3xl border p-6 shadow-xl sm:p-8">
        <header class="auth__header mb-6 text-center">
            <p class="auth__eyebrow">Applicant profile</p>
            <h1 class="auth__title">Update your details</h1>
            <p class="auth__description">Keep your account and contact information current.</p>
        </header>

        <x-auth.errors />

        <form action="{{ route('user.update', $user->id) }}" method="POST" class="auth__form flex flex-col gap-4">
            @csrf
            <x-auth.field name="first_name" label="First name" placeholder="Type your first name" :value="$user->first_name" autocomplete="given-name" required />
            <x-auth.field name="last_name" label="Last name" placeholder="Type your last name" :value="$user->last_name" autocomplete="family-name" required />
            <x-auth.field name="email" label="Email" type="email" placeholder="Type your email address" :value="$user->email" autocomplete="email" required />
            <x-auth.field name="password" label="Password" type="password" placeholder="Enter your password" autocomplete="new-password" required />
            <button type="submit" class="auth__submit mt-2 w-full rounded-xl px-5 py-3 font-bold">Save changes</button>
        </form>
    </section>
</main>
@endsection
