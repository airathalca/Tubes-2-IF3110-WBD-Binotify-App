FROM php:8.0-apache
WORKDIR /var/www/html
COPY src/index.php .
EXPOSE 80