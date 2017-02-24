#!/bin/sh
if [ ! -f composer.phar ]; then
    wget https://raw.githubusercontent.com/composer/getcomposer.org/5fd32f776359b8714e2647ab4cd8a7bed5f3714d/web/installer -O - -q | php -- --quiet
fi
php composer.phar install
bin/console assets:install --symlink
bin/console assetic:dump -e prod

bin/console doc:sch:create; bin/console doc:sch:update --force && bin/console doc:migr:version --add --all --no-interaction
