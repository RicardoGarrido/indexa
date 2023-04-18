
# Gridlock with laravel 


This is a simple [Laravel](https://laravel.com/docs/8.x) application created with its built-in
solution [Sail](https://laravel.com/docs/8.x/sail) for running your Laravel project
using [Docker](https://www.docker.com/).


## Requirements for building and running the application 

- [Composer](https://getcomposer.org/download/)
- [Docker](https://docs.docker.com/get-docker/)

## Application Build and Run

After cloning the repository get into the root directory and run:

`composer install`

`cp .env.example .env`

`./vendor/bin/sail up`

## Then finally test the application

In order to test the aplication, first you need to came inside the  sail-8.2/app container if you are using docker, execute:

`docker ps`

Once you have located the container that uses the image sail-8.2/app, copy its ID and execute the following command:

`docker exec -it {{ID}} /bin/bash`

Once in the container execute `php artisan test` and let magic flow.

Besides the required functionalities, some additional features have been added, such as the ability to move blocks, also tested in the unit test block.

## Observations

- The Board class has been created and its size has been limited to more accurately adapt to the original game. Additionally, Board contains a matrix that represents the game squares to more efficiently calculate collisions and avoid the need to evaluate each block one by one.





<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>
