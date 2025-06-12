FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get update && apt-get install -y libicu-dev && \
    docker-php-ext-install intl
RUN apt-get update && apt-get install -y libicu-dev libexif-dev && \
    docker-php-ext-configure intl && \
    docker-php-ext-install intl exif
RUN apt-get update && apt-get install -y \
    libmagickwand-dev \
    && pecl install imagick \
    && docker-php-ext-enable imagick
WORKDIR /var/www/html
RUN apt-get update && \
    apt-get install -y libpng-dev && \
    docker-php-ext-install gd
    RUN apt-get update && apt-get install -y \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd
    RUN apt-get update && apt-get install -y \
    libwebp-dev \
    libavif-dev
