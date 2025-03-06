FROM php:8.2-apache

# Instalacja zależności
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev zip git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

# Włączenie mod_rewrite dla Apache
RUN a2enmod rewrite

# Skopiowanie plików aplikacji do katalogu roboczego
WORKDIR /var/www
COPY . .

# Skopiowanie pliku konfiguracyjnego Apache
COPY ./apache2/000-default.conf /etc/apache2/sites-available/000-default.conf

# Instalacja Composer
COPY composer.json composer.lock ./
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader

# Zmienienie właściciela plików
RUN chown -R www-data:www-data /var/www
# Ustawienie portu
EXPOSE 80

# Uruchomienie Apache
CMD ["apache2-foreground"]
