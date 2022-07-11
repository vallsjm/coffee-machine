HOST_USER_ID=$(shell id -u)
HOST_GROUP_ID=$(shell id -u)

##***********************************
##Coffee-Machine command management
##***********************************
## Coffee Machine is an awesome console application that from a few input parameters
## (drink type, amount of money, number of sugars, extra hot check) is capable to order a drink and show a cool message of the desired drink.
##

help:  ## Show this help.
	@fgrep -h "##" $(MAKEFILE_LIST) | fgrep -v fgrep | sed -e 's/\\$$//' | sed -e 's/##//'

##
install: ## build containers and install the composer dependencies
	docker-compose build --no-cache
	docker-compose up -d
	docker run --user=${HOST_USER_ID}:${HOST_GROUP_ID} --rm --interactive --tty --volume ${PWD}:/app composer $@

start: ## start docker containers
	docker-compose up -d

stop: ## stop docker containers
	docker-compose stop


##
composer-install: ## execute composer install
	docker run --user=${HOST_USER_ID}:${HOST_GROUP_ID} --rm --interactive --tty --volume ${PWD}:/app composer install
composer-update: ## execute composer-update
	docker run --user=${HOST_USER_ID}:${HOST_GROUP_ID} --rm --interactive --tty --volume ${PWD}:/app composer update
composer-require: ## execute composer-require ex. (make composer-require package="symfony/console")
	docker run --user=${HOST_USER_ID}:${HOST_GROUP_ID} --rm --interactive --tty --volume ${PWD}:/app composer require $(package)

##
console: ## execute command ex. (make console command="app:order-drink tea 0.5 1 -e")
	docker-compose run --user=${HOST_USER_ID}:${HOST_GROUP_ID} --rm php-cli php public/index.php $(command)

##
test: ## execute test
	docker-compose run --user=${HOST_USER_ID}:${HOST_GROUP_ID} --rm php-cli php vendor/bin/phpunit $(file)

analyze: ## analyze all code
	docker-compose run --user=${HOST_USER_ID}:${HOST_GROUP_ID} --rm php-cli php vendor/bin/phpstan analyse src/ --level=1

cs-fix: ## fix code
	docker-compose run --user=${HOST_USER_ID}:${HOST_GROUP_ID} --rm php-cli php vendor/bin/php-cs-fixer fix src/