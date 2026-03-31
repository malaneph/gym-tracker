FROM dunglas/frankenphp

WORKDIR /app

RUN install-php-extensions zip intl gd pcntl pdo_mysql pdo_pgsql pgsql

COPY --from=composer/composer:latest-bin /composer /usr/bin/composer

# Copy dependency manifests first for better layer caching
COPY composer.json composer.lock ./

# Install production dependencies
RUN composer install --no-dev --optimize-autoloader --no-scripts --no-interaction

# Copy remaining application files
COPY . .

# Run post-install composer scripts
RUN composer run-script post-autoload-dump --no-interaction

# Ensure Laravel writable directories exist with correct permissions
RUN mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache storage/logs bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

ENTRYPOINT ["php", "artisan", "octane:frankenphp", "--host=0.0.0.0", "--port=8000"]
