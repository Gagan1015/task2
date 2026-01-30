#!/usr/bin/env bash
# Render Start Script for Laravel

set -e

echo "Running database migrations..."
php artisan migrate --force

echo "Starting Laravel server..."
php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
