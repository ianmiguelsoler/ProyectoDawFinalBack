FROM debian
LABEL maintainer="ianmiguel@gmail.com"

RUN apt update && apt install -y apache2 php libapache2-mod-php php-yaml php-mysql
RUN a2enmod rewrite headers
CMD ["apachectl", "-D", "FOREGROUND"]
