#!/bin/sh

cd /var/www/html

if [ ! -f .env ]; then
    cp .env.example .env

    # Link storage and public folders
    php artisan storage:link

    # Generate application key (--force is needed in production to bypass the confirmation)
    php artisan key:generate --force
fi

# Run migrations
php artisan migrate

# Execute the specified command in the Dockerfile (CMD ["command"])
exec "$@"
