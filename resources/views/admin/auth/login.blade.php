<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login - CarDealer</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 flex items-center justify-center p-4">
    
    <div class="w-full max-w-md">
        <!-- Logo -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center gap-3">
                <div class="bg-primary text-white p-3 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="1.5">
                        <path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.5 2.8C1.4 11.3 1 12.1 1 13v3c0 .6.4 1 1 1h2"/>
                        <circle cx="7" cy="17" r="2"/>
                        <path d="M9 17h6"/>
                        <circle cx="17" cy="17" r="2"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-white">CarDealer</h1>
                    <p class="text-xs text-gray-400">Administration Panel</p>
                </div>
            </div>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-2xl shadow-2xl p-8">
            <h2 class="text-xl font-bold text-gray-900 mb-2">Welcome Back</h2>
            <p class="text-gray-500 text-sm mb-6">Sign in to access the admin dashboard</p>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
                    <ul class="text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
                    <p class="text-sm">{{ session('error') }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                
                <!-- Email -->
                <div class="mb-5">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all"
                        placeholder="admin@cardealer.com"
                        required
                        autofocus
                    >
                </div>

                <!-- Password -->
                <div class="mb-5">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all"
                        placeholder="••••••••"
                        required
                    >
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input 
                            type="checkbox" 
                            name="remember" 
                            class="w-4 h-4 rounded border-gray-300 text-primary focus:ring-primary"
                        >
                        <span class="text-sm text-gray-600">Remember me</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full bg-primary hover:bg-primary-dark text-white font-semibold py-3 px-4 rounded-lg transition-colors shadow-lg shadow-primary/30"
                >
                    Sign In
                </button>
            </form>
        </div>

        <!-- Back to site -->
        <div class="text-center mt-6">
            <a href="/" class="text-gray-400 hover:text-white text-sm transition-colors">
                ← Back to website
            </a>
        </div>
    </div>

</body>
</html>
