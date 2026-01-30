<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## Deploying to Render

This project is configured for deployment to [Render](https://render.com) with PostgreSQL database.

### Option 1: Using Render Blueprint (Recommended)

1. **Push your code to GitHub**
   ```bash
   git add .
   git commit -m "Add Render deployment configuration"
   git push origin main
   ```

2. **Deploy with Blueprint**
   - Go to [Render Dashboard](https://dashboard.render.com)
   - Click "New" → "Blueprint"
   - Connect your GitHub repository
   - Render will automatically detect the `render.yaml` file and create:
     - A PostgreSQL database (`laravel-postgres`)
     - A web service (`laravel-app`)

3. **Generate APP_KEY**
   After deployment, generate a new APP_KEY:
   ```bash
   php artisan key:generate --show
   ```
   Copy the generated key and add it to your Render environment variables.

### Option 2: Manual Setup

1. **Create PostgreSQL Database**
   - Go to Render Dashboard → New → PostgreSQL
   - Note the connection string (DATABASE_URL)

2. **Create Web Service**
   - Go to Render Dashboard → New → Web Service
   - Connect your GitHub repository
   - Configure:
     - **Runtime**: PHP
     - **Build Command**: `./render-build.sh`
     - **Start Command**: `./render-start.sh`

3. **Set Environment Variables**
   Add these to your Render web service:
   ```
   APP_NAME=YourAppName
   APP_ENV=production
   APP_DEBUG=false
   APP_KEY=base64:your-generated-key
   APP_URL=https://your-app.onrender.com
   DB_CONNECTION=pgsql
   DATABASE_URL=<from-your-postgres-database>
   LOG_CHANNEL=stderr
   SESSION_DRIVER=cookie
   CACHE_STORE=file
   QUEUE_CONNECTION=sync
   ```

### Docker Deployment

A `Dockerfile` is also included for containerized deployments:
- Build: `docker build -t laravel-app .`
- Run: `docker run -p 8000:80 laravel-app`

### Files Created for Render

| File | Purpose |
|------|---------|
| `render.yaml` | Render Blueprint configuration |
| `Dockerfile` | Container deployment option |
| `render-build.sh` | Build script for Render |
| `render-start.sh` | Start script for Render |
| `.env.render` | Production environment template |

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

