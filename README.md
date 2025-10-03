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

2) Configure database in `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=jkopie_careers
DB_USERNAME=root
DB_PASSWORD=secret

# Optional admin credentials (used by seeder)
ADMIN_EMAIL=admin@example.com
ADMIN_PASSWORD=password123
```

3) Migrate and seed

```bash
php artisan migrate
php artisan db:seed --class="Database\\Seeders\\AdminSeeder"
```

4) Serve

```bash
php artisan serve
# http://localhost:8000
```

### Admin

- Login page: `/admin/login`
- Email/password from `.env` via `AdminSeeder`
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
- Admin: `app/Http/Controllers/AdminController.php`
- Middleware alias: `bootstrap/app.php` (`admin` → `AdminAuth`)
- DB models: `app/Models/Subscription.php`, `app/Models/Metric.php`
- Migrations: subscriptions, metrics, add_role_to_users

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
