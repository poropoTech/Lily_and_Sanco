# docker/Dockerfile

FROM php:7.4-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    libicu-dev \
    && rm -rf /var/lib/apt/lists/*

# Instalar extensiones de PHP necesarias
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instalar Node.js y npm
RUN curl -fsSL https://deb.nodesource.com/setup_14.x | bash - \
    && apt-get install -y nodejs \
    && node -v \
    && npm -v \
    && rm -rf /var/lib/apt/lists/*

# Establecer el directorio de trabajo
WORKDIR /var/www

# Copiar el archivo de configuración de PHP
COPY docker/php.ini /usr/local/etc/php/php.ini

# Copiar el código de la aplicación
COPY . /var/www

# Instalar las dependencias de Composer
RUN composer install --optimize-autoloader --no-dev

# Instalar las dependencias de npm y compilar activos
RUN npm install && npm run production

# Dar permisos a los directorios de Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Exponer el puerto 9000 y ejecutar PHP-FPM
EXPOSE 9000
CMD ["php-fpm"]
