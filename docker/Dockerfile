FROM php:8.1-cli

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN apt-get update \
    && apt-get install -y git zip unzip zlib1g-dev libzip-dev \
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN docker-php-ext-install zip

WORKDIR /mnt/app
CMD composer install -n && echo "\n\n" && [  -f app/config/.env ] &&  php test.php || echo ".env file not defined, exiting..."