# GAMESITES PAYMENT LIBRARY

## Installation
Coming soon ...

## RUN TEST
Firs run `docker-compose up -d`. Next you should to install composer by `docker exec -it php-payment composer install`

### CodeSniffing
To check code standards and find some specific errors run 
`docker exec -it php-payment bin/phpcs --standard=PSR12 --colors -p -n src/`

### PHPUnit
Run `docker exec -it php-payment bin/phpunit`