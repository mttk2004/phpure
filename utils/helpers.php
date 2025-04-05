<?php

use JetBrains\PhpStorm\NoReturn;

// Đường dẫn gốc của ứng dụng
function requireRoot($path): void
{
  require_once BASE_PATH . '/' . $path;
}


// Hàm chuyển hướng URL
#[NoReturn] function redirect($url): void
{
  header("Location: $url");
  exit;
}

// Hàm dump dữ liệu và dừng chương trình (debug nhanh)
#[NoReturn] function dd($data): void
{
  echo '<pre>';
  print_r($data);
  echo '</pre>';
  exit;
}

// Hàm lọc dữ liệu đầu vào an toàn
function sanitizeInput($input): string
{
  return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

// Chuyển hướng nếu không được phép
#[NoReturn] function abort($code = 403)
{
  http_response_code($code);
  echo "$code - Access Denied.";
  exit;
}

function loadEnv(): void
{
  $envPath = BASE_PATH . '/.env';
  if (file_exists($envPath)) {
    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
      if (strpos(trim($line), '#') === 0) {
        continue;
      }
      [$key, $value] = explode('=', $line, 2);
      putenv(trim($key) . '=' . trim($value));
    }
  }
}

/**
 * Truy xuất cấu hình từ các file trong thư mục config
 *
 * @param string $key Khóa cấu hình (ví dụ: app.name, database.connections.mysql)
 * @param mixed $default Giá trị mặc định nếu không tìm thấy
 * @return mixed Giá trị cấu hình
 */
function config(string $key, $default = null)
{
  static $config = [];

  // Nếu cấu hình đã được tải, trả về giá trị từ bộ nhớ cache
  if (isset($config[$key])) {
    return $config[$key];
  }

  // Tách key thành phần file và tham số
  $parts = explode('.', $key);
  $file = array_shift($parts);

  // Đường dẫn đến file cấu hình
  $filePath = BASE_PATH . '/config/' . $file . '.php';

  // Kiểm tra nếu file không tồn tại
  if (!file_exists($filePath)) {
    return $default;
  }

  // Tải cấu hình từ file
  $configData = require $filePath;

  // Nếu không có phần key con, trả về toàn bộ cấu hình
  if (empty($parts)) {
    $config[$key] = $configData;
    return $configData;
  }

  // Tìm giá trị dựa trên các phần key
  $value = $configData;
  foreach ($parts as $part) {
    if (!isset($value[$part])) {
      return $default;
    }
    $value = $value[$part];
  }

  // Lưu vào bộ nhớ cache và trả về
  $config[$key] = $value;
  return $value;
}

/**
 * Ném Exception khi điều kiện thỏa mãn
 * @throws Exception
 */
function throw_if(bool $condition, string $message): void
{
  if ($condition) {
    throw new \Exception($message);
  }
}

/**
 * Tích hợp Vite với môi trường PHP
 * Trong môi trường phát triển, nó sẽ kết nối tới Vite dev server
 * Trong môi trường production, nó sẽ sử dụng các tài nguyên đã được build
 */
function vite_assets($entry = 'resources/js/app.js'): string
{
  $isDev = getenv('APP_ENV') === 'local' || getenv('APP_ENV') === 'development';
  $devServerIsRunning = false;

  // Kiểm tra xem Vite dev server có đang chạy không (trong môi trường phát triển)
  if ($isDev) {
    $handle = @fsockopen('localhost', 5173);
    $devServerIsRunning = $handle !== false;
    if ($handle) {
      fclose($handle);
    }
  }

  if ($isDev && $devServerIsRunning) {
    // Sử dụng Vite dev server
    return <<<HTML
            <script type="module" src="http://localhost:5173/@vite/client"></script>
            <script type="module" src="http://localhost:5173/$entry"></script>
        HTML;
  } else {
    // Sử dụng các tệp đã được build
    return <<<HTML
            <link rel="stylesheet" href="/assets/styles.css">
            <script type="module" src="/assets/app.js"></script>
        HTML;
  }
}
