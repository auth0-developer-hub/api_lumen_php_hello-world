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

$router->group(['prefix' => 'messages'], function ($router) {
    $router->get('public', 'MessagesController@showPublicMessage');
    $router->get('protected', ['middleware' => 'auth', 'uses' => 'MessagesController@showProtectedMessage']);
    $router->get('admin', ['middleware' => 'auth', 'uses' => 'MessagesController@showAdminMessage']);
});
