FROM php:8-fpm

# install divers 
RUN apt update && apt upgrade -y
RUN apt install -y libicu-dev git zip vim git

# php
# RUN docker-php-ext-install intl pdo_mysql 
RUN docker-php-ext-install intl pdo_mysql opcache
RUN apt install -y libcurl4-openssl-dev pkg-config libssl-dev
# RUN pecl install mongodb
RUN pecl install apcu
RUN docker-php-ext-enable apcu

# php.ini apcu
# https://olvlvl.com/2019-06-install-php-ext-source.html
RUN echo '\
apc.enabled=1\n\
apc.ttl=0\n\
apc.enable_cli = O\n\
apc.enable_cli=1\n\
apc.shm_size=128M\n\
apc.gc_ttl=3600\n\
apc.entries_hint=4096\n\
' >> /usr/local/etc/php/conf.d/docker-php-ext-apcu.ini

# php.ini opcache
# https://laravel-news.com/php-opcache-docker
RUN echo '\
opcache.enabled=1\n\
opcache.enable_cli = 1\n\
opcache.memory_consumption=512\n\
opcache.max_accelerated_files=7963\n\
opcache.validate_timestamps=1\n\
opcache.revalidate_freq=60\n\
opcache.interned_strings_buffer=16\n\
opcache.load_comments=Off\n\
opcache.save_comments=Off\n\
' >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini

RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini


# custom php.ini

COPY ./php-custom.ini /usr/local/etc/php/conf.d/php-custom.ini

# composer 
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" 
RUN php -r "if (hash_file('sha384', 'composer-setup.php')=== file_get_contents('https://composer.github.io/installer.sig')) {echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php 
RUN php -r "unlink ('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer

# symfony cli
RUN curl -sS https://get.symfony.com/cli/installer | bash 
RUN mv /root/.symfony5/bin/symfony /usr/local/bin/symfony


EXPOSE 80