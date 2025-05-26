#!/bin/bash


sleep 10

echo "Baza powinna być gotowa — uruchamiam migracje"
php artisan migrate --force

sleep 5 

echo "Migracja powinna zostać wykonana - uruchamiam seed"

php artisan migrate --seed