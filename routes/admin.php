<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| These routes are prefixed with 'admin' and protected by admin middleware.
|
*/

Route::prefix('admin')->name('admin.')->group(function () {
    
    // Guest routes (login page)
    Route::middleware('guest')->group(function () {
        Route::get('login', [Admin\AuthController::class, 'showLoginForm'])->name('login');
        Route::post('login', [Admin\AuthController::class, 'login'])->name('login.submit');
    });
    
    // Protected admin routes
    Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->group(function () {
        
        // Logout
        Route::post('logout', [Admin\AuthController::class, 'logout'])->name('logout');
        
        // Dashboard
        Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::get('dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard.index');
        
        // Hero Slides CRUD
        Route::resource('hero-slides', Admin\HeroSlideController::class);
        Route::post('hero-slides/reorder', [Admin\HeroSlideController::class, 'reorder'])->name('hero-slides.reorder');
        
        // Cars CRUD
        Route::resource('cars', Admin\CarController::class);
        Route::post('cars/reorder', [Admin\CarController::class, 'reorder'])->name('cars.reorder');
        
        // Brands CRUD
        Route::resource('brands', Admin\BrandController::class);
        Route::post('brands/reorder', [Admin\BrandController::class, 'reorder'])->name('brands.reorder');
        
        // Stories CRUD
        Route::resource('stories', Admin\StoryController::class);
        
        // Locations CRUD
        Route::resource('locations', Admin\LocationController::class);
        
        // Articles CRUD
        Route::resource('articles', Admin\ArticleController::class);
        
        // Navigation Links
        Route::resource('nav-links', Admin\NavLinkController::class);
        Route::post('nav-links/reorder', [Admin\NavLinkController::class, 'reorder'])->name('nav-links.reorder');
        
        // Settings
        Route::prefix('settings')->name('settings.')->group(function () {
            Route::get('general', [Admin\SettingController::class, 'general'])->name('general');
            Route::post('general', [Admin\SettingController::class, 'updateGeneral'])->name('general.update');
            
            Route::get('appearance', [Admin\SettingController::class, 'appearance'])->name('appearance');
            Route::post('appearance', [Admin\SettingController::class, 'updateAppearance'])->name('appearance.update');
            
            Route::get('social', [Admin\SettingController::class, 'social'])->name('social');
            Route::post('social', [Admin\SettingController::class, 'updateSocial'])->name('social.update');
        });
    });
});
