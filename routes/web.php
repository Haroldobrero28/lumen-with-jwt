<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/login', 'AuthController@login');


$router->group(['middleware' => ['auth']], function () use ($router) {


    $router->get('/me', 'AuthController@me');


    $router->get('get_all_user', 'UserController@getAllUser');
    $router->get('get_user/{userId}', 'UserController@getUser');
    $router->patch('update_user/{userId}', 'UserController@updateUser');
    $router->post('create_user', 'UserController@createUser');
    $router->delete('delete_user/{userId}', 'UserController@deleteUser');




});

