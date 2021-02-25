docker-compose up -d --build

docker exec -it php /bin/sh

composer install

bin/console doctrine:migrations:migrate

bin/console doctrine:database:import migrations/bootstrap.sql 

php bin/phpunit
