# Imagen base vulnerable (Apache + PHP)
FROM php:7.4-apache

# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    unzip \
    curl \
    vim \
    wget \
    git \
    && docker-php-ext-install mysqli pdo pdo_mysql

# Habilitar mod_rewrite (típico en apps PHP antiguas)
RUN a2enmod rewrite

# Copiar aplicación vulnerable
WORKDIR /var/www/html
COPY vulnerable-app/ /var/www/html/

# Permisos inseguros para simular mala práctica
RUN chmod -R 777 /var/www/html

# Puerto expuesto
EXPOSE 80

# Iniciar Apache
CMD ["apache2-foreground"]
