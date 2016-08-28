#!/usr/bin/env bash

# Go install a LAMP stack
apt-get update
apt-get -y install apache2
apt-get -y install curl libcurl3 libcurl3-dev

debconf-set-selections <<< 'mysql-server mysql-server/root_password password mypass'
debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password mypass'
apt-get -q -y install mysql-server

apt-get -y install php7.0 php7.0-fpm php7.0-cli php7.0-curl php7.0-json php7.0-gd php7.0-mysql libapache2-mod-php
echo 'PHP installed'

# Database and import data...
mysql -h localhost -u root -pmypass -e "CREATE DATABASE tgc_db"

# Enable modrewrite because we can
a2enmod rewrite
# sed -i '/AllowOverride None/c AllowOverride All' /etc/apache2/sites-available/default

service apache2 restart

echo 'And away we go...'
