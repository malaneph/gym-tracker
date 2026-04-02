FROM serversideup/php:8.5-frankenphp

USER root

RUN install-php-extensions zip intl gd bcmath pcntl pdo_mysql pdo_pgsql pgsql

COPY docker/php/docker-entrypoint.sh /usr/local/bin
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

USER www-data

COPY --chown=www-data:www-data . /var/www/html
COPY --from=composer/composer:latest-bin /composer /usr/bin/composer

RUN mkdir -p /var/www/html/storage/logs

RUN composer install --no-dev --optimize-autoloader --no-scripts --no-interaction
RUN composer run-script post-autoload-dump --no-interaction

ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]

