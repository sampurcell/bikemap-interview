FROM php:7.2.8-cli-alpine3.7

RUN apk --update add \
  php7-pdo

RUN docker-php-ext-install pdo pdo_mysql

# Include composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy source code
WORKDIR /var/www
COPY . /var/www

# Install dependencies
RUN composer install

# Expose port
EXPOSE 3081

# Start the web server
CMD ["php", "-S", "0.0.0.0:3081", "-t", "public"]
