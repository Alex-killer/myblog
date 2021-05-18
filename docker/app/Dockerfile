FROM php:7.3-fpm-alpine

ARG UID=1000
ARG DOCKER_ENV=local

RUN apk add --update --no-cache --virtual .build-deps \
    libpng-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    libmcrypt-dev \
    postgresql-dev \
    icu-dev \
    libzip-dev \
    autoconf \
    zlib-dev \
    imagemagick-dev \
    gcc \
    g++ \
    make \
    gettext-dev \
  && apk add --update --no-cache \
    imagemagick \
    libpng \
    libpq \
    libintl \
    icu \
    freetype \
    libjpeg-turbo \
  && docker-php-ext-install pdo_pgsql \
  && docker-php-ext-configure gd \
    --with-jpeg-dir=/usr/lib \
    --with-freetype-dir=/usr/include/freetype2 \
  && docker-php-ext-configure intl \
  && docker-php-ext-install \
    gd \
    bcmath \
    exif \
    #zip \
    intl \
    #iconv \
  && pecl install imagick \
  && pecl install -o -f redis \
  && docker-php-ext-enable \
    imagick \
    redis \
  && apk del .build-deps


COPY ./php/x.pool.conf /usr/local/etc/php-fpm.d/x.pool.conf
COPY ./php/my.php.ini /usr/local/etc/php/conf.d/my.php.ini
COPY ./php/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

WORKDIR /app

RUN addgroup -g ${UID} deployer \
  && adduser -u ${UID} -G deployer -s /bin/sh -D deployer

RUN rm -rf /var/cache/apk/* && \
    rm -rf /tmp/*
