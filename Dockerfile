FROM php:8.2-fpm

USER root
RUN apt-get update \
    && apt-get install -y libpq-dev libzip-dev zip git postgresql-client \
    && pecl uninstall xdebug  true \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN docker-php-ext-install pdo pdo_pgsql exif zip

RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

RUN groupadd -r myuser  true \
    && useradd -r -g myuser -m myuser || true

COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html/

USER myuser

EXPOSE 9000

CMD ["php-fpm"]