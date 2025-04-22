# synthese

01-code => code source de symfony
01-infra-code => Dockerfile qui permet de créer la partie php de l'ensemble
02-mysql => partage pour stocker tes données mySQL
03-mongo => partage pour stocker tes données + script.js (jeux données par défaut)

docker-compose.yml
décrire l'ensemble des conteneurs de ton projet 


Ajoute

=> ajouter plusieurs services (conteneur) dans le fichier docker-compose.yml

- 1 serveur => la machine nginx => (point d'entrée de ton application)
    besoin d'un fichier de configuration nginx.conf => root /var/www/html/public; 
    appeler le fichier de départ de ton projet 

- 2 php  => communication via le port 9000 entre serveur nginx et php-fpm
    dockerfile 
        avec des modules activé => opcache / apcu / xdebug 

- 3 base de données mysql 
        qui va communiquer avec PHP via le fichier .env de php

        DATABASE_URL="mysql://toto:toto@database:3306/toto?serverVersion=8.0.32&charset=utf8mb4"

- 4 base de données mongodb 

- service GUI http://localhost:8081 => voir ce qu'il se passe dans mysql
    Serveur : database
    Utilisateur : toto
    Mot de passe : toto
    Base de données : toto
- service GUI mongo  http://localhost:8082 => voir ce qu'il se passe dans mongo
    login : user
    password : user
- service email 1080 => http://localhost:1080

    
