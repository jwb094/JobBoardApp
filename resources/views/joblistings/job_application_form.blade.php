@extends('layouts.layout')
    @section('title',$job->title ." Job Application Page")
    @section('content')
    <section class="bg-white dark:bg-gray-300 text-black">
        <div class="pt-24 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-12">
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">{{ $job->title }}</h1>

            <ul class="flex flex-col | gap-y-4 | mx-20">
                <li class="flex flex-row | items-center | gap-x-1">
                    <i class="fa-solid fa-star"></i>
                    <p class="text-body">{{ $job->category->name }}</p>
                </li>
                <li class="flex flex-row | items-center | gap-x-1"><i class="fa-regular fa-clock"></i>
                    <p class="text-body">{{ $job->job_type }}</p>
                </li>
                <li class="flex flex-row | mt-1 | items-center | gap-x-1"> <i class="fa-solid fa-money-bill"></i><span class="bg-success-soft text-fg-success-strong text-xs font-medium px-1.5 py-0.5 rounded bg-green-300">£{{ $job->salary_min }} - £{{ $job->salary_max }}</span></li>
                <li class="flex flex-row | mt-1 | items-center | gap-x-1"> <i class="fa-solid fa-location-arrow"></i>
                    <p class="text-body">{{ $job->location }}</p>
                </li>
                <li class="flex flex-row | mt-1 | items-center | gap-x-1">
                    <i class="fa-solid fa-calendar"></i>
                    <p class="text-body">Job Posted :{{ $job->created_at->format('d.m.Y')}}</p>
                </li>
            </ul>
        </div>
    </section>
    <section class="bg-white py-8 antialiased dark:bg-gray-300 md:py-8 text-black">

        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">

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
    <section class="bg-white py-8 antialiased dark:bg-gray-300 md:py-8 text-black">
        <form action="/job/sumbit_application/{{ $job->id }}/{{ $user->id }}" method="POST">
            @csrf
            <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
                <input type="hidden" name="job_id" value="{{ $job->id }}">

                <div class="mx-auto max-w-5xl">
                    <h2 class="md:mx-16 md:my-6">Documents</h2>
                    <ul class="flex flex-col | gap-y-4 | mx-20">
                        <li class="flex flex-row | items-center | gap-x-1"><i class="fa-regular fa-clock"></i>
                            <p class="text-body">Cover Letter :</p>

                            <input type="file" name="cover_letter" id="" value="{{ $user->cover_letter  }}">
                            {{-- <span>{{ $user->cover_letter  }}</span> --}}
                            {{-- @if (!empty($user)) --}}
                            {{-- <input type="file" name="CV" id="" @if (!empty($user->cv)) value="{{ $user->cv }}" @endif> --}}
                            {{-- @endif --}}
                        </li>
                        <li class="flex flex-row | items-center | gap-x-1">
                            <i class="fa-solid fa-star"></i>
                            <p class="text-body"> CV :</p>
                            <input type="file" name="resume_path" id="" value="{{ $user->cv  }}">
                            {{-- <span>{{ $user->cv }} </span> --}}
                            {{-- <input type="file" name="CV" id="" @if (!empty($user->cv)) value="{{ $user->cv }}" @endif> --}}

                            {{-- @if (!empty($user)) --}}
                            {{-- <input type="file" name="CV" id="" @if (!empty($user->cv)) value="{{ $user->cv }}" @endif> --}}
                            {{-- @endif --}}

                        </li>


                    </ul>
                    <button type="submit" class="w-56 | mt-6 mx-20 | text-white bg-green-500 hover:bg-green-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5" href="/job/{{ $user->id}}/{{  $job->slug}}/apply">Apply</a>
                </div>


            </div>
            {{-- <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
                <div class="mx-auto max-w-5xl">

                    <button type="submit" class="w-56 | mt-6 | text-white bg-green-500 hover:bg-green-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5" href="/job/{{ $user->id}}/{{ $job->slug}}/apply">Apply</a>
            </div>
            </div> --}}
        </form>
    </section>
    @endsection
