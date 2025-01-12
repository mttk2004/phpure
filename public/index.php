<?php

use Core\App;


const BASE_PATH = __DIR__ . '/..';
require_once BASE_PATH . '/vendor/autoload.php';
require_once BASE_PATH . '/utils/helpers.php';
require_once BASE_PATH . '/app/events.php';

// Bật hiển thị lỗi (chỉ dùng trong môi trường phát triển)
error_reporting(E_ALL);
ini_set('display_errors', 1);

loadEnv();

// Khởi chạy ứng dụng
App::bootstrap();
