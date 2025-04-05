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

    // 2. Đặt múi giờ mặc định từ cấu hình
    date_default_timezone_set(config('app.timezone', 'Asia/Ho_Chi_Minh'));

    // 3. Kích hoạt Whoops nếu debug mode được bật
    if (config('app.debug', true)) {
      self::enableWhoops();
    }

    // 4. Khởi động session
    Session::start();

    // 5. Load các file cấu hình sự kiện và route
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
