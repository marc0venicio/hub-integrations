FROM php:8.3.6-fpm-alpine3.19 AS base

LABEL maintainer="Marco Venicio"

WORKDIR /data/www

RUN apk update && apk add --no-cache \
    bash \
    curl \
    git \
    libpng-dev \
    libzip-dev \
    oniguruma-dev \
    postgresql-dev \
    supervisor \
    unzip \
    zip && \
    rm -rf /var/cache/apk/* /tmp/*

RUN docker-php-ext-install pdo_mysql gd zip

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/bin --filename=composer

COPY docker/php/php.ini /usr/local/etc/php/
ADD docker/php/timestamp /usr/bin
RUN chmod +x /usr/bin/timestamp
ADD docker/php/crontab /etc/crontab


FROM base AS runner
ARG ENV_FILE
WORKDIR /data/www
COPY $ENV_FILE .env
COPY composer.json .
COPY composer.lock .
RUN composer install --no-scripts
COPY . .
RUN composer run-script post-autoload-dump
RUN composer run-script post-update-cmd
RUN composer run-script post-create-project-cmd


FROM node:15.14.0-alpine3.13 AS frontend-builder
WORKDIR /data/www
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run production


FROM base AS builder
ARG ENV_FILE
WORKDIR /data/www
COPY $ENV_FILE .env
COPY composer.json .
COPY composer.lock .
RUN composer install --no-dev --no-interaction --no-progress --no-suggest --no-scripts
COPY . .
COPY --from=frontend-builder --chown=www-data:www-data /data/www/public /data/www/public
RUN composer run-script post-autoload-dump
RUN composer run-script post-update-cmd


FROM base AS deploy
COPY --from=builder --chown=www-data:www-data /data/www /data/www
HEALTHCHECK --interval=30s --timeout=3s --start-period=5s \
    CMD curl --fail marcenaria-nginx:80/api || exit 1
CMD ["php-fpm"]
