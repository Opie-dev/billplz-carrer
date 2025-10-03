<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## JkOpie Careers - Laravel App

This repository hosts the JkOpie Careers site built on Laravel. It lists open positions, lets visitors subscribe to job notifications, and provides an admin dashboard with basic analytics.

### Features

- Careers landing page with open positions rendered from `JobController::getJobs()`
- Subscription form (AJAX) that stores emails in `subscriptions` table
- Frontend tracking of:
  - page views (`metrics.event = page_view`)
  - view details clicks (`metrics.event = view_details`, `job_id` attached)
- Admin login (session-based) using the `users` table with roles
- Admin dashboard showing:
  - Total website views
  - Total “view details” clicks
  - Per-job click counts (mapped to titles via `getJobs()`)
  - Subscription list (paginated)

### Tech

- Laravel 11 (routing, middleware aliasing in `bootstrap/app.php`)
- Blade views (`resources/views`)
- Public assets: `public/css/careers.css`, `public/js/careers.js`, `public/css/admin-login.css`

### Setup

1) Install dependencies and set environment

```bash
composer install
cp .env.example .env
php artisan key:generate
```

2) Serve

```bash
php artisan serve
# http://localhost:8000
```

### Admin

- Login page: `/admin/login`
- Users must have `role = admin` in `users` table

### Tracking API

- POST `/track` JSON body:

```json
{ "event": "page_view" | "view_details", "job_id": 1, "path": "/" }
```

### Subscriptions API

- POST `/subscribe` form-data: `email`

### Code Locations

- Jobs data: `app/Http/Controllers/JobController::getJobs()`
- Middleware alias: `bootstrap/app.php` (`admin` → `AdminAuth`)
- DB models: `app/Models/Subscription.php`, `app/Models/Metric.php`
- Migrations: subscriptions, metrics, add_role_to_users