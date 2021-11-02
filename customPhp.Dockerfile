FROM php:7.4-fpm

# Installing tools
RUN apt-get update && apt-get install -y git 
RUN curl -sL https://getcomposer.org/installer | php -- --install-dir /usr/bin --filename composer
RUN docker-php-ext-install pdo pdo_mysql
RUN apt install zip unzip
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug
# RUN chown -R www-data:www-data /var/www
RUN chmod -R 777 /var/www

# If we run a shell in this container it will start in the workdir defined
WORKDIR /var/www/app