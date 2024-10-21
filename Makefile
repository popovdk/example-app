#!make
ifneq (,$(wildcard ./.env))
    include .env
    export
endif

PORT=9095
APP_NAME=example-app

build-builder:
	docker build \
		--file "./docker/app-builder/Dockerfile" \
		--tag "app-builder" \
		"." --no-cache

build-nginx:
	docker compose -f compose.build.yml build nginx --progress=plain --no-cache
build-app:
	docker compose -f compose.build.yml build app --progress=plain --no-cache


build:
	$(MAKE) build-builder
	$(MAKE) build-app
	$(MAKE) build-nginx

deploy:
	docker compose -f compose.prod.yml up -d --force-recreate --remove-orphans

up:
	$(MAKE) build
	$(MAKE) deploy

down:
	docker compose -f compose.prod.yml down

# tools

exec-app:
	docker exec -it ${APP_NAME}-app sh

migrate:
	docker exec ${APP_NAME}-app php artisan migrate --force --no-interaction
