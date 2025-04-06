<?php

use Core\Http\Router;

$router = new Router();

// TODO: Define routes here
$router->get('', ['HomeController', 'index']);

$router->dispatch();
