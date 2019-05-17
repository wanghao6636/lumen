<?php

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
$router->post('/user','Users\UserController@info');
$router->get('/center','Users\UserController@uCenter');
$router->get('/order','Users\UserController@order');



$router->post('/user/1','Users\LoginController@login');
$router->get('/center/2','Users\LoginController@center');
$router->post('/order/3','Users\LoginController@order');


$router->post('/password','Users\UserController@info');

//对称
$router->post('test','Test\TestController@Test');
//非对称
$router->post('innt','Test\TestController@innt');
//验签
$router->post('sign','Test\TestController@sign');

//ajax请求
$router->get('niu','Test\QqController@niu');

$router->post('neet','Test\QqController@niu');




$router->post('reg','Reg\RegController@reg');

//$router->post('reg','Reg\RegController@reg')->Middleware('RegMiddlware');
