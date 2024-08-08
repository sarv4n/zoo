# Zoo
Чтобы поднять проект запустите команды в следующем порядке:

 make build

 composer install (отказываемся от добавления базовых значений от doctrine)

 make up

Переходим в php-fpm 
 php bin/console doctrine-migration-migrate
