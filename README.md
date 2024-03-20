# Technical test

## Setting up the project

```bash
make up # setup docker containers
make enter # enter php container
composer install # install dependencies
php bin/console doctrine:migrations:migrate # Run database migration
php bin/console messenger:consume user_created # Run the worker
```

## Application

The app can be tested using curl or postman

```bash
curl --location 'localhost/users' \
--header 'Content-Type: application/json' \
--data-raw '{
    "email": "elamrikacem@gmail.com",
    "firstName": "Kacem",
    "lastName": "EL AMRI"
}'
```
## Tools

RabbitMQ Dashboard is accessible here : http://localhost:15672/ (user: guest, pass: guest)
Adminer is accessible here : http://localhost:8080/
