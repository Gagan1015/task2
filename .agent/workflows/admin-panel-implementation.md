---
description: Implement admin panel for CarDealer landing page content management
---

# Admin Panel Implementation Workflow

This workflow creates a full-featured admin panel for managing CarDealer landing page content.

## Prerequisites
- Laravel project setup at `c:\unbundel\task2`
- Landing page migration completed
- Database configured in `.env`

## Phase 1: Foundation - Database & Models

### 1.1 Create migrations
// turbo
```bash
cd c:\unbundel\task2 && php artisan make:migration add_is_admin_to_users_table
```

// turbo
```bash
cd c:\unbundel\task2 && php artisan make:migration create_hero_slides_table
```

// turbo
```bash
cd c:\unbundel\task2 && php artisan make:migration create_cars_table
```

// turbo
```bash
cd c:\unbundel\task2 && php artisan make:migration create_brands_table
```

// turbo
```bash
cd c:\unbundel\task2 && php artisan make:migration create_stories_table
```

// turbo
```bash
cd c:\unbundel\task2 && php artisan make:migration create_locations_table
```

// turbo
```bash
cd c:\unbundel\task2 && php artisan make:migration create_articles_table
```

// turbo
```bash
cd c:\unbundel\task2 && php artisan make:migration create_site_settings_table
```

// turbo
```bash
cd c:\unbundel\task2 && php artisan make:migration create_nav_links_table
```

### 1.2 Define migration schemas
Add column definitions to each migration file as per the plan

### 1.3 Create Eloquent models
// turbo
```bash
cd c:\unbundel\task2 && php artisan make:model HeroSlide
```

// turbo
```bash
cd c:\unbundel\task2 && php artisan make:model Car
```

// turbo
```bash
cd c:\unbundel\task2 && php artisan make:model Brand
```

// turbo
```bash
cd c:\unbundel\task2 && php artisan make:model Story
```

// turbo
```bash
cd c:\unbundel\task2 && php artisan make:model Location
```

// turbo
```bash
cd c:\unbundel\task2 && php artisan make:model Article
```

// turbo
```bash
cd c:\unbundel\task2 && php artisan make:model SiteSetting
```

// turbo
```bash
cd c:\unbundel\task2 && php artisan make:model NavLink
```

### 1.4 Create Admin Middleware
// turbo
```bash
cd c:\unbundel\task2 && php artisan make:middleware AdminMiddleware
```

### 1.5 Run migrations
```bash
cd c:\unbundel\task2 && php artisan migrate
```

## Phase 2: Authentication

### 2.1 Create Auth Controller
// turbo
```bash
cd c:\unbundel\task2 && php artisan make:controller Admin/AuthController
```

### 2.2 Create login view
Create `resources/views/admin/auth/login.blade.php`

### 2.3 Set up admin routes
Create `routes/admin.php` and include it in `routes/web.php`

## Phase 3: Admin Layout

### 3.1 Create admin layout
Create `resources/views/admin/layouts/app.blade.php` with sidebar

### 3.2 Create admin UI components
- Card component
- Button component
- Input component
- Table component
- Modal component
- File upload component

## Phase 4: Dashboard

### 4.1 Create Dashboard Controller
// turbo
```bash
cd c:\unbundel\task2 && php artisan make:controller Admin/DashboardController
```

### 4.2 Create dashboard view
Create `resources/views/admin/dashboard/index.blade.php`

## Phase 5: Hero Slides CRUD

### 5.1 Create controller
// turbo
```bash
cd c:\unbundel\task2 && php artisan make:controller Admin/HeroSlideController --resource
```

### 5.2 Create views
- index.blade.php (list all slides)
- create.blade.php (add new slide)
- edit.blade.php (edit slide)

### 5.3 Add image upload logic
Create `ImageUploadService` for handling uploads

## Phase 6: Cars CRUD

### 6.1 Create controller
// turbo
```bash
cd c:\unbundel\task2 && php artisan make:controller Admin/CarController --resource
```

### 6.2 Create views
- index.blade.php (tabbed list by category)
- create.blade.php
- edit.blade.php

## Phase 7: Other Resources CRUD

### 7.1 Brands CRUD
// turbo
```bash
cd c:\unbundel\task2 && php artisan make:controller Admin/BrandController --resource
```

### 7.2 Stories CRUD
// turbo
```bash
cd c:\unbundel\task2 && php artisan make:controller Admin/StoryController --resource
```

### 7.3 Locations CRUD
// turbo
```bash
cd c:\unbundel\task2 && php artisan make:controller Admin/LocationController --resource
```

### 7.4 Articles CRUD
// turbo
```bash
cd c:\unbundel\task2 && php artisan make:controller Admin/ArticleController --resource
```

## Phase 8: Settings Panel

### 8.1 Create controller
// turbo
```bash
cd c:\unbundel\task2 && php artisan make:controller Admin/SettingController
```

### 8.2 Create settings views
- general.blade.php
- appearance.blade.php
- social.blade.php

## Phase 9: Navigation Management

### 9.1 Create controller
// turbo
```bash
cd c:\unbundel\task2 && php artisan make:controller Admin/NavLinkController --resource
```

### 9.2 Create navigation view
- index.blade.php with drag-sort

## Phase 10: Integration

### 10.1 Update LandingController
Modify to fetch data from database instead of static arrays

### 10.2 Update Blade views
Ensure all components use database-driven data

### 10.3 Create seeders
// turbo
```bash
cd c:\unbundel\task2 && php artisan make:seeder AdminUserSeeder
```

// turbo
```bash
cd c:\unbundel\task2 && php artisan make:seeder HeroSlideSeeder
```

// turbo
```bash
cd c:\unbundel\task2 && php artisan make:seeder CarSeeder
```

### 10.4 Seed database
```bash
cd c:\unbundel\task2 && php artisan db:seed
```

## Phase 11: Testing

### 11.1 Test admin login
Navigate to http://127.0.0.1:8000/admin

### 11.2 Test all CRUD operations
- Create, edit, delete for each resource
- Image uploads
- Sorting/reordering

### 11.3 Verify landing page
Confirm all dynamic content displays correctly

## Reference
See full implementation plan: `.agent/artifacts/admin-panel-implementation-plan.md`
