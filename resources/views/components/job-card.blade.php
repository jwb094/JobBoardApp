<article class="job-card group">
    <a href="/job/{{ $jobId }}/{{ $jobSlug }}" class="job-card__link flex h-full flex-col">
        <div class="job-card__top">
            <span class="job-card__category">{{ $jobCategory }}</span>
            <span class="job-card__type">{{ $jobType }}</span>
        </div>

        <h3 class="job-card__title">{{ $jobTitle }}</h3>

        <div class="job-card__details">
            <div class="job-card__detail">
                <i class="fa-solid fa-money-bill-wave" aria-hidden="true"></i>
                @if (!empty($jobSalaryMin) && !empty($jobSalaryMax))
                    <span class="job-card__salary">£{{ $jobSalaryMin }} - £{{ $jobSalaryMax }}</span>
                @elseif (!empty($jobSalaryMin))
                    <span class="job-card__salary">From £{{ $jobSalaryMin }}</span>
                @elseif (!empty($jobSalaryMax))
                    <span class="job-card__salary">Up to £{{ $jobSalaryMax }}</span>
                @else
                    <span class="job-card__salary">Salary not listed</span>
                @endif
            </div>

            @if ($jobLocation)
                <div class="job-card__detail">
                    <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
                    <span>{{ $jobLocation }}</span>
                </div>
            @endif
        </div>

        <span class="job-card__cta">
            View role
            <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
        </span>
    </a>
</article>
