#!/bin/sh
set -e

# first arg is `-f` or `--some-option`
if [ "${1#-}" != "$1" ]; then
	set -- php-fpm "$@"
fi

if [ "$1" = 'php-fpm' ] || [ "$1" = 'bin/console' ]; then
    composer dump-autoload --optimize --no-dev --classmap-authoritative
    composer install --prefer-dist --no-progress --no-suggest --no-interaction --optimize-autoloader

    #update database
    #bin/console doctrine:migrations:migrate

	# Permissions hack because setfacl does not work on Mac and Windows
	chown -R www-data var
fi

exec docker-php-entrypoint "$@"