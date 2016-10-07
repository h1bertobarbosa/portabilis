#!/bin/bash

sudo service nginx restart
sudo service php7.0-fpm restart
sudo chown -R deploy:deploy /var/www/portabilis
sudo chmod -R 775 /var/www/portabilis


composer global require "hirak/prestissimo:^0.3"
cd /var/www/portabilis && php artisan migrate --seed

echo ""
echo "-----------------------------"
echo "Máquina pronta para Trabalhar"
echo "-----------------------------"
echo ""

exec "$@"
