FROM php:8.2-fpm

ARG user
ARG uid

RUN apt-get update && apt-get install -y \
    openssl \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libpq-dev \
    zip \
    unzip \
    git \
    nano 
RUN pecl install xdebug && docker-php-ext-enable xdebug

RUN docker-php-ext-install gd pdo pdo_pgsql mbstring exif pcntl bcmath sockets zip

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && chown -R $user:$user /home/$user

COPY php.ini /etc/php/8.2/fpm/conf.d/99-overrides.ini
COPY xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

WORKDIR /var/www

USER $user