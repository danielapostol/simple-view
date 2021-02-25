FROM php:fpm-alpine

RUN apk add --update --no-cache --virtual .build-deps autoconf make g++ icu-dev git redis curl-dev
RUN pecl install xdebug apcu redis
RUN docker-php-ext-enable xdebug apcu redis
RUN docker-php-ext-install pdo_mysql opcache curl intl

RUN pecl clear-cache
RUN rm -rf /tmp/pear
RUN rm -rf /var/cache/apk/*

WORKDIR /app

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
