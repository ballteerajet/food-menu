#!/bin/bash

# Install Composer
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer

# Install PHP dependencies
composer install --no-dev --optimize-autoloader
