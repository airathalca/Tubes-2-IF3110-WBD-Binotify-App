FROM php:8.0-apache
WORKDIR /var/www/html
COPY src/public/index.php .
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN a2enmod rewrite
RUN apt-get -y update && apt-get -y upgrade && apt-get install -y ffmpeg
EXPOSE 80