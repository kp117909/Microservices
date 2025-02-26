# Wybór oficjalnego obrazu PHP z Apache
FROM php:8.2-apache

# Ustawienie katalogu roboczego
WORKDIR /var/www/html


# Instalacja wymaganych rozszerzeń PHP
RUN apt-get update && apt-get install -y \ 
    libpng-dev \ 
    libjpeg-dev \ 
    libfreetype6-dev \ 
    nano \ 
    && docker-php-ext-configure gd --with-freetype --with-jpeg \ 
    && docker-php-ext-install gd pdo pdo_mysql

    
# Włącz mod_rewrite
RUN a2enmod rewrite

RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Skopiowanie plików aplikacji do kontenera
COPY . /var/www/html

# Instalacja Composera
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install

# Ustawienie uprawnień
RUN chown -R www-data:www-data /var/www/html

# Restart Apache
CMD ["apache2-foreground"]
