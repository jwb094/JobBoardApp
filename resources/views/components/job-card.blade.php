<article class="job-card">
    <a href="/job/{{ $jobId }}/{{ $jobSlug }}" class="job-card__link flex h-full flex-col gap-5 p-5 sm:p-6">
        <div class="job-card__top flex items-start justify-between gap-3">
            <span class="job-card__category">{{ $jobCategory }}</span>
            <span class="job-card__type">{{ $jobType }}</span>
        </div>

        <div class="job-card__content">
            <h3 class="job-card__title">{{ $jobTitle }}</h3>

            <dl class="job-card__details mt-5 flex flex-col gap-2">
                <div class="job-card__detail">
                    <dt class="job-card__detail-label">
                        <i class="fa-solid fa-money-bill-wave" aria-hidden="true"></i>
                        Salary
                    </dt>
                    <dd class="job-card__detail-value">
                    @if (!empty($jobSalaryMin) && !empty($jobSalaryMax))
                        <span class="job-card__salary">£{{ $jobSalaryMin }} - £{{ $jobSalaryMax }}</span>
                    @elseif (!empty($jobSalaryMin))
                        <span class="job-card__salary">From £{{ $jobSalaryMin }}</span>
                    @elseif (!empty($jobSalaryMax))
                        <span class="job-card__salary">Up to £{{ $jobSalaryMax }}</span>
                    @else
                        <span class="job-card__salary">Salary not listed</span>
                    @endif
                    </dd>
                </div>

                @if ($jobLocation)
                    <div class="job-card__detail">
                        <dt class="job-card__detail-label">
                            <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
                            Location
                        </dt>
                        <dd class="job-card__detail-value job-card__detail-value--location">{{ $jobLocation }}</dd>
                    </div>
                @endif
            </dl>
        </div>

        <span class="job-card__cta">
            View role
            <span class="job-card__cta-icon" aria-hidden="true">
                <i class="fa-solid fa-arrow-right"></i>
            </span>
        </span>
    </a>
</article>
