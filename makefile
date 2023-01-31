init_project:
	composer install --no-interaction
	symfony console doctrine:migrations:migrate --no-interaction