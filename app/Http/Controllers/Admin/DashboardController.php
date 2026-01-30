<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Brand;
use App\Models\Car;
use App\Models\HeroSlide;
use App\Models\Location;
use App\Models\Story;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        $stats = [
            'cars' => Car::count(),
            'slides' => HeroSlide::count(),
            'brands' => Brand::count(),
            'articles' => Article::count(),
            'stories' => Story::count(),
            'locations' => Location::count(),
            'active_cars' => Car::active()->count(),
            'active_slides' => HeroSlide::active()->count(),
        ];

        $recentCars = Car::latest()->take(5)->get();
        $recentArticles = Article::latest()->take(5)->get();

        return view('admin.dashboard.index', compact('stats', 'recentCars', 'recentArticles'));
    }
}
