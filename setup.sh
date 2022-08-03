#!/bin/bash

mytitle="Some title"
echo -e '\033]2;'$mytitle'\007'

if [ ! -f composer.json ]; then
    echo "Please make sure to run this script from the root directory of this repo."
    exit 1
fi

echo "Install composer dependancy"
composer install
echo "Install npm dependancy"
npm install
echo "Create .env file"
cp .env.exemple .env
echo "Generate artisan key"
php artisan key:generate
echo "Migrate database"
artisan migrate

