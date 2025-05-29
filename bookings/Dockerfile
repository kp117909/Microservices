FROM php:8.2-apache

# Instalacja zależności
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev zip git curl unzip nodejs npm supervisor inotify-tools \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql \
    && rm -rf /var/lib/apt/lists/*
    

# Zainstaluj PHP Redis (PECL)
RUN pecl install redis \
    && docker-php-ext-enable redis


# Włączenie mod_rewrite dla Apache
RUN a2enmod rewrite

# Ustawienie katalogu roboczego
WORKDIR /var/www

# Kopiowanie plików aplikacji
COPY . .

# Kopiowanie konfiguracji Apache i Supervisord
COPY ./apache2/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY ./supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Instalacja Composer
COPY composer.json composer.lock ./
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader

# Instalacja Node.js, Vite i zależności frontendowych
RUN npm install
RUN npm install vite laravel-vite-plugin

# Ustawienie właściciela plików
RUN chown -R www-data:www-data /var/www

# Expose portów (80 - Apache, 5176 - Vite)
EXPOSE 80 5176

# # Kopiuj entrypoint.sh do obrazu
# COPY entrypoint.sh /entrypoint.sh
# RUN chmod +x /entrypoint.sh

# # Ustaw entrypoint
# ENTRYPOINT ["/entrypoint.sh"]

# Uruchomienie supervisora
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
