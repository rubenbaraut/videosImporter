FROM php:7.3-fpm

RUN apt-get update && apt-get install -y \
        libzip-dev \
        zip \
        libicu-dev \
        curl \
        zlib1g-dev \
        unzip \
        git \
        nano \
    && docker-php-ext-install \
        intl \
        opcache \
        bcmath \
        zip

RUN curl -sS https://getcomposer.org/installer | php -- --filename=composer --install-dir=/bin

# Permission fix
RUN usermod -u 1000 www-data