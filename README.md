# Zoo
Чтобы поднять проект запустите команды в следующем порядке:

 make build

 composer install (отказываемся от добавления базовых значений от doctrine)
 Убедитесь что при установке orm doctrine не обновился DATABASE_URL в .env файле 
 
 make up

Переходим в php-fpm 
 php bin/console doctrine-migration-migrate

Рут калькулятора:
http://localhost:8085/shipping/price-calculator
