FROM library/php:8.0-apache

RUN apt-get update && apt-get install -y \
    git \
    zip

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN a2enmod rewrite headers

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /app
