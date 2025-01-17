# Use the official PHP image with Apache
FROM php:apache

# Install necessary PHP extensions
RUN apt-get update && apt-get install -y \
    php-mysql \
    php-cli \
    php-fpm \
    php-json \
    php-common \
    php-mbstring \
    php-xml \
    php-zip \
    php-gd \
    php-curl \
    && apt-get clean

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set the working directory
WORKDIR /var/www/html

# Copy the current directory contents into the container at /var/www/html
COPY . /var/www/html

# Set the appropriate permissions
RUN chown -R www-data:www-data /var/www/html

# Update the Apache configuration to allow .htaccess files
RUN sed -i 's/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Expose port 80
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]