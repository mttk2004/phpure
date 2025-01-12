<?php

use Core\Http\Router;


$router = new Router();

// TODO: Define routes here
$router->get('', ['HomeController', 'index']);
$router->get('about', ['HomeController', 'about'])->middleware('auth');
$router->get('users', ['UserController', 'register']);
$router->post('users/store', ['UserController', 'store']);
$router->get('login', ['HomeController', 'login'])->middleware('guest');
$router->post('files/upload', ['FileController', 'upload']);
$router->get('files/delete/{filename}', ['FileController', 'delete']);
$router->get('files', ['FileController', 'listFiles']);

$router->dispatch();
