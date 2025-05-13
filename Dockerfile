FROM php:8.2-fpm

# Instala dependencias necesarias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    git \
    npm \
    nodejs

# Instala extensiones de PHP requeridas
RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define directorio de trabajo
WORKDIR /var/www

# Copia el código de tu app
COPY . .

# Instala dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Expone el puerto para Laravel
EXPOSE 8000

# Genera clave de app
RUN php artisan key:generate

# Comando para iniciar Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
