#!/bin/sh
git reset .
git checkout .
git checkout master
composer update
composer dump-autoload
php artisan migrate