This is Authentication with laravel 7 and Api  and make permission
firstly
1- laravel created users table and his model  for Authenticate
2-I created posts table and his model Post and do relations  to test permission
3-I used laravel Gate in permissions my Gate defined in app\Providers\AuthServiceProvider.php file
4-i made postController
5-i made follow method to make users follow  other in UserController
6-I used Gate in controller app\Http\Controllers\PostController.php
7-from manage gate i could control in post who can show and update and delete
8-made api_password middleware for auth app not user this not any app use my website
9-I used JWt for API
10- i made JWTMiddleware for auth with Jwt
11-created Api Controller for auth in app\Http\Controllers\Api\AuthController.php
12-created Api Controller for post in app\Http\Controllers\Api\PostController.php
13-i check gate in api controller
14-add routes to api route
15-test with postman app
in this file will find video to show work.
