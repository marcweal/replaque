<p align="center">
    <img alt="Replaque" src="https://i.ibb.co/LDyCz3Z/logo.png" width="400px">
</p>

## Introduction

Replaque is a web app used to maintain the [Blue plaques of Leeds](https://datamillnorth.org/dataset/blue-plaques-of-leeds).
This is done by maintaining a list of all the Blue plaques, along with a 
ticketing system, used to raise a request for a Plaque - which could be anything
from needing a clean, to needing repairs due to vandalism.

> A blue plaque is a permanent sign installed in a public place in the United 
> Kingdom and elsewhere to commemorate a link between that location and a famous 
> person or event, serving as a historical marker.

The app consists of a RESTful JSON API locked down with basic token 
authentication, accompanied by a JavaScript frontend used to interface with the
API.

## Links and resources

* [Laravel 5.8 documentation](https://laravel.com/docs/5.8)
* [Composer documentation](https://getcomposer.org/doc)
* [NPM documentation](https://docs.npmjs.com)
* [Blue plaques of Leeds dataset](https://datamillnorth.org/dataset/blue-plaques-of-leeds)
* [PHP Manual (7.3)](https://www.php.net/docs.php)

## Setup and installation

Depending on your chosen development environment, the setup and installation
slightly differs. Follow the one that matches what you picked:

### Docker

A Docker setup has been provided for you to ensure you have the infrastructure
you need for working on this project. To keep things simple, we have also
provided a helper script called `develop` to abstract the complexities of the 
Docker Compose CLI away from you. 

**This guide will only work on Mac or Linux. If you plan on using this on a 
different operating system, then please speak to a helper at the workshop.**

#### Spinning up the containers

When you first spin up the containers, it may take some time as it first needs
to download the images. You can do this as follows:

```bash
./develop up -d
```

When you need to stop the containers, run the following:

```bash
./develop down
```

> Note that whenever you stop and start the containers, the database will be
> reset to its initial state (with the seeded data).

#### Installing dependencies

Both PHP (Composer) and Node (NPM) dependencies need to be installed, with an
extra step for then compiling the static assets (JS and CSS):

```
./develop composer install

./develop npm install

./develop npm run dev
```

#### Generating an encryption key

Although not explicitly used in this app, Laravel needs one for things such as
encrypting sessions and cookies. You will first need to copy the example 
environment file, as that is where the encryption key will be stored: 

```bash
cp .env.example .env

./develop artisan key:generate
```

#### Running migrations and seeders

The database tables along with the Plaque data has already been provided, so you
only need to run the migration to create the tables and then the seeders to
populate the `plaques` table with the data:

```bash
./develop artisan migrate:fresh --seed
```

#### Accessing the API

You should now be able to access the API at [http://localhost](http://localhost)
and the API docs at [http://localhost/docs](http://localhost/docs).

### Cloud9

For guidance on setting up the environment on Cloud9, please speak to Crispin.

## Deploying

Deployment is done through [Heroku](https://www.heroku.com) whenever you
push a commit to the `master` branch.
