install:
	docker-compose up -d
	composer install
	npm install
	yarn install
	yarn encore dev --watch
	php bin/console doctrine:database:drop --force
    php bin/console doctrine:database:create
    php bin/console doctrine:schema:update --force
    php bin/console doctrine:fixtures:load
