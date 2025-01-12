<?php

namespace App\Middleware;

use Core\Logger;

class Auth
{
    public function handle(): void
    {
        if (!isset($_SESSION['user'])) {
            Logger::warning(
                'Unauthorized access attempt detected.',
                ['ip' => $_SERVER['REMOTE_ADDR']]
            );
            header('Location: /login');
            exit;
        }
    }
}
