FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
  unzip \
  git \
  libzip-dev \
  libsqlite3-dev \
  && docker-php-ext-install zip pdo pdo_sqlite

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working dir
WORKDIR /app

# Copy project files
COPY . .

# Install PHP deps & build assets
RUN composer install --no-dev --optimize-autoloader \
  && php artisan config:cache \
  && php artisan route:cache \
  && php artisan view:cache \
  && npm install && npm run build

# Expose Render's $PORT and start Laravel
CMD php artisan serve --host 0.0.0.0 --port $PORT
