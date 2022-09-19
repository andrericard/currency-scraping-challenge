init:
	@cp .env.example .env
	@docker exec -u 1000 csc_php composer install
	@docker exec csc_php php artisan key:generate
	@make permissions

install:
	@docker exec -u 1000 csc_php composer install
	@docker exec csc_php php artisan key:generate

up:
	@docker-compose -f ../docker/docker-compose.yml -p csc up -d

down:
	@docker-compose -f ../docker/docker-compose.yml -p csc down

restart:
	@docker-compose -f ../docker/docker-compose.yml -p csc restart

reset:
	@docker-compose -f ../docker/docker-compose.yml -p csc down -v
	@docker-compose -f ../docker/docker-compose.yml -p csc up --build -d

permissions:
	@docker exec csc_php chown -cR 1000:33 ./bootstrap/cache/ ./storage/
	@docker exec csc_php chmod -cR 775 ./bootstrap/cache/ ./storage/

clear:
	@docker exec csc_php rm ./bootstrap/cache/*.php
	@docker exec csc_php php artisan optimize:clear

php:
	@docker exec -it -u 1000 csc_php bash

test:
	@docker exec -it -u 1000 csc_php php artisan test

tinker:
	@docker exec -it csc_php bash -c "while true; do php artisan tinker; done"
