<?php

namespace App\Middlewares;

use Core\Session;

class Guest
{
    public function handle(): bool
    {
        // Kiểm tra người dùng đã đăng nhập chưa
        if (Session::has('user')) {
            http_response_code(403);
            echo "403 - Bạn đã đăng nhập!";

            return false;
        }

        return true;
    }
}
