<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\AdminController;

Route::get('/', [JobController::class, 'index'])->name('careers.index');
Route::post('/subscribe', [JobController::class, 'subscribe'])->name('careers.subscribe');
Route::post('/track', [JobController::class, 'track'])->name('careers.track');

// Admin Auth
Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Admin dashboard (protected)
Route::middleware('admin')->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});
