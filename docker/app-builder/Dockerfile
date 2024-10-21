# Node builder
FROM node:20.15-alpine3.20 as node-builder

ARG ENV=production
ENV NODE_ENV=$ENV
ENV npm_config_loglevel=error
ENV npm_config_update-notifier=false

WORKDIR /app
COPY package*.json ./
RUN npm i
COPY . .
RUN npm run build

# Opty
FROM alpine:3.20 AS optimized-builder

RUN apk update && \
    apk upgrade && \
    apk add --no-cache \
    brotli \
    && rm -rf /var/cache/apk/ \
    && rm -rf /root/.cache \
    && rm -rf /tmp/*

WORKDIR /app
COPY --from=node-builder /app/public/build/ /app

# brotli
RUN find /app/ -maxdepth 10 -type f -name "*.js" -o -name "*.html" -o -name "*.css" | awk '{ print "\""$0"\""}' | xargs -n 1 gzip -9k
RUN find /app/ -maxdepth 10 -type f -name "*.js" -o -name "*.html" -o -name "*.css" | awk '{ print "\""$0"\""}' | xargs -n 1 brotli -Zk


FROM php:8.2-fpm-alpine3.20

COPY --from=composer/composer:2 /usr/bin/composer /usr/bin/composer

RUN apk add --no-cache --virtual .build-deps \
    ### Install dev dependencies
    $PHPIZE_DEPS \
    autoconf \
    curl-dev \
    libxml2-dev \
    oniguruma-dev \
    zlib-dev \
    libzip-dev \
    rabbitmq-c-dev \
    linux-headers \
    && apk add --no-cache \
       ### Install production dependencies
       rabbitmq-c \
       libzip \
       curl \
       libzip

RUN docker-php-ext-configure zip \
    && docker-php-ext-install \
    curl \
    mysqli \
    mbstring \
    pdo \
    pdo_mysql \
    xml \
    zip \
    bcmath \
    sockets \
    && pecl install amqp \
    && docker-php-ext-enable amqp

# Cleanup dev dependencies
RUN apk del -f .build-deps \
    && rm -rf /var/cache/apk/*

COPY ./docker/app-builder/config/php-fpm.d/www.conf /usr/local/etc/php-fpm.d/www.conf
COPY ./docker/app-builder/config/conf.d/01-php.ini "$PHP_INI_DIR/php.ini"

COPY --chmod=0755 ./docker/app-builder/config/php-healthcheck /usr/local/bin/
WORKDIR /var/www/html
USER www-data
COPY --chown=www-data:www-data  . .
COPY --chown=www-data:www-data --from=optimized-builder  /app/ /var/www/html/public/build/

RUN mv .env .env.archive && composer install --no-interaction --no-plugins --no-scripts --optimize-autoloader && mv .env.archive .env
