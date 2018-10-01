#!/bin/bash
#
# Download PHPUnit: https://phpunit.de/getting-started/phpunit-7.html

wget -O phpunit https://phar.phpunit.de/phpunit-7.phar
chmod +x phpunit
./phpunit --version
