# FROM php:8.2-apache
FROM php:8.1-fpm
WORKDIR /var/www/html
RUN docker-php-ext-install mysqli pdo pdo_mysql
# RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

RUN chown -R www-data:www-data /var/www/html \
&& chmod -R 755 /var/www/html

EXPOSE 9000

# Jalanin PHP-FPM di foreground
CMD ["php-fpm"]