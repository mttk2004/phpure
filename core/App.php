<?php

namespace Core;

use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

class App
{
    public static function bootstrap(): void
    {
        // 1. Load môi trường
        loadEnv();

        // 2. Kích hoạt Whoops nếu ở môi trường development
        if (getenv('APP_ENV') === 'development') {
            self::enableWhoops();
        }

        // 3. Khởi động session
        Session::start();

        // 4. Load các file cấu hình
        require_once BASE_PATH . '/app/events.php';
        require_once BASE_PATH . '/app/routes.php';
    }

    public static function enableWhoops(): void
    {
        $whoops = new Run();
        $whoops->pushHandler(new PrettyPageHandler());
        $whoops->register();
    }
}
