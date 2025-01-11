<?php

namespace Core;


use Core\Http\Router;


class App
{
	public static function run()
	{
		Session::start();
		
		$router = new Router();
		
		// Routes
		$router->get('', ['HomeController', 'index']);
		$router->get('about', ['HomeController', 'about'])->middleware('auth');
		$router->get('users', ['UserController', 'index']);
		$router->post('users/store', ['UserController', 'store']);
		$router->get('login', ['HomeController', 'login'])->middleware('guest');
		$router->post('files/upload', ['FileController', 'upload']);
		$router->get('files/delete/{filename}', ['FileController', 'delete']);
		$router->get('files', ['FileController', 'listFiles']);
		
		$router->dispatch();
	}
}
