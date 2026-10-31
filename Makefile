.PHONY: install test up assets watch reset down bash console shadcn-update

DC = docker compose
PHP = $(DC) exec php

## Demo application (tests/Application) on http://localhost:8080/admin (admin / admin)
up:
	$(DC) up -d --build
	@echo "\n  ➜ http://localhost:8080/admin  (admin / admin)\n"

install:
	$(PHP) composer install

test:
	$(PHP) vendor/bin/phpunit

assets:
	$(PHP) tests/Application/bin/console importmap:install
	$(PHP) tests/Application/bin/console tailwind:build

# Rebuilds the stylesheet whenever a template of the bundle or of the demo changes
watch:
	$(PHP) tests/Application/bin/console tailwind:build --watch

reset:
	$(PHP) tests/Application/bin/console app:load-books

down:
	$(DC) down

bash:
	$(PHP) bash

console:
	$(PHP) php tests/Application/bin/console $(c)

# Updates the bundled shadcn kit recipes (all of them, or r="button dialog"), then review the git diff
shadcn-update:
	$(PHP) tests/Application/bin/console app:shadcn:update $(r)

cs-fix:
	$(PHP) php vendor/bin/php-cs-fixer fix

twig-fix:
	$(PHP) php vendor/bin/twig-cs-fixer --fix
