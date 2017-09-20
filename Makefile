.PHONY: setup
setup:
	docker exec -it -u root am2compose_php_1 php bin/console doctrine:migration:migrate
	docker exec -it -u root am2compose_php_1 php bin/console doctrine:fixtures:load

.PHONY: bash
bash:
	docker exec -it -u root am2compose_php_1 bash

.PHONY: console
console:
	docker exec -it -u root am2compose_php_1 php bin/console

.PHONY: diff
diff:
	docker exec -it -u root am2compose_php_1 php bin/console doctrine:migration:diff

.PHONY: cache-clear
cache-clear:
	docker exec -it -u root am2compose_php_1 php bin/console cache:clear
	docker exec -it -u root am2compose_php_1 chmod -R 777 .

.PHONY: psql
psql:
	./psql

.PHONY: dump-psql
dump-psql:
	docker exec -i am2compose_db_1 pg_dump symfony2 > outfile

.PHONY: restore-psql
restore-psql:
	docker exec -i am2compose_db_1 psql symfony < infile

.PHONY: composer
composer:
	docker run --env-file php-variables.env --rm -v $(CURDIR):/app composer/composer install
