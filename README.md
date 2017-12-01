Q & A DDD
===

Sample Q & A RESTful application written with DDD approach. It's my first take on DDD, so the app is definitely not ideal for reference.

Prerequisites
---

  * PHP > 7.1
  * Composer
  * MySQL (or any Doctrine DBAL compatible DB - requires config adjustment)

Installation
---

Clone the project, change directory and run:
```shell
    $ composer install --dev
```

During installation you will be asked for database connection details. Make sure that the database that you use is already created. If not you can run:

```shell
    $ php bin/console doctrine:database:create
```

Creating DB schema:
```shell
    $ php bin/console doctrine:schema:create
```

All the dependencies will be downloaded and the application is ready to run.

Run the app
---

```
    $ php bin/console server:run 8000
```

The application is now ready to serve requests on localhost:8000.

API documentation
---
Once the application is running you can access the API documentation at:
```
    localhost:8000/doc
```

The documentation can also serve as a sandbox to try endpoints.

Testing
---

To run the test suite run:
```shell
    $ ./vendor/bin/phpunit -c phpunit.xml.dist
```
