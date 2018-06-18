#!/bin/bash

# We need to install dependencies only for Docker
[[ ! -e /.dockerenv ]] && exit 0

set -xe

docker-php-ext-enable zip gd

cp ci/php.ini /usr/local/etc/php/php.ini

# Installs Sensiolabs security checker to check against unsecure libraries
php -r "readfile('http://get.sensiolabs.org/security-checker.phar');" > /usr/local/bin/security-checker
chmod +x /usr/local/bin/security-checker

composer global require 'hirak/prestissimo'

composer global require 'phpmetrics/phpmetrics' ^2.0

composer global require friendsofphp/php-cs-fixer

cd /root
composer create-project thecodingmachine/washingmachine --stability=dev
cd -

composer install

docker-php-ext-enable xdebug # Used for code coverage statistics

