<?php

namespace App\Controllers;

use Core\Controller;
use Core\Event;

class UserController extends Controller
{
    public function register()
    {
        // Giả lập đăng ký người dùng
        $user = [
                'name' => 'John Doe',
                'email' => 'john@example.com',
        ];

        echo "User {$user['name']} registered successfully.\n";

        // Kích hoạt sự kiện "user.registered"
        Event::dispatch('user.registered', $user);
    }
}
