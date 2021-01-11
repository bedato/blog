# Blog RESTful API

## Summary
My approach to create a RESTful API with Laravel with the repository pattern. __This is not a finished product. This is only to showcase my approach to a scalable Laravel RESTful API which i used in places i worked with Laravel.__

## Setup and Requirements
**Required Laravel Sail installation (https://laravel.com/docs/8.x/sail#installation). Docker is required.**

- Start container in your terminal with `./vendor/bin/sail up`
- Check App by accessing localhost in your browser
- Enter container with `docker exec -it blog_laravel.test_1 bash`
- Migrate and Seed Database with the artisan command `php artisan db:migrate --seed`
- Access Database from the credentials in the .env file (if you don't have the .env file contact me please)

## Access /posts endpoint

Endpoints:
    
    `/posts` (Available Requests: GET, POST, DELETE)

Request Headers: 
    
    `X-Request-Timestamp` -> `{{timestamp}}`
    `X-Access-Token` -> get it from the database from table `merchants` -> `api_token`
    
HTTP Request
    `GET` URL: `localhost/posts`
    
Response:
```json
`{
    "data": [
        {
            "id": 1,
            "title": "this",
            "author": "John",
            "excerpt": "lorem",
            "content": "asdfasdf",
            "image_url": "asdfasd.jpg",
            "is_featured": 0,
            "created_at": "2021-01-03 23:10:04",
            "updated_at": "2021-01-03 23:10:04"
        },
    ],
    "links": {
        "first": "http://localhost/api/posts?page=1",
        "last": "http://localhost/api/posts?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://localhost/api/posts?page=1",
                "label": 1,
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://localhost/api/posts",
        "per_page": 15,
        "to": 3,
        "total": 3,
        "results": 3,
        "method": "GET",
        "endpoint": "/api/posts"
    },
    "success": true,
    "errors": {},
    "duration": 0.09195780754089355
}`
```

-----------------------------------------------

Request Headers: 

    `X-Request-Timestamp` -> `{{timestamp}}`
    `X-Access-Token` -> get it from the database from table `merchants` -> `api_token`
    `X-User-Code` -> get it from the database from table `users` -> `user_code`
    
HTTP Request

    `POST localhost/posts`
    
Body
```json
`{
"author": "John",
"title": "this",
"excerpt": "lorem",
"content": "asdfasdf",
"image_url": "asdfasd.jpg",
"is_featured": false
}`
```
    
Response: `Post created successfully`


-----------------------------------------------

Request Headers: 

    `X-Request-Timestamp` -> `{{timestamp}}`
    `X-Access-Token` -> get it from the database from table `merchants` -> `api_token`
    `X-User-Code` -> get it from the database from table `users` -> `user_code`
    
HTTP Request

   `DELETE localhost/posts/{id}`

Response: `Post Deleted Successfully`

   
    

