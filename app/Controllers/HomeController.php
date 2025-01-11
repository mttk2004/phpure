<?php

namespace App\Controllers;


use Core\Controller;
use Core\Logger;


class HomeController extends Controller
{
	public function index()
	{
		Logger::info('HomeController index method called', ['user' => 'Guest']);
		
		echo "Welcome to the home page!";
	}
}
