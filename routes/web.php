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

$router->get('/version', function () use ($router) {
    return $router->app->version();
});

$router->get("/test", function () {
    $admin = app(\App\Presenter\Admin::class);
    echo $admin->renderMenu();
});

$router->get('/', "Admin\HomeController@index");

$router->get('/page', "Admin\HomeController@page");
$router->get('/page/edit', ["as" => "edit_page", "uses" => "Admin\HomeController@editPage"]);
$router->post('/page/edit', "Admin\HomeController@editRootModule");

$router->get('/page/config', ["as" => "config_page", "uses" => "Admin\HomeController@configPage"]);
$router->post('/page/saveConfig', "Admin\HomeController@savePageConfig");

$router->get('/modules', "Admin\HomeController@modules");