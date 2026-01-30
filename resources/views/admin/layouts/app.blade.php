<!DOCTYPE html>
<html lang="en" x-data="{ sidebarOpen: true, mobileMenuOpen: false }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - Admin | CarDealer</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-50 min-h-screen">
    
    <div class="flex min-h-screen">
        
        <!-- Sidebar -->
        <aside 
            :class="sidebarOpen ? 'w-64' : 'w-20'"
            class="fixed inset-y-0 left-0 z-50 bg-white border-r border-gray-200 transition-all duration-300 hidden lg:block"
        >
            <!-- Logo -->
            <div class="h-16 flex items-center justify-between px-4 border-b border-gray-100">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                    <div class="bg-primary text-white p-2 rounded-lg flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="1.5">
                            <path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.5 2.8C1.4 11.3 1 12.1 1 13v3c0 .6.4 1 1 1h2"/>
                            <circle cx="7" cy="17" r="2"/>
                            <path d="M9 17h6"/>
                            <circle cx="17" cy="17" r="2"/>
                        </svg>
                    </div>
                    <span x-show="sidebarOpen" x-cloak class="font-bold text-gray-900">CarDealer</span>
                </a>
                <button @click="sidebarOpen = !sidebarOpen" class="text-gray-400 hover:text-gray-600 flex-shrink-0">
                    <svg x-show="sidebarOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
                    </svg>
                    <svg x-show="!sidebarOpen" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="p-4 space-y-1 overflow-y-auto" style="height: calc(100vh - 64px);">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.dashboard*') ? 'bg-primary/10 text-primary font-medium' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                    <span x-show="sidebarOpen" x-cloak>Dashboard</span>
                </a>
                
                <div class="pt-4" x-show="sidebarOpen" x-cloak>
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Content</p>
                </div>
                
                <a href="{{ route('admin.hero-slides.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.hero-slides*') ? 'bg-primary/10 text-primary font-medium' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span x-show="sidebarOpen" x-cloak>Hero Slides</span>
                </a>
                
                <a href="{{ route('admin.cars.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.cars*') ? 'bg-primary/10 text-primary font-medium' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.5 2.8C1.4 11.3 1 12.1 1 13v3c0 .6.4 1 1 1h2M7 17a2 2 0 100-4 2 2 0 000 4zM17 17a2 2 0 100-4 2 2 0 000 4z"/></svg>
                    <span x-show="sidebarOpen" x-cloak>Cars</span>
                </a>
                
                <a href="{{ route('admin.brands.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.brands*') ? 'bg-primary/10 text-primary font-medium' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                    <span x-show="sidebarOpen" x-cloak>Brands</span>
                </a>
                
                <a href="{{ route('admin.stories.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.stories*') ? 'bg-primary/10 text-primary font-medium' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    <span x-show="sidebarOpen" x-cloak>Stories</span>
                </a>
                
                <a href="{{ route('admin.locations.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.locations*') ? 'bg-primary/10 text-primary font-medium' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <span x-show="sidebarOpen" x-cloak>Locations</span>
                </a>
                
                <a href="{{ route('admin.articles.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.articles*') ? 'bg-primary/10 text-primary font-medium' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    <span x-show="sidebarOpen" x-cloak>Articles</span>
                </a>
                
                <div class="pt-4" x-show="sidebarOpen" x-cloak>
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Settings</p>
                </div>
                
                <a href="{{ route('admin.nav-links.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.nav-links*') ? 'bg-primary/10 text-primary font-medium' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <span x-show="sidebarOpen" x-cloak>Navigation</span>
                </a>
                
                <a href="{{ route('admin.settings.general') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.settings*') ? 'bg-primary/10 text-primary font-medium' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <span x-show="sidebarOpen" x-cloak>Settings</span>
                </a>
                
                <div class="pt-6" x-show="sidebarOpen" x-cloak>
                    <a href="/" target="_blank" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-primary hover:bg-primary/10 transition-all">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        <span>View Site</span>
                    </a>
                </div>
            </nav>
        </aside>

        <!-- Mobile Menu Overlay -->
        <div 
            x-show="mobileMenuOpen" 
            x-cloak
            @click="mobileMenuOpen = false"
            class="fixed inset-0 bg-black/50 z-40 lg:hidden"
            x-transition:enter="transition-opacity ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
        ></div>

        <!-- Mobile Sidebar -->
        <aside 
            x-show="mobileMenuOpen"
            x-cloak
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="-translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-200 lg:hidden"
        >
            <!-- Mobile Logo -->
            <div class="h-16 flex items-center justify-between px-4 border-b border-gray-100">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                    <div class="bg-primary text-white p-2 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="1.5">
                            <path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.5 2.8C1.4 11.3 1 12.1 1 13v3c0 .6.4 1 1 1h2"/>
                            <circle cx="7" cy="17" r="2"/>
                            <path d="M9 17h6"/>
                            <circle cx="17" cy="17" r="2"/>
                        </svg>
                    </div>
                    <span class="font-bold text-gray-900">CarDealer</span>
                </a>
                <button @click="mobileMenuOpen = false" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <nav class="p-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.dashboard*') ? 'bg-primary/10 text-primary font-medium' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6z"/></svg>
                    <span>Dashboard</span>
                </a>
                <p class="px-4 pt-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Content</p>
                <a href="{{ route('admin.hero-slides.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.hero-slides*') ? 'bg-primary/10 text-primary font-medium' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14"/></svg>
                    <span>Hero Slides</span>
                </a>
                <a href="{{ route('admin.cars.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.cars*') ? 'bg-primary/10 text-primary font-medium' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9"/></svg>
                    <span>Cars</span>
                </a>
                <a href="{{ route('admin.brands.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.brands*') ? 'bg-primary/10 text-primary font-medium' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                    <span>Brands</span>
                </a>
                <a href="{{ route('admin.stories.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.stories*') ? 'bg-primary/10 text-primary font-medium' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2"/></svg>
                    <span>Stories</span>
                </a>
                <a href="{{ route('admin.locations.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.locations*') ? 'bg-primary/10 text-primary font-medium' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                    <span>Locations</span>
                </a>
                <a href="{{ route('admin.articles.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.articles*') ? 'bg-primary/10 text-primary font-medium' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1"/></svg>
                    <span>Articles</span>
                </a>
                <p class="px-4 pt-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Settings</p>
                <a href="{{ route('admin.nav-links.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.nav-links*') ? 'bg-primary/10 text-primary font-medium' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <span>Navigation</span>
                </a>
                <a href="{{ route('admin.settings.general') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.settings*') ? 'bg-primary/10 text-primary font-medium' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37"/></svg>
                    <span>Settings</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div :class="sidebarOpen ? 'lg:ml-64' : 'lg:ml-20'" class="flex-1 transition-all duration-300">
            
            <!-- Top Header -->
            <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-4 lg:px-6 sticky top-0 z-30">
                <!-- Mobile menu button -->
                <button @click="mobileMenuOpen = true" class="lg:hidden text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                
                <!-- Page Title -->
                <h1 class="text-lg font-semibold text-gray-900 hidden lg:block">@yield('page-title', 'Dashboard')</h1>
                
                <!-- Right Actions -->
                <div class="flex items-center gap-4">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500">Administrator</p>
                    </div>
                    <div class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center text-primary font-bold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors" title="Logout">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-4 lg:p-6">
                
                <!-- Flash Messages -->
                @if (session('success'))
                    <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-center gap-3">
                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg flex items-center gap-3">
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <style>
        [x-cloak] { display: none !important; }
    </style>

    @stack('scripts')
</body>
</html>
