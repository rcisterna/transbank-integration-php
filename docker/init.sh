#!/usr/bin/env bash
php /var/www/html/artisan migrate && apache2-foreground
