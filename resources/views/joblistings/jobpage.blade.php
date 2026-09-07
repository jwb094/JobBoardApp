@extends('layouts.layout')
@section('title',$job->title ." Job Page")
@section('content')
<section class="bg-white dark:bg-gray-300 text-black">
    <div class="pt-24 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-12">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">{{ $job->title }}</h1>

        <ul class="flex flex-col mt-24 | gap-y-4 | mx-4 md:mx-52">

            <x-jobpage.list-item class="flex flex-row | mt-1 | justify-start md:items-center | gap-x-1 | ">
                <i class="fa-regular fa-building"></i>
                <p class="text-2xl  text-body"> {{ $job->company?->company_name ?? 'Company not available' }}</p>
            </x-jobpage.list-item>

            <x-jobpage.list-item class="flex flex-row | mt-1 | justify-start md:items-center | gap-x-1 | ">
                <i class="fa-solid fa-star"></i>
                <p class="text-2xl  text-body">{{ $job->category->name }}</p>
            </x-jobpage.list-item>
            <x-jobpage.list-item class="flex flex-row | mt-1 | justify-start md:items-center | gap-x-1 | ">
                <p class="text-2xl  text-body">{{ $job->job_type }}</p>
            </x-jobpage.list-item>
            @if (!empty($job->salary_min) && !empty($job->salary_max)){{-- if salary_min && salary_max are not empty --}}
            <x-jobpage.list-item class="flex flex-row | mt-1 | justify-start md:items-center | gap-x-1 | ">
                <i class="fa-solid fa-money-bill"></i>
                <span class="text-2xl | bg-success-soft text-fg-success-strong font-medium px-1.5 py-0.5 rounded bg-green-300">
                    £{{ $job->salary_min }} - £{{ $job->salary_max }}</span>
            </x-jobpage.list-item>
            @endif
            @if (empty($job->salary_min) && empty($job->salary_max)){{-- if salary_min  && salary_max are not empty --}}
            <x-jobpage.list-item class="flex flex-row | mt-1 | justify-start md:items-center | gap-x-1 | ">
                <i class="fa-solid fa-money-bill"></i>
                <span class="text-2xl | bg-success-soft text-fg-success-strong font-medium px-1.5 py-0.5 rounded bg-green-300">
                    No information recieved</span>
            </x-jobpage.list-item>
            @endif
            @if (empty($ $job->salary_min) && !empty($ $job->salary_max)){{-- if salary_min is empty && salary_max are not empty --}}
            <x-jobpage.list-item class="flex flex-row | mt-1 | justify-start md:items-center | gap-x-1 | ">
                <i class="fa-solid fa-money-bill"></i>
                <span class="text-2xl | bg-success-soft text-fg-success-strong font-medium px-1.5 py-0.5 rounded bg-green-300">
                    Starting from £{{ $job->salary_min }}</span>
            </x-jobpage.list-item>
            @endif
            @if (!empty($job->salary_min) && empty($job->salary_max)){{-- if salary_min is not empty && salary_max are is empty --}}
            {{-- <li class="flex flex-row | mt-1 | justify-start md:items-center | gap-x-1 | "> <i class="fa-solid fa-money-bill"></i><span class="text-2xl | bg-success-soft text-fg-success-strong font-medium px-1.5 py-0.5 rounded bg-green-300">sUp To £{{ $job->salary_min }}</span></li> --}}

            <x-jobpage.list-item class="flex flex-row | mt-1 | justify-start md:items-center | gap-x-1 | ">
                <i class="fa-solid fa-money-bill"></i>
                <span class="text-2xl | bg-success-soft text-fg-success-strong font-medium px-1.5 py-0.5 rounded bg-green-300">
                    Up To £{{ $job->salary_min }}</span>
            </x-jobpage.list-item>
            @endif
            <x-jobpage.list-item class="flex flex-row | mt-1 | justify-start md:items-center | gap-x-1 | ">
                <i class="fa-solid fa-calendar"></i>
                <p class="text-2xl  text-body">Job Posted :{{ $job->created_at->format('d.m.Y')}}</p>
            </x-jobpage.list-item>
            @if (!empty($job->location))
            <x-jobpage.list-item class="flex flex-row | mt-1 | justify-start md:items-center | gap-x-1 | ">
                <i class="fa-solid fa-location-arrow"></i>
                <p class="text-2xl  text-body">Location : {{ $job->location}}</p>
            </x-jobpage.list-item>
            @endif
            @if (!empty($job->city))
            <x-jobpage.list-item class="flex flex-row | mt-1 | justify-start md:items-center | gap-x-1 | ">
                <i class="fa-solid fa-city"></i>
                <p class="text-2xl  text-body">City : {{ $job->city}}</p>
            </x-jobpage.list-item>
            @endif
            @if (!empty($job->address))
            <x-jobpage.list-item class="flex flex-row | mt-1 | justify-start md:items-center | gap-x-1 | ">
                <i class="fa-solid fa-city"></i>
                <p class="text-2xl  text-body">Address : {{ $job->address}}</p>
            </x-jobpage.list-item>
            @endif
            @if (!empty($job->post_code))
            <x-jobpage.list-item class="flex flex-row | mt-1 | justify-start md:items-center | gap-x-1 | ">
                <i class="fa-solid fa-map"></i>
                <p class="text-2xl  text-body">Post code : {{ $job->post_code}}</p>
            </x-jobpage.list-item>
            @endif


            <li class="flex flex-row | mt-1 | justify-end | gap-x-1">
                <button class="bookmark-job-button" @if (empty(auth()->id())) disabled @endif @if (!empty(auth()->id())) data-user="{{ auth()->id()  }}" @endif data-job-id=" {{ $job->id }} " data-token="{{ csrf_token() }}">
                    <i class="bookmark | text-3xl |  @if (!empty($savedJobExists)) fa-solid @else fa-regular @endif fa-bookmark    |"></i>
                </button>
                <p class="bookmark-message"></p>
            </li>
        </ul>
    </div>
</section>
<section class="bg-white py-8 antialiased dark:bg-gray-300 md:py-16 text-black">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <div class="mx-auto max-w-5xl">


            <div class="mx-auto mb-6 max-w-3xl space-y-6 md:mb-12">
                <h3 class="text-2xl font-semibold text-black">Job Description</h3>
                <p class="text-2xl font-normal text-black">
                    {!! $job->description !!}
                </p>


                <h3 class="text-2xl font-semibold text-black  "> Skillset </h3>
                <p class="text-2xl font-normal text-black">
                    {!! $job->skillset_About !!}
                </p>

                <h3 class="text-2xl font-semibold text-black  "> Key Features and Benefits:</h3>

                <p class="text-2xl font-normal text-black ">

                    {!! $job->benefits !!}
                </p>
            </div>
            <div class="mx-auto mb-6 max-w-3xl space-y-6 md:mb-12">
                @if (!empty($user) && !empty($hasApplied))
                <p>You have already applied for this job</p>
                @endif
                @if (!empty($user) && empty($hasApplied))
                <a class="mt-6 | text-white bg-green-800 hover:bg-green-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5" href="/job/{{ $job->id}}/{{  $job->slug}}/apply">Apply</a>
                @endif

                @if (empty($user))
                <p>Please <a class="text-blue-500" href="{{  route('user.login')}}">login</a> Or <a class="text-blue-500" href=" {{  route('user.register')}}">Sign up</a> to apply</p>
                @endif

            </div>
        </div>
    </div>
</section>
@endsection
@push('other-scripts')
<script>
    console.log('do something in js')

</script>
<script src="https://code.jquery.com/jquery-4.0.0.min.js" integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao=" crossorigin="anonymous"></script>
<script src="{{ URL::asset('js/bookmark-job.js') }}"></script>
@endpush

{{-- @section('footer-scripts')
@include('scripts.bookmark-job')
@endsection --}}
