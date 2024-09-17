FROM php:8.3-fpm

# set your user name, ex: user=carlos
ARG user=marco
ARG uid=1000

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd sockets

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer


RUN curl -fsSL https://nodejs.org/dist/v16.13.2/node-v16.13.2-linux-x64.tar.xz -o node-v16.13.2.tar.xz && \
    tar -xf node-v16.13.2.tar.xz && \
    mv node-v16.13.2-linux-x64 /usr/local/node && \
    rm node-v16.13.2.tar.xz

RUN ln -s /usr/local/node/bin/node /usr/local/bin/node && \
    ln -s /usr/local/node/bin/npm /usr/local/bin/npm && \
    ln -s /usr/local/node/bin/npx /usr/local/bin/npx

ENV PATH="/usr/local/node/bin:${PATH}"

# Install redis
RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis

# Set working directory
WORKDIR /var/www

# Copy custom configurations PHP
COPY docker/php/custom.ini /usr/local/etc/php/conf.d/custom.ini
