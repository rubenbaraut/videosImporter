##### INSTALLATION STEPS

The project is running with Docker. In order to create the containers and install all the dependecies you must execute these command line orders.

```
docker-compose build
docker-compose up -d
docker exec -ti php-cmp composer install
```

##### RUN TESTS

Running the test and reading them is the best way to understand what is doing the project.

```
docker exec -ti php-cmp ./vendor/phpunit/phpunit/phpunit
```

##### RUN APPLICATION

In order to import the current file of a provider you need to execute following instruction, changing the name of the provider. Currently we have only two providers (flub and glorf).

```
docker exec -ti php-cmp php src/main.php providerName
```

For example
```
docker exec -ti php-cmp php src/main.php flub
docker exec -ti php-cmp php src/main.php glorf
```

##### TESTS FRAMEWORK

In order to mock properly the infrastucture Repositories, I've used Mockery.

##### FEATURES PENDING FOR FUTURE RELEASES

- Add a dependency injection tool
- Add a CommandBus
- Sanitize parser, in order to prevent security issues. (For ex: SQL Injections)
- Add Stubs for all the domain objects.
- Find a better way to work with input files inside Tests. Now I'm using feed-exports files for test and for "production", and it must be separated. In the tests pass a string representing the file, and not use the real files
- Add an Enum vendor, to more control with feedTypes (yml,json)
