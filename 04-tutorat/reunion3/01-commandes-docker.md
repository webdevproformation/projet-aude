# quelques commandes

lister l'ensemble des conteneurs actifs sur mon ordinateur

```sh
docker ps -a 
```

lancer l'installation et le démarrage du service (conteneur) database 

```sh
docker compose up -d
```

- docker vérifie si l'image est dans mon ordinateur sinon  `docker pull mysql`
- docker lance l'image => conteneur `docker run -d --name mysql_exemple1 -p 3306:3306 -v ./mysql:/var/lib/mysql -v ./database:/app -e ... ` présentent dans le fichier .yml


```sh
docker ps -a 

CONTAINER ID   IMAGE     COMMAND                  CREATED         STATUS         PORTS                               NAMES
ecb39a36335e   mysql     "docker-entrypoint.s…"   4 minutes ago   Up 4 minutes   0.0.0.0:3306->3306/tcp, 33060/tcp mysql_exemple1
```

voir dans mon conteneur 

```sh
docker exec -it mysql_exemple1 sh

mysql --version
# mysql  Ver 9.3.0 for Linux on x86_64 (MySQL Community Server - GPL)

mysql -uroot -p
rootroot

SHOW DATABASES ;

+--------------------+
| Database           |
+--------------------+
| information_schema |
| mysql              |
| performance_schema |
| sys                |
+--------------------+
```

```sh
exit
exit 
```

changer mon fichier .yml ajouter de nouvelles propriétés

docker compose down
docker compose up -d --build



docker compose up -d

docker ps -a 

docker exec -it uniquement-mongo-mongodb-1 mongosh dcat

show dbs ;

use dcat ;

show collections ;

db.contacts.find().pretty() ;


-----

créer mes dossiers 
créer le fichier docker-compose.yml (adapté)

docker compose up -d 

docker exect -it my_symfony sh

composer install 

modifier le fichier .env 

DATABASE_URL="mysql://toto:toto@database:3306/toto?serverVersion=8.0.32&charset=utf8mb4"


docker exec -it my_symfony  sh

symfony console make:migration
symfony console d:m:m

exit 

docker exec -it my_mysql mysql -u root -p

symfony serve

