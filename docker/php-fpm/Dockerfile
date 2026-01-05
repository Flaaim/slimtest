FROM php:8.3-fpm-alpine

RUN apk add --no-cache mysql-dev \
    && docker-php-ext-install pdo_mysql mysqli

RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

COPY ./conf.d /usr/local/etc/php/conf.d

WORKDIR /app
