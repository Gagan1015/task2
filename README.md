# CarDealer - Laravel Car Dealership Landing Page

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS">
  <img src="https://img.shields.io/badge/Alpine.js-3.x-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white" alt="Alpine.js">
  <img src="https://img.shields.io/badge/Cloudinary-Enabled-3448C5?style=for-the-badge&logo=cloudinary&logoColor=white" alt="Cloudinary">
  <img src="https://img.shields.io/badge/Heroku-Ready-430098?style=for-the-badge&logo=heroku&logoColor=white" alt="Heroku">
</p>

A modern, responsive car dealership landing page with a full-featured admin panel for content management. Built with Laravel 12, Tailwind CSS, and Alpine.js.

## 🚗 Features

### Frontend
- **Hero Slider** - Dynamic image carousel with customizable slides
- **Car Listings** - Display cars by category (Most Seen, Electric, Upcoming)
- **Brand Showcase** - Logo grid of car brands
- **Stories Section** - Visual story cards with images
- **News/Articles** - Latest automotive news and articles
- **Locations** - Nearby dealership locations
- **Responsive Design** - Optimized for all screen sizes

### Admin Panel
- **Dashboard** - Overview statistics and quick actions
- **Hero Slides Management** - CRUD for homepage slider
- **Cars Management** - Add, edit, delete car listings
- **Brands Management** - Manage car brand logos
- **Stories Management** - Create visual story content
- **Articles Management** - Blog/news article management
- **Locations Management** - Dealership location data
- **Navigation Settings** - Customize menu links
- **Site Settings** - General, appearance, and social settings

### Technical Features
- 🖼️ **Cloudinary Integration** - Cloud-based image storage
- 📦 **Client-side Image Compression** - Optimizes uploads to avoid timeouts
- 🔒 **Admin Authentication** - Secure login system
- 📱 **Responsive Admin Panel** - Works on desktop and mobile
- ⚡ **Vite Asset Bundling** - Fast development and optimized builds

## 📋 Requirements

- PHP 8.2+
- Composer
- Node.js 18+
- MySQL 8.0+
- Cloudinary Account (for production)

## 🛠️ Local Installation

```bash
# Clone the repository
git clone <repository-url>
cd task2

# Install PHP dependencies
composer install

# Install Node dependencies
npm install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure database in .env
# DB_DATABASE=cardealer
# DB_USERNAME=root
# DB_PASSWORD=

# Run migrations and seeders
php artisan migrate --seed

# Create storage link
php artisan storage:link

# Build frontend assets
npm run build

# Start development server
php artisan serve
```

## 🔐 Default Admin Credentials

After seeding, use these credentials to access the admin panel:

- **URL:** `/admin`
- **Email:** `admin@example.com`
- **Password:** `password`

## ☁️ Cloudinary Setup

This project uses Cloudinary for image storage, which is required for Heroku deployment (ephemeral filesystem).

### 1. Create a Cloudinary Account
Sign up at [cloudinary.com](https://cloudinary.com)

### 2. Get Your Credentials
From your Cloudinary Dashboard, get:
- Cloud Name
- API Key
- API Secret

### 3. Set Environment Variable
```bash
# Format: cloudinary://API_KEY:API_SECRET@CLOUD_NAME
CLOUDINARY_URL=cloudinary://123456789:abcdefg@your-cloud-name
```

## 🚀 Deploying to Heroku

### Prerequisites
1. [Heroku CLI](https://devcenter.heroku.com/articles/heroku-cli) installed
2. A Heroku account
3. A Cloudinary account

### Step 1: Create Heroku App
```bash
heroku create your-app-name
```

### Step 2: Add Buildpacks
```bash
heroku buildpacks:add heroku/nodejs
heroku buildpacks:add heroku/php
```

### Step 3: Add MySQL Database
```bash
heroku addons:create jawsdb:kitefin
```

### Step 4: Set Environment Variables
```bash
# Generate APP_KEY
php artisan key:generate --show

# Set config vars
heroku config:set APP_NAME="CarDealer"
heroku config:set APP_ENV=production
heroku config:set APP_DEBUG=false
heroku config:set APP_KEY=base64:your-generated-key
heroku config:set APP_URL=https://your-app-name.herokuapp.com
heroku config:set LOG_CHANNEL=errorlog
heroku config:set SESSION_DRIVER=cookie
heroku config:set CACHE_STORE=file
heroku config:set QUEUE_CONNECTION=sync
heroku config:set CLOUDINARY_URL=cloudinary://API_KEY:API_SECRET@CLOUD_NAME
```

### Step 5: Deploy
```bash
git push heroku main
```

### Step 6: Run Migrations
```bash
heroku run "php artisan migrate --seed --force"
```

### Useful Heroku Commands
```bash
# View logs
heroku logs --tail

# Run artisan commands
heroku run php artisan <command>

# Open app in browser
heroku open

# Check config vars
heroku config

# Restart dynos
heroku restart
```

## 📁 Project Structure

```
├── app/
│   ├── Helpers/           # Global helper functions
│   ├── Http/Controllers/
│   │   └── Admin/         # Admin panel controllers
│   ├── Models/            # Eloquent models
│   └── Traits/            # Reusable traits (Cloudinary upload)
├── config/
│   └── cloudinary.php     # Cloudinary configuration
├── database/
│   ├── migrations/        # Database migrations
│   └── seeders/           # Database seeders with sample data
├── resources/
│   ├── css/               # Tailwind CSS
│   ├── js/                # JavaScript (Alpine.js, image compression)
│   └── views/
│       ├── admin/         # Admin panel views
│       └── components/    # Blade components
├── Procfile               # Heroku process file
└── composer.json          # PHP dependencies
```

## 🔧 Key Configuration Files

| File | Purpose |
|------|---------|
| `Procfile` | Heroku web process (Apache) |
| `composer.json` | PHP dependencies & build scripts |
| `vite.config.js` | Vite bundler configuration |
| `tailwind.config.js` | Tailwind CSS customization |
| `config/cloudinary.php` | Cloudinary settings |

## 📸 Image Upload Flow

1. **Client-side compression** - Images are resized and compressed in the browser
2. **Server upload** - Compressed image sent to Laravel
3. **Cloudinary upload** - Laravel uploads to Cloudinary
4. **URL storage** - Cloudinary URL saved to database

This ensures fast uploads even on slow connections and avoids Heroku's 30-second timeout.

## 🎨 Customization

### Changing Colors
Edit `tailwind.config.js` to modify the primary color:
```javascript
theme: {
  extend: {
    colors: {
      primary: '#F97316', // Orange
      'primary-dark': '#EA580C',
    }
  }
}
```

### Adding New Admin Sections
1. Create a new model and migration
2. Create a controller in `app/Http/Controllers/Admin/`
3. Add routes in `routes/web.php`
4. Create views in `resources/views/admin/`
5. Add navigation links in `admin/layouts/app.blade.php`

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🙏 Acknowledgments

- [Laravel](https://laravel.com) - The PHP Framework
- [Tailwind CSS](https://tailwindcss.com) - Utility-first CSS
- [Alpine.js](https://alpinejs.dev) - Lightweight JavaScript
- [Cloudinary](https://cloudinary.com) - Image Management
- [Heroicons](https://heroicons.com) - Beautiful icons
