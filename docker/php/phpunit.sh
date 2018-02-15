#!/bin/bash

rm -rf /build
cp -rf . /build
cd /build
composer update
vendor/bin/phpunit --coverage-html=/var/www/html