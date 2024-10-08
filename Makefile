setup:
	@make build
	@make up 
	@make composer-install
	@make migrate-seed 
	@make generate-keys

build:
	docker-compose build --no-cache --force-rm

stop:
	docker-compose stop

up:
	docker-compose up -d

composer-install:
	docker exec school-erp-backend bash -c "composer install"

migrate-seed:
	docker exec school-erp-backend bash -c "php artisan migrate"
	docker exec school-erp-backend bash -c "php artisan db:seed"
	docker exec school-erp-backend bash -c "php artisan migrate --path=database/migrations/powersync_publication"

refresh-db:
	docker exec school-erp-backend bash -c "php artisan migrate:fresh --seed"
	docker exec school-erp-backend bash -c "php artisan migrate --path=database/migrations/powersync_publication"

generate-keys:
	docker exec school-erp-backend bash -c "php artisan key:generate"
	docker exec school-erp-backend bash -c "php artisan passport:keys --force"


artisan:
	@docker exec school-erp-backend bash -c "php artisan $(ARGS)"

.PHONY: artisan
