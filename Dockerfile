FROM php:8.0-apache
WORKDIR /var/www/html
COPY src/public/index.php .
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN a2enmod rewrite
EXPOSE 80