<?php

namespace App\Controllers;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;

class HomeController extends Controller
{
	public function index()
	{
		$this->render('home');
	}
}
