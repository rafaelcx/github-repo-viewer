# Github Repo Viewer

A Laravel application that integrates with Github API to fetch and manipulate information about it's many repositories.

## Usage

To get started, make sure you have [Docker](https://docs.docker.com/docker-for-mac/install/) and [Composer](https://getcomposer.org/download/) on your system, and then clone this repository.

Once the repo is clone successfully:

-  `docker-compose up --build -d`
-  `docker-compose run --rm composer install`

Now you need to create a copy of the `.env.example` called `.env` where you can modify database credentials as you see fit.
The default values to get this application running are:

```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

-  `docker-compose run --rm artisan key:generate`
-  `docker-compose run --rm artisan migrate`

You should be able to see this Laravel application running at you http://localhost:8080.

There are three containers that handle Composer, NPM, and Artisan commands without having to have these platforms installed on your local computer. Use the following command templates from your project root, modifiying them to fit your particular use case:

- `docker-compose run --rm composer update`
- `docker-compose run --rm npm run dev`
- `docker-compose run --rm artisan migrate` 

Created Containers and their ports (if used) are as follows:

- **nginx** - `:8080`
- **mysql** - `:3306`
- **php** - `:9000`
- **npm**
- **composer**
- **artisan**

## Persistent MySQL Storage

By default, whenever you bring down the docker-compose network, your MySQL data will be removed after the containers are destroyed. If you would like to have persistent data that remains after bringing containers down and back up, do the following:

1. Create a `mysql` folder in the project root, alongside the `nginx` and `src` folders.
2. Under the mysql service in your `docker-compose.yml` file, add the following lines:

```
volumes:
  - ./mysql:/var/lib/mysql
```
