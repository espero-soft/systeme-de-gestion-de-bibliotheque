# Utiliser l'image officielle PHP avec Apache
FROM php:apache

# Installer les extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    php8.2-mysql \
    php8.2-cli \
    php8.2-fpm \
    php8.2-json \
    php8.2-common \
    php8.2-mbstring \
    php8.2-xml \
    php8.2-zip \
    php8.2-gd \
    php8.2-curl \
    && apt-get clean

# Activer le module mod_rewrite d'Apache
RUN a2enmod rewrite

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier le contenu du répertoire courant dans le conteneur à /var/www/html
COPY . /var/www/html

# Définir les permissions appropriées
RUN chown -R www-data:www-data /var/www/html

# Mettre à jour la configuration d'Apache pour permettre les fichiers .htaccess
RUN sed -i 's/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Exposer le port 80
EXPOSE 80

# Démarrer le serveur Apache
CMD ["apache2-foreground"]