 <div class="columns-1 py-12">
            <a href="/job/{{ $jobId }}/{{ $jobSlug }}" class="bg-neutral-primary-soft block  p-6 border rounded-xl border-default rounded-base shadow-xs hover:bg-neutral-secondary-medium">
                {{-- <span class="bg-brand-softer border border-brand-subtle text-fg-brand-strong text-xs font-medium px-1.5 py-0.5 rounded-sm">4.8 out of 5</span> --}}
                <h3 class="mb-3 text-2xl font-semibold tracking-tight text-heading leading-8">{{ $jobTitle }}</h3>
                <h6>{{ $jobCategory }}</h6>
                <ul class="flex flex-col gap-x-2 mt-2">
                    <li class="flex flex-row | items-center | gap-x-1"><i class="fa-regular fa-clock"></i>
                        <p class="text-body">{{ $jobType }}</p>
                    </li>
                    <li class="flex flex-row | mt-1 | items-center | gap-x-1"> <i class="fa-solid fa-money-bill"></i><span class="bg-success-soft text-fg-success-strong text-xs font-medium px-1.5 py-0.5 rounded bg-green-300">£{{ $jobSalaryMin }} - £{{ $jobSalaryMax }}</span></li>
                    <li class="flex flex-row | mt-1 | items-center | gap-x-1"> <i class="fa-solid fa-location-arrow"></i>
                        <p class="text-body">{{ $jobLocation }}</p>
                    </li>
                </ul>
            </a>
        </div>