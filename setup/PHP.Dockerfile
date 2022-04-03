FROM php:8.1.4-fpm

# configure opcache for pre-loading files
RUN docker-php-ext-install opcache
# config needs to be copied in now rather than from a volume
COPY opcache.ini /usr/local/etc/php/conf.d/opcache.ini

# add database functionality
RUN docker-php-ext-install pdo pdo_mysql
