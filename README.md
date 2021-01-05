# Blog RESTful API

## Summary
My approach to create a RESTful API with Laravel with the repository pattern. __This is not a finished product. This is only to showcase my approach to a scalable Laravel RESTful API.__

## Setup and Requirements
**Required Laravel Sail installation (https://laravel.com/docs/8.x/sail#installation). Docker is required.**

- Start container in your terminal with `./vendor/bin/sail up`
- Check App by accessing localhost in your browser
- Enter container with `docker exec -it blog_laravel.test_1 bash`
- Migrate and Seed Database with the artisan command `php artisan db:migrate --seed`

## Access /posts endpoint

Headers:

