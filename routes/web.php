<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;

// Login route alias for auth middleware (redirects to admin login)
Route::get('/login', fn() => redirect()->route('admin.login'))->name('login');

// Landing page
Route::get('/', [LandingController::class, 'index'])->name('landing');

// Include admin routes
require __DIR__.'/admin.php';
