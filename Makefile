init: docker-down-clear docker-pull docker-build-pull docker-up app-init
down: docker-down-clear
lint: app-lint
test: test-unit test-functional
check: lint test
test-unit: app-test-unit
test-functional: app-test-functional

docker-up:
	docker-compose up -d

docker-down-clear:
	docker-compose down -v --remove-orphans

docker-pull:
	docker-compose pull

docker-build-pull:
	docker-compose build --pull

app-init: composer-install app-permissions

composer-install:
	docker-compose run --rm php-cli composer install

app-permissions:
	docker run --rm -v ${PWD}:/app -w /app alpine chmod 777 var/cache

composer-update:
	docker-compose run --rm php-cli composer update

app-lint:
	docker-compose run --rm php-cli composer lint

app-test-unit:
	docker-compose run --rm php-cli composer test -- --testsuite=Unit

app-test-functional:
	docker-compose run --rm php-cli composer test -- --testsuite=Functional
