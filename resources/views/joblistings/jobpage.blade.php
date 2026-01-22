<x-layout>
    @section('title',$job->title ." Job Page")
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

                <li class="flex flex-row | mt-1 | justify-end | gap-x-1">
                    bookmark
                </li>
            </ul>
        </div>
    </section>
    <section class="bg-white py-8 antialiased dark:bg-gray-300 md:py-16 text-black">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <div class="mx-auto max-w-5xl">


                <div class="mx-auto mb-6 max-w-3xl space-y-6 md:mb-12">
                    <h3>Job Description</h3>
                    <p class="text-base font-normal text-gray-500 dark:text-gray-400">
                        {{ $job->description }}
                    </p>


                    <h3>Job Description</h3>
                    <p class="text-base font-normal text-gray-500 dark:text-gray-400">
                        {{ $job->skillset_About }}
                    </p>

                    <p class="text-base font-semibold text-gray-900 dark:text-white">Key Features and Benefits:</p>
                    {{-- <ul class="list-outside list-disc space-y-4 pl-4 text-base font-normal text-gray-500 dark:text-gray-400">
                        <li>
                            <span class="font-semibold text-gray-900 dark:text-white"> Brilliant 4.5K Retina display: </span>
                            see the big picture and all the detailsSee it all in sharp, glorious detail on the immersive 24-inch 4.5K Retina display. The P3 wide color gamut brings what you're watching to life in over a billion colors. Images shine with a brilliant 500 nits of brightness. Industry-leading anti-reflective coating delivers greater comfort and readability. And True Tone technology automatically adjusts the color temperature of your display to the ambient light of your
                            environment, for a more natural viewing experience. So whether you're editing photos, working on presentations, or watching your favorite shows and movies, everything looks incredible on iMac.
                        </li>
                        <li>
                            <span class="font-semibold text-gray-900 dark:text-white"> 1080p FaceTime HD camera: </span>
                            ready for your close-upIt's the best camera system ever in a Mac. Double the resolution for higher-quality video calls. A larger sensor that captures more light. And the advanced image signal processor (ISP) of M1 greatly improves image quality. So from collaborating with coworkers to catching up with friends and family, you'll always look your best.
                        </li>

                        <li>
                            <span class="font-semibold text-gray-900 dark:text-white"> Studio-quality mics for high-quality conversations: </span>
                            whether you're on a video call with a friend, cutting a track, or recording a podcast, the microphones on iMac make sure you come through loud, crisp, and clear. The studio-quality three-mic array is designed to reduce feedback, so conversations flow more naturally and you interrupt each other less. And beamforming technology helps the mics ignore background noise. Which means everyone hears you - not what's going on around you.
                        </li>

                        <li>
                            <span class="font-semibold text-gray-900 dark:text-white"> Six-speaker sound system: audio that really fills a room: </span>
                            the sound system on iMac brings incredible, room-filling audio to any space. Two pairs of force-canceling woofers create rich, deep bass without unwanted vibrations. And each pair is balanced with a high-performance tweeter. The result is a massive, detailed soundstage that takes your movies, music, and more to the next level.
                        </li>

                        <li>
                            <span class="font-semibold text-gray-900 dark:text-white"> M1 chip: with great power comes great capability: </span>
                            M1 is the most powerful chip Apple has ever made. macOS Big Sur is an advanced desktop operating system. Combined, they take iMac to entirely new levels of performance, efficiency, and security. iMac wakes from sleep almost instantly, apps launch in a flash, and the whole system feels fluid, smooth, and snappy. With up to 85 percent faster CPU performance and up to two times faster graphics performance than standard 21.5-inch iMac models, you can use apps like
                            Xcode and Affinity Photo to compile code in a fraction of the time or edit photos in real time. And it runs cool and quiet even while tackling these intense workloads. That's the power of hardware, software, and silicon - all designed together.
                        </li>
                    </ul> --}}
                    {{ $job->benefits }}
                </div>
                <div class="mx-auto mb-6 max-w-3xl space-y-6 md:mb-12">
                    @if (!empty($user))
                    <a href="/job/{{ $user->id}}/{{  $job->slug}}/apply">Apply</a>
                    @endif
                    @if (empty($user))
                    <p>Please <a class="text-blue-500" href="{{  route('user-login-page')}}">login</a> Or <a class="text-blue-500" href=" {{  route('user-register-page')}}">Sign up</a> to apply</p>
                    @endif

                </div>
            </div>
        </div>
    </section>
    @endsection
</x-layout>
