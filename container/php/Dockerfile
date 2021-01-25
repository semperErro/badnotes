FROM php:8.0.1-fpm

RUN docker-php-ext-install pdo_mysql && \
    curl --silent --show-error https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer
