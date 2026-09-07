@extends('layouts.layout')
@section('title',$user->first_name." ". $user->last_name." Dashboard")
@section('content')

<div class="bg-white ">
    <div class=" h-screen relative isolate h-lvh   px-6  lg:px-8">


        <section class="bg-neutral-primary">
            <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
                <div class="bg-neutral-secondary-soft border border-default rounded-base p-8 md:p-12 mb-8">
                    <h1 class="text-heading tracking-tighter text-3xl md:text-5xl font-bold my-6"> Personal Details</h1>
                    <a href="/employer/edit/{{ $user->id }}" type="button" class="inline-flex items-center justify-center text-black bg-brand hover:bg-brand-strong box-border border border-transparent focus:ring-4 focus:ring-brand-medium shadow-xs font-medium rounded-base text-base px-5 py-3 focus:outline-none">
                        Update your Personal Details
                        <svg class="w-4 h-4 ms-1.5 -me-0.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" /></svg>
                    </a>
                </div>
                <div class="grid md:grid-cols-2 gap-8">

                    <x-dashboard.card class="bg-neutral-secondary-soft border border-default rounded-xl p-8 md:p-12 flex flex-col" cardTitle="Jobs & Applications">
                        <p class=" font-normal text-body mb-4">No. of jobs {{ $jobCount }}</p>


                        <p class=" font-normal text-body mb-4"> No.Of Applicants {{ $applicantCount }}</p>


                        <a href=" {{ route('employer.applicantsAndJob.page') }}" class="text-fg-brand hover:underline font-medium text-lg inline-flex items-center">View Jobs & Applications
                            <svg class="w-6 h-6 rtl:rotate-180 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" /></svg>
                        </a>
                    </x-dashboard.card>
                    <x-dashboard.card class="bg-neutral-secondary-soft border border-default rounded-xl p-8 md:p-12 flex flex-col" cardTitle="New Job">
                        <a href="{{ route('employer.newjobdesc.page') }}" class="text-fg-brand hover:underline font-medium text-lg inline-flex items-center">Create a new posting
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
