FROM php:8.1-apache
WORKDIR /var/www/html
RUN a2enmod rewrite
# Linux Libraries
RUN apt-get update -y && apt-get install -y \
    libicu-dev \
    libpq-dev \
    unzip \
    zip \
    zlib1g-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libgmp-dev
# Apache Configuration
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
# Change Apache listening port to 6061
RUN sed -i 's/Listen 80/Listen 6061/g' /etc/apache2/ports.conf
RUN sed -i 's/<VirtualHost \*:80>/<VirtualHost *:6061>/g' /etc/apache2/sites-available/000-default.conf
# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
# PHP Extensions
RUN docker-php-ext-install gettext intl pgsql pdo_pgsql gd gmp bcmath
RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd
# Clean up
RUN apt-get clean && rm -rf /var/lib/apt/lists/*
# Expose port 6061 
EXPOSE 6061 
