<?php

namespace App\Controllers;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;

class HomeController extends Controller
{
	public function index()
	{
		$name = Request::query('name', 'Guest');
		Response::json([
				'message' => "Hello, $name!",
		]);
	}
}
