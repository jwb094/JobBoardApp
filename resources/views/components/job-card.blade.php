 <div class="columns-1 py-12">
     <a href="/job/{{ $jobId }}/{{ $jobSlug }}" class="bg-neutral-primary-soft block  p-6 border rounded-xl border-default rounded-base shadow-xs hover:bg-neutral-secondary-medium">
         <h3 class="mb-3 text-2xl font-semibold tracking-tight text-heading leading-8">{{ $jobTitle }}</h3>
         <h6>{{ $jobCategory }}</h6>
         <ul class="flex flex-col gap-x-2 mt-2">
             <li class="flex flex-row | items-center | gap-x-1"><i class="fa-regular fa-clock"></i>
                 <p class="text-body">{{ $jobType }}</p>
             </li>
             @if (@isset($jobSalaryMin) && @isset($jobSalaryMax)){{-- if salary_min && salary_max are not empty --}}
             <li class="flex flex-row | mt-1 | items-center | gap-x-1"> <i class="fa-solid fa-money-bill"></i><span class="bg-success-soft text-fg-success-strong text-xs font-medium px-1.5 py-0.5 rounded bg-green-300">£{{ $jobSalaryMin }} - £{{ $jobSalaryMax }}</span></li>
             @endif
             @if (empty($jobSalaryMin) && empty($jobSalaryMax)){{-- if salary_min  && salary_max are  empty --}}
             <li class="flex flex-row | mt-1 | items-center | gap-x-1"> <i class="fa-solid fa-money-bill"></i><span class="bg-success-soft text-fg-success-strong text-xs font-medium px-1.5 py-0.5 rounded bg-green-300">N/A</span></li>
             @endif
             @if (empty($jobSalaryMin) && !empty($jobSalaryMax)){{-- if salary_min is empty && salary_max are not empty --}}
             <li class="flex flex-row | mt-1 | items-center | gap-x-1"> <i class="fa-solid fa-money-bill"></i><span class="bg-success-soft text-fg-success-strong text-xs font-medium px-1.5 py-0.5 rounded bg-green-300">£{{ $jobSalaryMax }}</span></li>
             @endif
             @if (!empty($jobSalaryMin) && empty($jobSalaryMax)){{-- if salary_min is not empty && salary_max are is empty --}}
             <li class="flex flex-row | mt-1 | items-center | gap-x-1"> <i class="fa-solid fa-money-bill"></i><span class="bg-success-soft text-fg-success-strong text-xs font-medium px-1.5 py-0.5 rounded bg-green-300">£{{ $jobSalaryMin }}</span></li>
             @endif



             <li class="flex flex-row | mt-1 | items-center | gap-x-1"> <i class="fa-solid fa-location-arrow"></i>
                 <p class="text-body">{{ $jobLocation }}</p>
             </li>
         </ul>
     </a>
 </div>
