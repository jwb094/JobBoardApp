<x-layout>
    @section('title','Saved Job List')
    @section('content')
    <!-- Include this script tag or install `@tailwindplus/elements` via npm: -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script> -->
    <div class="bg-white">





        <div aria-hidden="true" class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]">
            <div style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)" class="relative left-[calc(50%+3rem)] aspect-1155/678 w-144.5 -translate-x-1/2 bg-linear-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-288.75"></div>
        </div>
    </div>
    </div>

    <div class="relative isolate px-6 lg:px-24 | xs:mx-24 md:mx-64 md:px-128">
        <div class="columns-1 pt-12">
            <h1>Saved Jobs</h1>
        </div>
        <div class="columns-1 pb-12">
            @foreach ($savedJobList as $jobListing)
            <a href="/job/{{ $jobListing->id }}/{{ $jobListing->slug }}" class="my-12 bg-neutral-primary-soft block  p-6 border border-default rounded-base shadow-xs hover:bg-neutral-secondary-medium">
                <h5 class="mb-3 text-2xl font-semibold tracking-tight text-heading leading-8">{{ $jobListing->title }}</h5>
                <p class="text-body">Company Name</p>
            </a>

            @endforeach
        </div>


    </div>
    @endsection
</x-layout>
