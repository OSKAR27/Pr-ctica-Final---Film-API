mpweb-frameworks
================

create database filmapi
execute before 

composer install
php bin/console doctrine:schema:update --force
php bin/console server:run
