<?php

namespace App\Controllers;


use Core\Controller;


class HomeController extends Controller
{
	public function index(): void
	{
		// Truyền dữ liệu cho View
		$this->render('home/index', [
				'message' => 'Hello from Home Controller!',
		]);
	}
	
	public function about(): void
	{
		$this->render('home/index', [
				'message' => 'This is the About Page rendered with a View!',
		]);
	}
}
