<?php

use Core\Http\Router;
use App\Controllers\HomeController;

$router = new Router();

// Define routes
$router->get('', ['HomeController', 'index']);

// TODO: Define routes here


$router->dispatch();
