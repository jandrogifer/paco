FROM php:8.3-fpm

# Instalar extensiones necesarias para MariaDB/MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Exponer el puerto de PHP-FPM
EXPOSE 9000
