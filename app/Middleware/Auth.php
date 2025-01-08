<?php

namespace App\Middleware;


use Core\Session;


class Auth
{
	public function handle(): bool
	{
		// Kiểm tra người dùng đã đăng nhập chưa
		if (!Session::has('user')) {
			http_response_code(403);
			echo "403 - Unauthorized Access.";
			
			return false;
		}
		
		return true;
	}
}
