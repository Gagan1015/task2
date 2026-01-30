<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- SEO Meta Tags -->
    <title>@yield('title', 'CarDealer - Find Your Dream Car')</title>
    <meta name="description" content="@yield('description', 'The most trusted marketplace to buy, sell, and rent vehicles. Find new cars, used cars, electric vehicles, and more.')">
    
    <!-- Google Fonts - Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Additional Head Content -->
    @stack('styles')
</head>
<body class="bg-gray-50 text-slate-800 antialiased font-sans min-h-screen">
    
    <!-- Main Content -->
    @yield('content')
    
    <!-- Additional Scripts -->
    @stack('scripts')
    
</body>
</html>
