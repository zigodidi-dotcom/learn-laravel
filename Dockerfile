FROM php:8.4-cli-alpine

RUN apk add --no-cache git unzip curl icu-dev oniguruma-dev libxml2-dev \
 && docker-php-ext-install pdo_mysql intl mbstring xml

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY composer.json composer.lock ./

RUN COMPOSER_ALLOW_SUPERUSER=1 composer install \
    --no-dev \
    --optimize-autoloader \
    --no-scripts \
    --no-interaction \
    --prefer-dist

COPY . .

RUN cp .env.example .env

ENV APP_ENV=production

# Build-time placeholders — real values injected by Railway at runtime
ARG APP_KEY=base64:AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA=
ARG DB_CONNECTION=sqlite
ARG DB_DATABASE=:memory:

RUN mkdir -p bootstrap/cache storage/framework/views storage/framework/cache storage/framework/sessions storage/logs \
 && chmod -R 775 bootstrap/cache storage \
 && php artisan package:discover --ansi

RUN chmod +x docker-entrypoint.sh

CMD ["./docker-entrypoint.sh"]
