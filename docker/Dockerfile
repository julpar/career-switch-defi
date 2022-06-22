FROM php:8.1-cli

ENV DEBIAN_FRONTEND noninteractive

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN apt-get update \
    && apt-get install -y git zip unzip zlib1g-dev libzip-dev \
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN docker-php-ext-install zip

# Debug infra: Install public certs for debugging with mitm in case
RUN mkdir -p /usr/local/share/ca-certificates/extra
COPY certs/mitmproxy-ca-cert.crt /usr/local/share/ca-certificates/extra/
RUN update-ca-certificates

WORKDIR /mnt/app
CMD composer install -n && echo "\n\n" && ([  -f app/config/.env ] &&  php test.php || echo ".env file not defined, exiting...")