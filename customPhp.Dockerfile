FROM php:7.4-fpm


# Install git and composer
RUN apt-get update && apt-get install -y git 
RUN curl -sL https://getcomposer.org/installer | php -- --install-dir /usr/bin --filename composer
RUN echo "alias hi='Hello World!'" >> ~/.bashrc
#if we run sh in this container it will start in the workdir defined
WORKDIR /var/www/app