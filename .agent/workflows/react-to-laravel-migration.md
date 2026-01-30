---
description: Convert React Vite landing page to Laravel Blade components
---

# React to Laravel Migration Workflow

This workflow converts the CarDealer React landing page to Laravel Blade components.

## Prerequisites
- Ensure Laravel project is set up at `c:\unbundel\task2`
- React source at `C:\Users\admin\Downloads\cardealer-pro`

## Phase 1: Setup & Configuration

### 1.1 Install Alpine.js
// turbo
```bash
cd c:\unbundel\task2 && npm install alpinejs
```

### 1.2 Update app.css with theme
Update `resources/css/app.css` to include:
- Custom colors (primary: #FF5722, primary-dark: #E64A19, secondary: #1E293B)
- Inter font from Google Fonts
- Custom animations (fade-in, fade-in-up)
- Custom scrollbar styles

### 1.3 Update app.js to initialize Alpine.js
Add Alpine.js import and initialization to `resources/js/app.js`

## Phase 2: Create Base Layout

### 2.1 Create layouts/app.blade.php
Create the main layout file with:
- DOCTYPE and HTML structure
- Google Fonts link (Inter)
- Vite directives for CSS/JS
- Alpine.js initialization
- Body with @yield('content')

## Phase 3: Create Icon Components

### 3.1 Create icon components
Create SVG-based Blade components in `resources/views/components/icons/`:
- car.blade.php
- map-pin.blade.php
- search.blade.php
- chevron-down.blade.php
- menu.blade.php
- x.blade.php
- arrow-right.blade.php
- zap.blade.php
- heart.blade.php
- user.blade.php
- facebook.blade.php
- twitter.blade.php
- instagram.blade.php
- youtube.blade.php
- bar-chart.blade.php
- play-circle.blade.php

## Phase 4: Create UI Components

### 4.1 Create section-header.blade.php
Props: $title, $linkText, $centered

### 4.2 Create car-card.blade.php
Props: $car, $variant (default/upcoming)

### 4.3 Create other card components
- used-car-card.blade.php
- brand-card.blade.php
- story-card.blade.php
- comparison-card.blade.php
- location-card.blade.php
- news-card.blade.php
- education-card.blade.php

## Phase 5: Create Major Components

### 5.1 Create header.blade.php
- Sticky header with scroll detection (Alpine.js)
- Mobile menu toggle
- Navigation links
- Search bar
- User actions

### 5.2 Create footer.blade.php
- Brand column
- Link columns (4)
- App download buttons
- Social icons
- Copyright

### 5.3 Create hero.blade.php
- Background image slider (Alpine.js)
- Search card with tab switcher
- Radio options for search method
- Dropdown selects
- Slide navigation tabs

## Phase 6: Create Section Partials

### 6.1 Create section blade files
In `resources/views/sections/`:
- most-seen-cars.blade.php
- electric-cars.blade.php
- upcoming-cars.blade.php
- trusted-used-cars.blade.php
- popular-brands.blade.php
- visual-stories.blade.php
- comparison-tool.blade.php
- nearby-locations.blade.php
- news.blade.php
- educational.blade.php

## Phase 7: Create Controller & Routes

### 7.1 Create LandingController
// turbo
```bash
cd c:\unbundel\task2 && php artisan make:controller LandingController
```

### 7.2 Add data to controller
Add all car data, brands, stories, locations, news to the index method

### 7.3 Update routes/web.php
Route::get('/', [LandingController::class, 'index']);

## Phase 8: Create Landing Page

### 8.1 Create landing.blade.php
Combine all sections:
1. @extends('layouts.app')
2. <x-header />
3. All sections included
4. <x-footer />

## Phase 9: Test & Verify

### 9.1 Start development servers
// turbo
```bash
cd c:\unbundel\task2 && npm run dev
```

### 9.2 In another terminal
```bash
cd c:\unbundel\task2 && php artisan serve
```

### 9.3 Open browser and test
Navigate to http://localhost:8000 and verify:
- All sections render
- Mobile menu works
- Hero slider works
- Animations work
- Responsive design works

## Reference
See full migration plan: `.agent/artifacts/react-to-laravel-migration-plan.md`
