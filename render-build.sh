#!/usr/bin/env bash
# Render Build Script for Laravel

set -e

echo "Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

echo "Installing Node dependencies..."
npm ci

echo "Building frontend assets..."
npm run build

echo "Caching Laravel configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Build complete!"
