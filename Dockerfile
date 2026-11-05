FROM php:8.2-apache

# Mengatur timezone sistem
ENV TZ=Asia/Jakarta
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Mengatur timezone di php.ini secara permanen
RUN echo "date.timezone = \"Asia/Jakarta\"" > /usr/local/etc/php/conf.d/timezone.ini

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN a2enmod rewrite headers expires deflate

WORKDIR /var/www/html

COPY . /var/www/html

COPY apache.conf /etc/apache2/conf-enabled/custom.conf

COPY mpm_prefork.conf /etc/apache2/mods-enabled/mpm_prefork.conf

COPY opcache.ini /usr/local/etc/php/conf.d/opcache.ini

RUN rm -f /var/www/html/apache.conf
RUN rm -f /var/www/html/mpm_prefork.conf
RUN rm -f /var/www/html/opcache.ini

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80