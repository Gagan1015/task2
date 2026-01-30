@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">
    
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        
        <!-- Cars Stat -->
        <div class="bg-white rounded-xl p-6 border border-gray-100 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Cars</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ $stats['cars'] }}</p>
                    <p class="text-xs text-green-600 mt-2">{{ $stats['active_cars'] }} active</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.5 2.8C1.4 11.3 1 12.1 1 13v3c0 .6.4 1 1 1h2"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Slides Stat -->
        <div class="bg-white rounded-xl p-6 border border-gray-100 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium">Hero Slides</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ $stats['slides'] }}</p>
                    <p class="text-xs text-green-600 mt-2">{{ $stats['active_slides'] }} active</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center text-purple-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Brands Stat -->
        <div class="bg-white rounded-xl p-6 border border-gray-100 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium">Brands</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ $stats['brands'] }}</p>
                    <p class="text-xs text-gray-400 mt-2">Featured brands</p>
                </div>
                <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center text-orange-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Articles Stat -->
        <div class="bg-white rounded-xl p-6 border border-gray-100 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium">Articles</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ $stats['articles'] }}</p>
                    <p class="text-xs text-gray-400 mt-2">Published news</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center text-green-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-xl p-6 border border-gray-100 shadow-sm">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h2>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.cars.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add Car
            </a>
            <a href="{{ route('admin.hero-slides.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add Slide
            </a>
            <a href="{{ route('admin.articles.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add Article
            </a>
            <a href="/" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                View Site
            </a>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- Recent Cars -->
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
            <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-900">Recent Cars</h2>
                <a href="{{ route('admin.cars.index') }}" class="text-sm text-primary hover:underline">View All</a>
            </div>
            <div class="divide-y divide-gray-100">
                @forelse ($recentCars as $car)
                    <div class="p-4 flex items-center gap-4 hover:bg-gray-50">
                        <div class="w-12 h-12 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                            @if ($car->image)
                                <img src="{{ imageUrl($car->image) }}" alt="{{ $car->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-medium text-gray-900 truncate">{{ $car->name }}</p>
                            <p class="text-sm text-gray-500">{{ $car->price }} · {{ ucfirst($car->category) }}</p>
                        </div>
                        <span class="px-2 py-1 text-xs font-medium rounded-full {{ $car->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                            {{ $car->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                @empty
                    <div class="p-8 text-center text-gray-500">
                        <p>No cars added yet.</p>
                        <a href="{{ route('admin.cars.create') }}" class="text-primary hover:underline mt-2 inline-block">Add your first car</a>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Recent Articles -->
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
            <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-900">Recent Articles</h2>
                <a href="{{ route('admin.articles.index') }}" class="text-sm text-primary hover:underline">View All</a>
            </div>
            <div class="divide-y divide-gray-100">
                @forelse ($recentArticles as $article)
                    <div class="p-4 flex items-center gap-4 hover:bg-gray-50">
                        <div class="w-12 h-12 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                            @if ($article->image)
                                <img src="{{ imageUrl($article->image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-medium text-gray-900 truncate">{{ $article->title }}</p>
                            <p class="text-sm text-gray-500">{{ $article->category ?? 'Uncategorized' }} · {{ $article->formatted_views }} views</p>
                        </div>
                        <span class="px-2 py-1 text-xs font-medium rounded-full {{ $article->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                            {{ $article->is_active ? 'Published' : 'Draft' }}
                        </span>
                    </div>
                @empty
                    <div class="p-8 text-center text-gray-500">
                        <p>No articles added yet.</p>
                        <a href="{{ route('admin.articles.create') }}" class="text-primary hover:underline mt-2 inline-block">Write your first article</a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Additional Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-6 text-white">
            <p class="text-blue-100 text-sm font-medium">Visual Stories</p>
            <p class="text-3xl font-bold mt-1">{{ $stats['stories'] }}</p>
        </div>
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl p-6 text-white">
            <p class="text-purple-100 text-sm font-medium">Locations</p>
            <p class="text-3xl font-bold mt-1">{{ $stats['locations'] }}</p>
        </div>
        <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl p-6 text-white">
            <p class="text-orange-100 text-sm font-medium">Active Listings</p>
            <p class="text-3xl font-bold mt-1">{{ $stats['active_cars'] }}</p>
        </div>
    </div>

</div>
@endsection
