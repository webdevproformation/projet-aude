# Docker

l’URL de la base de donnée ne se crée pas avec le nom que je lui ai donné (DB_NAME = dcat) mais avec le nom de l’utilisateur (DB_USER= root).Du coup, quand je crée ma BdD, elle porte le nom root.


# fichier docker-compose.yml

```yml
# à mettre ??  => OUI !
version: '3.1'
services:

  app:
    build: ./docker/app
    ports:
      - 8000:8000
    volumes:
      - ./code:/app
      - ./docker/app/php-custom.ini:/usr/local/etc/php/conf.d/php.ini
    working_dir: /app

  database:
    image: mysql
    ports:
      - 3306:3306
    volumes:
      - ./mysql:/var/lib/mysql
      - ./database:/app
    working_dir: /app
    environment:
      MYSQL_ROOT_PASSWORD: rootroot
      # https://hub.docker.com/_/mysql/
      MYSQL_DATABASE: blabla
      MYSQL_USER: toto
      MYSQL_PASSWORD: bonjour
    restart: always

  mongodb:
    image: mongo
    ports:
      - 27017:27017
    volumes:
      - ./mongodb:/data/db
    working_dir: /app
    environment:
      MONGO_INITDB_ROOT_USERNAME: root
      MONGO_INITDB_ROOT_PASSWORD: root
    restart: always
```

le fichier contient 3 services => il va créer 3 conteneurs 

# 1er service => app 

- builder un fichier Dockerfile 


```dockerfile
FROM php:8-fpm

# installer les modules de PHP
RUN apt update && apt upgrade -y
RUN apt install -y libicu-dev git zip
RUN docker-php-ext-install intl pdo_mysql
RUN apt install -y libcurl4-openssl-dev pkg-config libssl-dev

# installer un module pour que PHP puisse communiquer avec mongodb
RUN pecl install mongodb

# installer composer 
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" 
RUN php -r "if (hash_file('sha384', 'composer-setup.php')=== file_get_contents('https://composer.github.io/installer.sig')) {echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php 
RUN php -r "unlink ('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer

# installer symfony cli 
RUN curl -sS https://get.symfony.com/cli/installer | bash 
RUN mv /root/.symfony5/bin/symfony /usr/local/bin/symfony
```

# 2eme service => installer une première base données MySQL

