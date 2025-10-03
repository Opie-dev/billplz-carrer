@php
    $job_class = $job['featured'] ? 'job-card featured' : 'job-card';
    $job_type_class = in_array($job['type'], ['Full-time', 'Part-time', 'Contract', 'Internship'])
        ? ('job-type-' . strtolower(str_replace(['-', ' '], ['', ''], $job['type'])))
        : 'job-type-default';
@endphp

<div class="{{ $job_class }}" data-job-id="{{ $job['id'] }}">
    @if($job['featured'])
        <div class="job-header">
            <div class="job-badge">Featured</div>
            <div class="job-type <?php echo $job_type_class; ?>">{{ $job['type'] }}</div>
        </div>
    @else
        <div class="job-header">
            <div class="job-type <?php echo $job_type_class; ?>">{{ $job['type'] }}</div>
        </div>
    @endif
    
    <div class="job-content">
        <h3 class="job-title">{{ $job['title'] }}</h3>
        <div class="job-meta">
            <div class="job-meta-line">
                <span class="job-location">
                    <i class="fas fa-map-marker-alt"></i>
                    {{ $job['location'] }}
                </span>
                <span class="job-department">
                    <i class="fas fa-code"></i>
                    {{ $job['department'] }}
                </span>
            </div>
            <div class="job-meta-line">
                @if(isset($job['salary']) && !empty($job['salary']))
                <span class="job-salary">
                    <i class="fas fa-money-bill-wave"></i>
                    {{ $job['salary'] }}
                </span>
                @endif
                <span class="job-date">
                    <i class="fas fa-calendar"></i>
                    Posted {{ \Carbon\Carbon::parse($job['posted_date'])->format('M j, Y') }}
                </span>
            </div>
        </div>
        <p class="job-description">
            {{ $job['description'] }}
        </p>
        
        <div class="job-details" style="display: none;">
            <div class="detail-section">
                <h4 class="detail-title">Key Responsibilities</h4>
                <ul class="detail-list">
                    @foreach ($job['responsibilities'] as $responsibility)
                        <li>{{ $responsibility }}</li>
                    @endforeach
                </ul>
            </div>

            <div class="detail-section">
                <h4 class="detail-title">Required Skills</h4>
                <ul class="detail-list">
                    @foreach ($job['skills'] as $skill)
                        <li>{{ $skill }}</li>
                    @endforeach
                </ul>
            </div>

            @if(isset($job['referral_note']) && !empty($job['referral_note']))
            <div class="detail-section referral-section">
                <h4 class="detail-title">Referral Information</h4>
                <div class="referral-note">
                    <i class="fas fa-handshake"></i>
                    <p>{{ $job['referral_note'] }}</p>
                </div>
            </div>
            @endif
        </div>

        <div class="job-actions">
            <a href="mailto:love@billplz.com?subject={{ urlencode($job['title'].' Application -  Billplz Careers') }}&body={{ urlencode("Hello Billplz Team,\n\nI would like to apply for the {$job['title']} position.\n\nName: \nPhone: \nPortfolio/LinkedIn: \nCover letter: \nReferral: Ahmad Syaafi\n\nThank you.") }}" class="btn btn-primary">
                <i class="fas fa-paper-plane"></i>
                Apply Now
            </a>
            <button class="btn btn-secondary" onclick="toggleJobDetails(this)">
                <i class="fas fa-chevron-down"></i>
                View Details
            </button>
        </div>
    </div>
</div>
