@extends('layouts.layout')
@section('title',$user->first_name." ". $user->last_name." Dashboard")
@section('content')

<div class="bg-white ">
    <div class="relative isolate h-lvh   px-6  lg:px-8">


        <section class="bg-neutral-primary">
            <div class="py-8 px-4 mx-auto max-w-7xl lg:py-16">
                <div class="bg-neutral-secondary-soft border border-default rounded-base p-8 md:p-12 mb-8">
                    <h1 class="text-heading tracking-tighter text-3xl md:text-5xl font-bold my-6"> Personal Details</h1>
                    <a href="/user/edit/{{ $user->id }}" type="button" class="inline-flex items-center justify-center text-black bg-brand hover:bg-brand-strong box-border border border-transparent focus:ring-4 focus:ring-brand-medium shadow-xs font-medium rounded-base text-base px-5 py-3 focus:outline-none">
                        Update your Personal Details
                        <svg class="w-4 h-4 ms-1.5 -me-0.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" /></svg>
                    </a>
                </div>
                <div class="grid md:grid-cols-3 gap-8">
                    <x-dashboard.card class="bg-neutral-secondary-soft border border-default rounded-xl p-8 md:p-12" cardTitle="Applications">
                        @if ($savedApplicationsCount === 0)
                        <p class=" font-normal text-body mb-4">You curretly haven't applied anywhere get started</p>
                        @endif
                        @if ($savedApplicationsCount > 0)
                        <p class=" font-normal text-body mb-4"> You have applied to {{ $savedApplicationsCount }} vacant roles</p>
                        @endif
                        @if ($savedApplicationsCount > 0)
                        <a href="/user/{{ $user->id }}/applications" class="text-fg-brand hover:underline font-medium text-lg inline-flex items-center">View your applications
                            <svg class="w-6 h-6 rtl:rotate-180 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" /></svg>
                        </a>
                        @endif
                    </x-dashboard.card>

                    <x-dashboard.card class="bg-neutral-secondary-soft border border-default rounded-xl p-8 md:p-12" cardTitle="Saved Jobs">
                        @if ($savedJobsCount === 0)
                        <p class=" font-normal text-body mb-4">You curretly haven't applied anywhere get started</p>
                        @endif
                        @if ($savedJobsCount > 0)
                        <p class=" font-normal text-body mb-4"> You have {{ $savedJobsCount }} saved Job roles</p>
                        @endif
                        @if ($savedJobsCount > 0)
                        <a href="/user/{{ $user->id }}/savedjobs" class="text-fg-brand hover:underline font-medium text-lg inline-flex items-center">View your saved Jobs
                            <svg class="w-6 h-6 rtl:rotate-180 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" /></svg>
                        </a>
                        @endif
                    </x-dashboard.card>
                    <x-dashboard.card class="bg-neutral-secondary-soft border border-default rounded-xl p-8 md:p-12 flex flex-col" cardTitle="Your documents">
                        <a href="/user/{{ $user->id }}/documents" class="text-fg-brand hover:underline font-medium text-lg inline-flex items-center">Read more
                            <svg class="w-6 h-6 rtl:rotate-180 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" /></svg>
                        </a>
                    </x-dashboard.card>
                </div>
            </div>
        </section>

    </div>
</div>

@endsection
