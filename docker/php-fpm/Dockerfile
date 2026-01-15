FROM php:8.5.2-fpm-trixie

COPY --from=composer:2.9.3 /usr/bin/composer /usr/local/bin/composer

RUN pecl install xdebug-3.5.0 && docker-php-ext-enable xdebug

ADD . /app
WORKDIR /app
