@extends('layouts.layout')
    @push('styles')
    @endpush
    @section('title',$companyName." Jobs & Applicants")
    @section('content')

    <div class="bg-white ">
        <div class=" h-screen relative isolate   px-6  lg:px-8">
            <h1 class="flex flex-row text-center justify-center | my-5">{{ $companyName }} Jobs & Applicants</h1>
            @foreach($jobsAndApplicants as $sectionIndex => $jobsAndApplicant)
            <section class="mb-6">


                <div id="accordion-{{ $sectionIndex }}" class="w-full" data-accordion="collapse">


                    <h2 id="accordion-heading-{{ $sectionIndex }}">
                        <button type="button" class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 bg-gray-100 rounded-t-lg hover:bg-gray-200" data-accordion-target="#accordion-body-{{ $sectionIndex }}" aria-expanded="true" aria-controls="accordion-body-{{ $sectionIndex }}">
                            {{ $jobsAndApplicant->title }}
                            <a class="w-40 px-2 | | text-white bg-green-500 hover:bg-green-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm py-2" href={{ route('employer.editjobdesc.page', $jobsAndApplicant->id) }}>Edit</a>
                            <a class="w-40 px-2 | | text-white bg-red-800 hover:bg-red-500 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm py-2" href={{ route('employer.deletejob', $jobsAndApplicant->id) }}>Delete</a>
                            <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>

                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-body-{{ $sectionIndex }}" class="hidden" aria-labelledby="accordion-heading-{{ $sectionIndex }}">
                        <div class="p-5 font-light border border-gray-200 border-t-0">

                            @if (count($jobsAndApplicant->applications) === 0)
                            <p>Currently there has been no applicants for this Job Post so far</p>
                            @endif
                            @if (count($jobsAndApplicant->applications) > 0)
                            @foreach($jobsAndApplicant->applications as $applicantIndex => $applicant)
                            <ul class="flex flex-row">
                                <li>{{ $applicantIndex + 1 .")" }} {{ $applicant->applicantUsers->first_name }} &nbsp; {{ $applicant->applicantUsers->last_name }}</li>
                                <li>

                                </li>
                            </ul>

                            @endforeach
                            @endif

                        </div>
                    </div>
                </div>

            </section>

            @endforeach


        </div>
    </div>
    @endsection
    @push('other-scripts')
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
    @endpush
