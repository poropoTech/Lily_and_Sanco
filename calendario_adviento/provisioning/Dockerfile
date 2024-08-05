FROM php:7.4-fpm
LABEL maintainer="jdcobas@gmail.com"

# Installing dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    gnupg2 \
    procps \
    inetutils-ping\
    mariadb-client \
    libpng-dev \
    libmagickwand-dev \
    ghostscript \
    libjpeg62-turbo-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libzip-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Installing Node.js
RUN curl -sL https://deb.nodesource.com/setup_12.x | bash -
RUN apt-get install nodejs -y

# Installing extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl
RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/
RUN docker-php-ext-install gd
RUN pecl install xdebug-2.9.0
RUN docker-php-ext-enable xdebug

RUN echo 'xdebug.remote_port=9000' >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
#RUN echo 'xdebug.idekey=PHPSTORM' >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo 'xdebug.remote_enable=on' >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo 'xdebug.remote_connect_back=off' >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
#RUN echo 'xdebug.default_enable=1' >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo 'xdebug.remote_handler=dbgp' >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo 'xdebug.remote_autostart=on' >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN pecl install imagick
RUN docker-php-ext-enable imagick

# Installing composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Setting locales
RUN echo es_ES.UTF-8 UTF-8 > /etc/locale.gen && locale-gen

# Allow container to write on host
RUN usermod -u 1000 www-data

# Changing Workdir
WORKDIR /application
