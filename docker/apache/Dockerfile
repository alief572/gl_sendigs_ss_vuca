FROM php:7.4-apache

RUN a2enmod rewrite
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli

COPY ./000-default.conf /etc/apache2/sites-available/000-default.conf
