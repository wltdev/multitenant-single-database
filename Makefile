build:
	docker compose build --no-cache --force-rm

stop:
	docker compose stop

down:
	docker compose down

up:
	docker compose up -d

composer-update:
	docker exec altis-php bash -c "composer update"

composer-install:
	docker exec altis-php bash -c "composer install"

migrate:
	docker exec altis-php bash -c "php artisan migrate"