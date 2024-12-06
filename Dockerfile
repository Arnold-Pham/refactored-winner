# Étape 1: Utiliser une image PHP avec Apache de base
FROM php:8.2-apache

# Étape 2: Installer les extensions PHP nécessaires pour MySQL et PDO
RUN docker-php-ext-install pdo pdo_mysql

# Étape 3: Installer Composer pour gérer les dépendances PHP (optionnel, mais souvent utile)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Étape 4: Copier le code source dans le répertoire de travail du conteneur
COPY ./src /var/www/html/

# Étape 5: Exposer le port 80 pour accéder à l'application
EXPOSE 80

# Étape 6: Lancer Apache en mode avant-plan pour que le conteneur reste actif
CMD ["apache2-foreground"]
