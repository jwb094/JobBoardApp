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
            {{-- <div class="mx-auto py-32 sm:py-24 lg:py-12">
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


            <button type="submit" class="text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5">
                Search
            </button>
            <a class="text-white bg-orange-500 hover:bg-orange-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5" type="button" href="/">Reset</a>



        </div>

        </form>
    </div>
    </div>
    mx-auto my-32 sm:py-24 lg:py-12
    </div>--}}
    {{-- <div class="max-md:hidden mx-auto py-32 sm:py-24 lg:py-12">
        <!-- ... -->ss
        <div class="columns-1">
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


    <button type="submit" class="text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5">
        Search
    </button>
    <a class="text-white bg-orange-500 hover:bg-orange-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5" type="button" href="/">Reset</a>



    </div>

    </form>
    </div>
    </div> --}}
    <!-- DESKTOP-->
    <div class="max-md:hidden mx-auto pt-32 pb-8 sm:py-24 lg:py-12 relative isolate px-6  lg:px-8">
        {{-- <div class="columns-1"> --}}
        <form method="GET" action="/">
            <div class="flex justify-center | justify-center items-center gap-8">
                <div class="grow-1">
                    {{-- <label for="search" class="block mb-2.5 text-sm font-medium text-heading">Search</label>
                <input type="text" id="search" name="search" value="{{ request('search') }}" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-2.5 py-2 shadow-xs placeholder:text-body" placeholder="Search e.g. Manager" />
                    --}}
                    <label for="search" class="block mb-2 text-sm font-medium text-gray-900">
                        Search
                    </label>
                    <input type="text" id="search" name="search" value="{{ request('search') }}" class="block w-full px-3 py-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 shadow-sm placeholder-gray-400" placeholder="Search e.g. Manager" />
                </div>

                <div class="grow-1">
                    <label for="category" class="block mb-2 text-sm font-medium text-gray-900">
                        Category
                    </label>

                    <select id="category" name="category" class="block w-full mt-2 px-3 py-2 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                        <option value="">All Categories</option>

                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(request('category')==$category->id)
                            >
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="grow-1">
                    <button type="submit" class="mt-6 | text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5">
                        Search
                    </button>
                </div>
                <div class="grow-1 mt-6">
                    <a class="mt-6 |text-white bg-orange-500 hover:bg-orange-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5" type="button" href="/">Reset</a>
                </div>
            </div>
        </form>
        {{--<form method="GET" action="/">
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


        <button type="submit" class="text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5">
            Search
        </button>
        <a class="text-white bg-orange-500 hover:bg-orange-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5" type="button" href="/">Reset</a>



    </div>

    </form>--}}
    {{-- </div> --}}
    </div>
    <!-- MOBILE-->
    <div class="my-12 pt-16 pb-0 sm:mx-0 sm:my-0  md:hidden">
        <div class="columns-1 ">
            <form method="GET" action="/">
                <div class="columns-1">

                    <label for="search" class="block mb-2 text-sm font-medium text-gray-900">
                        Search
                    </label>
                    <input type="text" id="search" name="search" value="{{ request('search') }}" class="block w-full px-3 py-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 shadow-sm placeholder-gray-400" placeholder="Search e.g. Manager" />

                    <label for="category" class="block mt-4 mb-2 text-sm font-medium text-gray-900">
                        Category
                    </label>

                    <select id="category" name="category" class="block w-full mt-2 px-3 py-2 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                        <option value="">All Categories</option>

                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(request('category')==$category->id)
                            >
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>


                    <button type="submit" class="mt-6 | text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5">
                        Search
                    </button>
                    <a class="mt-6 |text-white bg-orange-500 hover:bg-orange-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5" type="button" href="/">Reset</a>



                </div>

            </form>

        </div>
    </div>

    {{--<div class="my-12 sm:mx-0 sm:my-0 md:my-0  xs:visible md:invisible ...">
        <!-- ... -->
        mobile
        <div class="columns-1 ">
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


    <button type="submit" class="text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5">
        Search
    </button>
    <a class="text-white bg-orange-500 hover:bg-orange-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5" type="button" href="/">Reset</a>



    </div>

    </form>

    </div>
    </div>--}}


    <div aria-hidden="true" class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]">
        <div style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)" class="relative left-[calc(50%+3rem)] aspect-1155/678 w-144.5 -translate-x-1/2 bg-linear-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-288.75"></div>
    </div>
    </div>
    </div>

    <div class="relative isolate px-6 lg:px-24 | xs:mx-24 md:mx-64 md:px-128">
        @foreach ($jobListings as $jobListing)
        <div class="columns-1 py-12">
            <a href="/job/{{ $jobListing->id }}/{{ $jobListing->slug }}" class="bg-neutral-primary-soft block  p-6 border rounded-xl border-default rounded-base shadow-xs hover:bg-neutral-secondary-medium">
                {{-- <span class="bg-brand-softer border border-brand-subtle text-fg-brand-strong text-xs font-medium px-1.5 py-0.5 rounded-sm">4.8 out of 5</span> --}}
                <h3 class="mb-3 text-2xl font-semibold tracking-tight text-heading leading-8">{{ $jobListing->title }}</h3>
                <h6>{{ $jobListing->category->name }}</h6>
                <ul class="flex flex-col gap-x-2 mt-2">
                    <li class="flex flex-row | items-center | gap-x-1"><i class="fa-regular fa-clock"></i>
                        <p class="text-body">{{ $jobListing->job_type }}</p>
                    </li>
                    <li class="flex flex-row | mt-1 | items-center | gap-x-1"> <i class="fa-solid fa-money-bill"></i><span class="bg-success-soft text-fg-success-strong text-xs font-medium px-1.5 py-0.5 rounded bg-green-300">£{{ $jobListing->salary_min }} - £{{ $jobListing->salary_max }}</span></li>
                    <li class="flex flex-row | mt-1 | items-center | gap-x-1"> <i class="fa-solid fa-location-arrow"></i>
                        <p class="text-body">{{ $jobListing->location }}</p>
                    </li>
                </ul>
            </a>
        </div>

        @endforeach
    </div>

    <div class="relative isolate px-6 lg:px-8 mx-64">
        {{ $jobListings->links() }}
    </div>
    @endsection
</x-layout>
