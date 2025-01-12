<?php

namespace Core;


use Core\Http\Router;


class App
{
	public static function bootstrap(): void
	{
		// 1. Load môi trường
		loadEnv();
		
		// 2. Khởi động session
		Session::start();
		
		// 3. Load các file cấu hình
		require_once BASE_PATH . '/app/events.php';
		require_once BASE_PATH . '/app/routes.php';
	}
}
