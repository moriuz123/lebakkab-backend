FROM php:8.1-fpm

# 1. Install library Linux yang dibutuhkan
RUN apt-get update && apt-get install -y \
    unzip \
    curl \
    libpng-dev \
    libzip-dev \
    libicu-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    && rm -rf /var/lib/apt/lists/* # Hapus cache apt untuk memperkecil ukuran image

# 2. Kompilasi dan Install Ekstensi PHP wajib
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-configure intl \
    && docker-php-ext-install pdo_mysql gd zip intl

# 3. Install Composer secara resmi
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html
