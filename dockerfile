FROM php:8.2-cli

# Install system dependencies and Node for Vite
RUN apt-get update && apt-get install -y \
  unzip \
  git \
  curl \
  libzip-dev \
  libsqlite3-dev \
  && docker-php-ext-install zip pdo pdo_sqlite \
  && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
  && apt-get install -y nodejs \
  && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy project files
COPY . .

# Install PHP & JS dependencies and build assets
RUN composer install --no-dev --optimize-autoloader \
  && npm install \
  && npm run build

# Expose Render's $PORT and start Laravel
CMD php artisan serve --host 0.0.0.0 --port $PORT
