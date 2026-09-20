FROM php:8.2-apache
 
# Extensiones necesarias: mysqli para la conexión a BD
RUN docker-php-ext-install mysqli \
    && docker-php-ext-enable mysqli
 
# Habilitar mod_rewrite: ahora sí lo usamos para las URLs limpias del router
RUN a2enmod rewrite
 
# Permitir que el .htaccess del proyecto anule la configuración por defecto
# (por defecto Apache ignora los .htaccess con AllowOverride None)
RUN printf '<Directory /var/www/html>\n    AllowOverride All\n    Require all granted\n</Directory>\n' \
    > /etc/apache2/conf-available/allow-override.conf \
    && a2enconf allow-override
 
# Copiar el código de la aplicación al DocumentRoot de Apache
COPY . /var/www/html/
 
# Permisos razonables para Apache
RUN chown -R www-data:www-data /var/www/html
 
EXPOSE 80