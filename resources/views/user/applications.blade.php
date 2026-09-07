@extends('layouts.layout')
    @section('title','Applications')
    @section('content')
    <!-- Include this script tag or install `@tailwindplus/elements` via npm: -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script> -->
    <div class="bg-white">





        <div aria-hidden="true" class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]">
            <div style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)" class="relative left-[calc(50%+3rem)] aspect-1155/678 w-144.5 -translate-x-1/2 bg-linear-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-288.75"></div>
        </div>
    </div>
    </div>

    <div class="relative isolate px-6 lg:px-24 | xs:mx-24 md:mx-36  md:px-128">
        <div class="columns-1 pt-12">
            <h1>Applications</h1>
        </div>
        <div class="columns-1 pb-12">


            <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default | md:mt-12">
                <table class="w-full text-sm text-left rtl:text-right text-body">
                    <thead class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default">
                        <tr>
                            <th scope="col" class="px-6 py-3 font-medium">
                                Job Title
                            </th>
                            <th scope="col" class="px-6 py-3 font-medium">
                                Applied Date 
                            </th>
                            <th scope="col" class="px-6 py-3 font-medium">
                                Status
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($userApplications as $application)
                        <tr class="bg-neutral-primary border-b border-default">
                            <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                                {{ $application->jobListing->title }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $application->created_at->format('F d Y') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $application->status }}
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>





        </div>


    </div>
    @endsection

