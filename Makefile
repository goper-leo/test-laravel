ifndef times
override times = 1
endif

setup:
	composer install
	php artisan key:generate
	make authorize
	php artisan migrate --seed
	php artisan storage:link

authorize:
	sudo chmod -R 777 ./storage/
	sudo chmod -R 777 ./storage/logs/
	sudo chmod -R 777 ./storage/framework/
	sudo chmod -R 777 ./storage/framework/cache/
	sudo chmod -R 777 ./storage/framework/cache/data/
	sudo chmod -R 777 ./vendor/
	sudo chmod -R 777 ./bootstrap/cache/
	sudo chmod -R 777 ./public/avatar/
	composer dump-autoload

refresh:
	make cache_clear
	make cache	

cache:
	php artisan config:cache
	php artisan view:cache
	php artisan route:cache

cache_clear:
	php artisan config:clear
	php artisan cache:clear
	php artisan view:clear
	php artisan route:clear
	composer dump-autoload

test:
	./vendor/bin/phpunit ./tests/Feature/. --repeat ${times}

testSpecific:
	./vendor/bin/phpunit --filter ${class} tests/Feature/${path} --repeat ${times}