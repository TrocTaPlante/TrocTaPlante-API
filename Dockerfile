FROM php:8.2-cli

# Setup container
RUN apt update
RUN apt install -y git curl zip unzip libcurl4-openssl-dev libzip-dev
RUN docker-php-ext-install pdo pdo_mysql curl zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1

# Install Symfony CLI
WORKDIR /root
RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

# Setup project
WORKDIR /app
COPY . .
RUN composer install
RUN symfony console lexik:jwt:generate-keypair
EXPOSE 8000
CMD ["symfony", "serve"]