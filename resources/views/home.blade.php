<x-layout>
    @section('title','home')
    @section('content')
    <!-- Include this script tag or install `@tailwindplus/elements` via npm: -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script> -->
    <div class="bg-white">



        <div class="relative isolate px-6  lg:px-8">
            <div aria-hidden="true" class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80">
                <div style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)" class="relative left-[calc(50%-11rem)] aspect-1155/678 w-144.5 -translate-x-1/2 rotate-30 bg-linear-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-288.75"></div>
            </div>
            <div class="mx-auto py-32 sm:py-24 lg:py-12">
                <div class="">
                    <div>
                        <form method="GET" action="/">
                            <div class="columns-1">

                                <label for="search" class="block mb-2.5 text-sm font-medium text-heading">Search</label>
                                <input type="text" id="search" name="search" value="{{ request('search') }}" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-2.5 py-2 shadow-xs placeholder:text-body" placeholder="Search e.g. Manager" />

                                <select name="category">
                                    <option value="">All Categories</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" name="category" @selected(request('category')==$category->id)>
                                        {{ $category->name }}
                                    </option>
                                    @endforeach
                                </select>

                                <button type="submit">Search</button>
                                <a href="/">Reset</a>
                                {{-- <div>
                                    <button>
                                        reset
                                    </button>
                                </div> --}}
                            </div>
                            <div class="columns-1">

                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div aria-hidden="true" class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]">
                <div style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)" class="relative left-[calc(50%+3rem)] aspect-1155/678 w-144.5 -translate-x-1/2 bg-linear-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-288.75"></div>
            </div>
        </div>
    </div>

    <div class="relative isolate px-6 lg:px-24 mx-64 px-128">
        @foreach ($jobListings as $jobListing)
        <div class="columns-1 py-12">
            <a href="/job/{{ $jobListing->id }}" class="bg-neutral-primary-soft block  p-6 border rounded-xl border-default rounded-base shadow-xs hover:bg-neutral-secondary-medium">
                {{-- <span class="bg-brand-softer border border-brand-subtle text-fg-brand-strong text-xs font-medium px-1.5 py-0.5 rounded-sm">4.8 out of 5</span> --}}
                <h3 class="mb-3 text-2xl font-semibold tracking-tight text-heading leading-8">{{ $jobListing->title }}</h3>
                <h6>{{ $jobListing->category->name }} | {{ $jobListing->category->id }}</h6>
                <span class="bg-success-soft text-fg-success-strong text-xs font-medium px-1.5 py-0.5 rounded bg-green-300">£{{ $jobListing->salary_min }} - £{{ $jobListing->salary_max }}</span>
                <p class="text-body">{{ $jobListing->job_type }}</p>
                <p class="text-body">{{ $jobListing->location }}</p>
            </a>
        </div>

        @endforeach
    </div>

    <div class="relative isolate px-6 lg:px-8 mx-64">
        {{ $jobListings->links() }}
    </div>
    @endsection
</x-layout>
