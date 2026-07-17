FROM php:8.2-apache

# Install dependency sistem & extension PHP yang Laravel butuhin
RUN apt-get update && apt-get install -y \
    git curl unzip zip \
    libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip \
    && a2enmod rewrite

# Copy composer dari image resmi composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy semua source code project
COPY . .

# Install dependency PHP (tanpa dev dependency biar ringan)
RUN composer install --optimize-autoloader --no-dev --no-interaction

# Arahkan document root Apache ke folder public Laravel
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf \
    && sed -i 's!/var/www/!/var/www/html/public!g' /etc/apache2/apache2.conf

# Kasih permission ke folder yang perlu ditulis Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80

# Saat container start: cache config, jalankan migration, lalu nyalain Apache
CMD php artisan config:cache \
    && php artisan route:cache \
    && php artisan migrate --force \
    && apache2-foreground