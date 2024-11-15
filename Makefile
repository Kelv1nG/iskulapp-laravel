setup:
	@make build
	@make up 
	@make composer-install
	@make generate-keys
	@make refresh-db 

build:
	docker compose build --no-cache --force-rm

stop:
	docker compose stop

up:
	docker compose up -d

composer-install:
	docker exec -u root school-erp-backend bash -c "composer install"

composer-update:
	docker exec -u root school-erp-backend bash -c "composer update"

migrate-seed:
	docker exec -u root school-erp-backend bash -c "php artisan migrate"
	docker exec -u root school-erp-backend bash -c "php artisan migrate --path=database/migrations/powersync_publication"
	docker exec -u root school-erp-backend bash -c "php artisan db:seed"

refresh-db:
	docker exec -u root school-erp-backend bash -c "php artisan migrate:fresh"
	docker exec -u root school-erp-backend bash -c "php artisan migrate --path=database/migrations/powersync_publication"
	docker exec -u root school-erp-backend bash -c "php artisan db:seed"

generate-keys:
	docker exec -u root school-erp-backend bash -c "php artisan key:generate"
	docker exec -u root school-erp-backend bash -c "php artisan passport:keys --force"

artisan:
	@docker exec school-erp-backend bash -c "php artisan $(ARGS)"

bash:
	@docker exec -u root -it school-erp-backend bash

.PHONY: artisan
