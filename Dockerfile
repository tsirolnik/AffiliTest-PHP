FROM debian:9
RUN apt-get update && apt-get install -y \ 
    curl \
    apache2 \
    php \
    php-curl \
    php-sqlite3 \
    php-mcrypt \
    php-mysql \
    php-fpm  \
    libapache2-mod-php \
    git

RUN a2enmod php7.0
RUN a2enmod rewrite

RUN rm /var/www/html/*

# Set ownership to www-data user
RUN mkdir /opt/composer
RUN chown -R www-data:www-data /var/www
RUN chown -R www-data:www-data /opt/composer


WORKDIR /var/www/html/

# Run as www-data
USER www-data

RUN echo "service apache2 start && tail -f /dev/null" > /opt/composer/run.sh

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"

COPY . /var/www/html

ENV COMPOSER_HOME /opt/composer
RUN php composer.phar install

EXPOSE 80

USER root
CMD ["/bin/bash", "/opt/composer/run.sh"]