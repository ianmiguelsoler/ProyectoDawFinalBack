FROM debian
LABEL maintainer="ianmiguel@gmail.com"

# Instalar Apache, PHP y dependencias necesarias
RUN apt update && apt install -y apache2 php libapache2-mod-php php-mysql php-yaml curl

# Habilitar módulos de Apache
RUN a2enmod rewrite headers

# Copiar la configuración del VirtualHost
COPY apache-dev.conf /etc/apache2/sites-available/000-default.conf

# Habilitar el VirtualHost
RUN ln -sf /etc/apache2/sites-available/000-default.conf /etc/apache2/sites-enabled/000-default.conf

# Exponer el puerto 80
EXPOSE 80

# Iniciar Apache en primer plano
CMD ["apachectl", "-D", "FOREGROUND"]
