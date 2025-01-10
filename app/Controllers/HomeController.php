<?php

namespace App\Controllers;

use Core\Controller;

class HomeController extends Controller
{
	public function index()
	{
		$this->render('home', ['name' => 'Blade User']);
	}
}
