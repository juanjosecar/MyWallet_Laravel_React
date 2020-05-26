#Run Database Migrations

# php artisan config:cache
#  php artisan migrate --force
php artisan migrate:refresh --seed --force

#Run Seeds

# php artisan db:seed 