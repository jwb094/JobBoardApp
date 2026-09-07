@extends('layouts.layout')
@section('title',$job->title ." Job Application Page")
@section('content')
       @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
<section class="bg-white dark:bg-gray-300 text-black">
    <div class="pt-24 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-12">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">{{ $job->title }}</h1>

        <ul class="flex flex-col | gap-y-4 | mx-20">
            <x-jobpage.list-item class="flex flex-row | mt-1 | justify-start md:items-center | gap-x-1 | ">
                <i class="fa-solid fa-star"></i>
                <p class="text-2xl  text-body">{{ $job->category->name }}</p>
            </x-jobpage.list-item>

            <x-jobpage.list-item class="flex flex-row | mt-1 | justify-start md:items-center | gap-x-1 | ">
                <p class="text-2xl  text-body">{{ ucfirst($job->job_type) }}</p>
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

            <x-jobpage.list-item class="flex flex-row | mt-1 | justify-start md:items-center | gap-x-1 | ">
                <i class="fa-solid fa-money-bill"></i>
                <span class="text-2xl | bg-success-soft text-fg-success-strong font-medium px-1.5 py-0.5 rounded bg-green-300">
                    Up To £{{ $job->salary_min }}</span>
            </x-jobpage.list-item>
            @endif
            @if (!empty($job->location))
            <x-jobpage.list-item class="flex flex-row | mt-1 | justify-start md:items-center | gap-x-1 | ">
                <i class="fa-solid fa-location-arrow"></i>
                <p class="text-2xl  text-body">Location : {{ $job->location}}</p>
            </x-jobpage.list-item>
            @endif
            <x-jobpage.list-item class="flex flex-row | mt-1 | justify-start md:items-center | gap-x-1 | ">
                <i class="fa-solid fa-calendar"></i>
                <p class="text-2xl  text-body">Job Posted :{{ $job->created_at->format('d.m.Y')}}</p>
            </x-jobpage.list-item>
        </ul>
    </div>
</section>
<section class="bg-white py-8 antialiased dark:bg-gray-300 md:py-8 text-black">

    <div class="mx-auto max-w-screen-xl px-4 lg:px-24 2xl:px-0">

        <div class="mx-auto max-w-5xl">
            <h2 class="md:mx-16">Personal Details</h2>
            <ul class="flex flex-col | gap-y-4 | mx-20">
                <li class="flex flex-row | items-center | gap-x-1 mt-4">
                    <i class="fa-solid fa-star"></i>
                    <p class="text-body"> {{ $user->first_name }}</p>
                </li>
                <li class="flex flex-row | items-center | gap-x-1"><i class="fa-regular fa-clock"></i>
                    <p class="text-body">{{ $user->last_name }}</p>
                </li>
                <li class="flex flex-row | mt-1 | items-center | gap-x-1"> <i class="fa-solid fa-location-arrow"></i>
                    <p class="text-body">{{ $user->email }}</p>
                </li>
            </ul>
        </div>
    </div>
</section>

<section class=" bg-white py-8 antialiased dark:bg-gray-300 md:py-8 text-black">
    <form action={{ route('job.apply',['job_id' => $job->id, 'user_id' => $user->id]) }} method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <input type="hidden" name="job_id" value="{{ $job->id }}">

            <div class="mx-auto max-w-5xl">
                <h2 class="md:mx-16 md:my-6">Documents</h2>
                <ul class="flex flex-col | gap-y-4 | mx-20">
                    <li class="flex flex-row | items-center | gap-x-1"><i class="fa-regular fa-clock"></i>
                        <p class="text-body w-36">Cover Letter :</p>
                        @if (empty($user->cover_letter))
                        <input type="file" name="cover_letter" id="">
                        @endif
                        @if (isset($user->cover_letter))
                        <input class="w-full" type="text" name="cover_letter" value="{{ $user->cover_letter  }}"></input>
                        @endif
                    </li>
                    <li class="flex flex-row | items-center | gap-x-1">
                        <i class="fa-solid fa-star"></i>
                        <p class="text-body"> CV :</p>
                        @if (empty($user->cv))
                        <input type="file" name="resume_path" id="">
                        @endif
                        @if (isset($user->cv))
                        <input type="text" name="resume_path" value="{{ $user->cv  }}"></input>
                        @endif
                    </li>
                </ul>
                <button type="submit" class="w-56 | mt-6 mx-20 | text-white bg-green-500 hover:bg-green-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5" href="/job/{{ $user->id}}/{{  $job->slug}}/apply">Apply</a>
            </div>
        </div>
    </form>
</section>
@endsection
