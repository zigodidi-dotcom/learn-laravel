#!/bin/sh
set -e

echo "[boot] Ensuring storage directories..."
mkdir -p storage/framework/views storage/framework/cache storage/framework/sessions storage/logs bootstrap/cache
chmod -R 775 storage bootstrap/cache

echo "[boot] Caching configuration..."
php artisan config:cache

echo "[boot] Caching routes..."
php artisan route:cache

echo "[boot] Caching views..."
php artisan view:cache

echo "[boot] Running migrations..."
php artisan migrate --force

echo "[boot] Starting PHP server on :${PORT:-8000}"
exec php -S 0.0.0.0:${PORT:-8000} -t public/
