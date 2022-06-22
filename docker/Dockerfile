FROM php:8.1-cli

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /mnt/app
CMD composer install -n && echo "\n\n" && [  -f app/config/.env ] &&  php test.php || echo ".env file not defined, exiting..."