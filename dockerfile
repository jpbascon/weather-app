FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
  unzip \
  git \
  libzip-dev \
  libsqlite3-dev \
  && docker-php-ext-install zip pdo pdo_sqlite \
  && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy project files
COPY . .

# Install PHP dependencies (NO config:cache here!)
RUN composer install --no-dev --optimize-autoloader

# Expose Render's $PORT and start Laravel
# Config caching will happen at runtime automatically if needed
CMD php artisan serve --host 0.0.0.0 --port $PORT
