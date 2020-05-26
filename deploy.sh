#Run Database Migrations

# php artisan config:cache
#  php artisan migrate --force
php artisan cache:clear 
php artisan config:clear
php artisan config:cache
 php artisan migrate:refresh --seed --force
# php artisan migrate:fresh --seed 

#Run Seeds

# php artisan db:seed 