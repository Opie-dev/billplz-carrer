@php
    $job_class = $job['featured'] ? 'job-card featured' : 'job-card';
    $job_type_class = in_array($job['type'], ['Full-time', 'Part-time', 'Contract', 'Internship'])
        ? ('job-type-' . strtolower(str_replace(['-', ' '], ['', ''], $job['type'])))
        : 'job-type-default';
@endphp

<div class="{{ $job_class }}" data-job-id="{{ $job['id'] }}">
    <div class="job-disabled-overlay" aria-label="Applications closed"
         style="position:absolute; inset:0; background:rgba(15,23,42,0.55); backdrop-filter:blur(2px); border-radius:12px; display:flex; align-items:center; justify-content:center; z-index:5; text-align:center;">
        <div style="padding:1rem 1.25rem; background:rgba(255,255,255,0.9); border:1px solid #e2e8f0; border-radius:10px; max-width: 90%;">
            <div style="font-weight:800; color:#0f172a; font-size:1rem; margin-bottom:.25rem;">Applications Closed</div>
            <div style="color:#334155; font-size:.9rem;">This position is currently not accepting applications.<br/>Subscribe for updates in the Notifications section.</div>
        </div>
    </div>
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
            <button type="button" class="btn btn-primary" disabled aria-disabled="true" title="Applications are closed">
                <i class="fas fa-ban"></i>
                Applications Closed
            </button>
            <button type="button" class="btn btn-secondary" disabled aria-disabled="true" title="Details are unavailable at this time">
                <i class="fas fa-info-circle"></i>
                Details Unavailable
            </button>
        </div>
    </div>
</div>
