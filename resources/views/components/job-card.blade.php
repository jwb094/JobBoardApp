<div class="job-card">
    <a href="/job/{{ $jobId }}/{{ $jobSlug }}" class="job-card-link">
        <div class="job-card-top">
            <span class="job-tag">{{ $jobCategory }}</span>
            <span class="job-type">{{ $jobType }}</span>
        </div>

        <h3>{{ $jobTitle }}</h3>

        <div class="job-card-meta">
            <div class="meta-item">
                <i class="fa-solid fa-money-bill-wave"></i>
                @if (!empty($jobSalaryMin) && !empty($jobSalaryMax))
                    <span class="salary-pill">£{{ $jobSalaryMin }} - £{{ $jobSalaryMax }}</span>
                @elseif (!empty($jobSalaryMin) && empty($jobSalaryMax))
                    <span class="salary-pill">£{{ $jobSalaryMin }}</span>
                @elseif (empty($jobSalaryMin) && !empty($jobSalaryMax))
                    <span class="salary-pill">£{{ $jobSalaryMax }}</span>
                @else
                    <span class="salary-pill">N/A</span>
                @endif
            </div>

            <div class="meta-item">
                <i class="fa-solid fa-location-dot"></i>
                <span>{{ $jobLocation }}</span>
            </div>
        </div>
    </a>
</div>
