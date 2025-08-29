FROM php:8.0-fpm-alpine

# Composer environment
ENV COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_HOME=/composer \
    TZ=Asia/Tokyo

# Install minimal dependencies and PHP extensions
RUN set -eux; \
    apk add --no-cache \
      tzdata \
      git \
      unzip \
      icu-dev \
      libzip-dev \
      $PHPIZE_DEPS; \
    docker-php-ext-install \
      intl \
      pdo_mysql \
      zip \
      bcmath; \
    apk del --no-cache $PHPIZE_DEPS || true

# Install composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# PHP config
COPY ./usr/local/etc/php/php.ini /usr/local/etc/php/php.ini

WORKDIR /var/www/html
