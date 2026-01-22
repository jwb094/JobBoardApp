<x-layout>
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
    <section class="bg-white py-8 antialiased dark:bg-gray-300 md:py-16 text-black">

        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">

            <div class="mx-auto max-w-5xl">
                <h2>Personal Details</h2>
                <ul class="flex flex-col | gap-y-4 | mx-20">
                    <li class="flex flex-row | items-center | gap-x-1">
                        <i class="fa-solid fa-star"></i>
                        <p class="text-body"> FName</p>
                    </li>
                    <li class="flex flex-row | items-center | gap-x-1"><i class="fa-regular fa-clock"></i>
                        <p class="text-body">Name</p>
                    </li>
                    <li class="flex flex-row | mt-1 | items-center | gap-x-1"> <i class="fa-solid fa-location-arrow"></i>
                        <p class="text-body">Email</p>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <section class="bg-white py-8 antialiased dark:bg-gray-300 md:py-16 text-black">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <h2>Documents</h2>
            <div class="mx-auto max-w-5xl">
                <ul class="flex flex-col | gap-y-4 | mx-20">
                    <li class="flex flex-row | items-center | gap-x-1">
                        <i class="fa-solid fa-star"></i>
                        <p class="text-body"> CV</p>
                    </li>
                    <li class="flex flex-row | items-center | gap-x-1"><i class="fa-regular fa-clock"></i>
                        <p class="text-body">Cover Letter</p>
                    </li>
                    <li class="flex flex-row | mt-1 | items-center | gap-x-1"> <i class="fa-solid fa-money-bill"></i><span class="bg-success-soft text-fg-success-strong text-xs font-medium px-1.5 py-0.5 rounded bg-green-300">£{{ $job->salary_min }} - £{{ $job->salary_max }}</span></li>

                </ul>
            </div>
        </div>
    </section>
    @endsection
</x-layout>
