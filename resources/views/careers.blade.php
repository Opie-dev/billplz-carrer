@extends('layouts.app')

@section('title', 'Careers at Billplz - Join Our Team')

@section('content')
<main>
    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-container">
            <div class="hero-content">
                <h1 class="hero-title">Join the Billplz Team</h1>
                <p class="hero-subtitle">Build the future of payments in Malaysia. We're looking for talented individuals to help us create innovative payment solutions.</p>
                <div class="hero-stats">
                    <div class="stat">
                        <span class="stat-number">50+</span>
                        <span class="stat-label">Team Members</span>
                    </div>
                    <div class="stat">
                        <span class="stat-number">10+</span>
                        <span class="stat-label">Years Experience</span>
                    </div>
                    <div class="stat">
                        <span class="stat-number">1000+</span>
                        <span class="stat-label">Merchants</span>
                    </div>
                </div>
            </div>
            <div class="hero-image">
                <div class="hero-graphic">
                    <i class="fas fa-credit-card"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Job Listings Section -->
    <section class="jobs-section" id="jobs">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Open Positions</h2>
                <p class="section-subtitle">Find your next career opportunity with us</p>
            </div>

            <div class="jobs-grid">
                @foreach ($jobs as $job)
                    @include('components.job-card', ['job' => $job])
                @endforeach
            </div>
        </div>
    </section>

    <!-- Job Notifications Section -->
    <section class="notifications-section" id="notifications">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Stay Updated with New Opportunities</h2>
                <p class="section-subtitle">Get notified immediately when we post new job openings</p>
            </div>

            <div class="notifications-content">
                <div class="notifications-card">
                    <div class="notifications-icon">
                        <i class="fas fa-bell"></i>
                    </div>
                    <div class="notifications-text">
                        <h3>Never Miss a Job Opportunity</h3>
                        <p>Subscribe to our job alerts and be the first to know about new positions at Billplz. We'll notify you immediately when we post new openings.</p>
                        
                        <form class="subscribe-form" id="subscribeForm" action="{{ route('careers.subscribe') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="email" name="email" id="subscribeEmail" placeholder="Enter your email address" required>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-bell"></i>
                                    Subscribe Me
                                </button>
                            </div>
                            <div class="form-message" id="subscribeMessage"></div>
                        </form>
                        
                        <div class="subscribe-benefits">
                            <h4>What you'll get:</h4>
                            <ul>
                                <li><i class="fas fa-check"></i> Instant notifications for new job postings</li>
                                <li><i class="fas fa-check"></i> Early access to exclusive opportunities</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section" id="about">
        <div class="container">
            <div class="about-content">
                <h2 class="section-title">Why Work at Billplz?</h2>
                <div class="benefits-grid">
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="fas fa-rocket"></i>
                        </div>
                        <h3>Innovation</h3>
                        <p>Work on cutting-edge payment technologies and shape the future of digital commerce in Malaysia.</p>
                    </div>
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3>Collaborative Culture</h3>
                        <p>Join a diverse team of talented individuals who value collaboration, creativity, and continuous learning.</p>
                    </div>
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3>Growth Opportunities</h3>
                        <p>Advance your career with opportunities for professional development, mentorship, and skill enhancement.</p>
                    </div>
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h3>Work-Life Balance</h3>
                        <p>Enjoy flexible working arrangements and a supportive environment that values your well-being.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section" id="contact">
        <div class="container">
            <div class="contact-content">
                <h2 class="section-title">Get in Touch</h2>
                <p class="section-subtitle">Ready to join our team? We'd love to hear from you!</p>
                
                <div class="contact-info">
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-details">
                            <h3>Email Us</h3>
                            <p>Send your resume and cover letter to:</p>
                            <a href="mailto:love@billplz.com" class="contact-link">love@billplz.com</a>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-globe"></i>
                        </div>
                        <div class="contact-details">
                            <h3>Visit Our Website</h3>
                            <p>Learn more about our services and company:</p>
                            <a href="https://www.billplz.com" target="_blank" class="contact-link">www.billplz.com</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/careers.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush

@push('scripts')
<script src="{{ asset('js/careers.js') }}"></script>
@endpush
