<?php

namespace App\Middlewares;

use Core\Session;

class Guest
{
    public function handle(): bool
    {
        if (Session::has('user')) {
            http_response_code(403);
            echo "403 - You are already logged in!";

            return false;
        }

        return true;
    }
}
