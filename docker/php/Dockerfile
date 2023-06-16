# Utiliser une image de base contenant PHP et Apache
FROM php:8.2-apache
RUN apt update
RUN apt install -y git
RUN docker-php-ext-install pdo pdo_mysql && docker-php-ext-enable pdo_mysql
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1
WORKDIR /root
RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony5/bin/symfony /usr/local/bin/symfony
WORKDIR /app
COPY . .
RUN composer install
EXPOSE 8000
CMD ["symfony", "serve"]