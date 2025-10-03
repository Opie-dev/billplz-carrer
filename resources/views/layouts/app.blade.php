<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'JkOpie Careers') }} @yield('title')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">

    @stack('styles')
</head>
<body>
    <header class="header">
        <nav class="nav">
            <div class="nav-container">
                <div class="nav-logo">
                    <h2>{{ config('app.name', 'Billplz') }}</h2>
                </div>
                <div class="nav-links">
                    <a href="#home" class="nav-link">Home</a>
                    <a href="#jobs" class="nav-link">Jobs</a>
                    <a href="#notifications" class="nav-link">Notifications</a>
                    <a href="#about" class="nav-link">About</a>
                    <a href="#contact" class="nav-link">Contact</a>
                </div>
                <div class="nav-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </nav>
    </header>

    @yield('content')

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <h3>{{ config('app.name', 'JkOpie') }}</h3>
                    <p>Building the future of payments in Malaysia</p>
                </div>
                <div class="footer-links">
                    <div class="footer-column">
                        <h4>Company</h4>
                        <a href="#about">About Us</a>
                        <a href="#jobs">Careers</a>
                        <a href="https://www.billplz.com" target="_blank">Our Services</a>
                    </div>
                    <div class="footer-column">
                        <h4>Contact</h4>
                        <a href="mailto:love@billplz.com">love@billplz.com</a>
                        <a href="https://www.billplz.com" target="_blank">www.billplz.com</a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} {{ config('app.name', 'Billplz') }}. All rights reserved.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
