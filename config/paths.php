<?php

/**
 * Cấu hình các đường dẫn thư mục
 *
 * File này chứa các định nghĩa đường dẫn cho các thư mục chính của ứng dụng.
 */

return [
  /*
    |--------------------------------------------------------------------------
    | Đường dẫn thư mục ứng dụng
    |--------------------------------------------------------------------------
    |
    | Các thư mục chính của ứng dụng.
    |
    */
  'app' => BASE_PATH . '/app',

  /*
    |--------------------------------------------------------------------------
    | Thư mục public
    |--------------------------------------------------------------------------
    |
    | Thư mục chứa các tài nguyên tĩnh có thể truy cập công khai
    |
    */
  'public' => BASE_PATH . '/public',

  /*
    |--------------------------------------------------------------------------
    | Thư mục storage
    |--------------------------------------------------------------------------
    |
    | Thư mục lưu trữ cache, logs, uploads,...
    |
    */
  'storage' => [
    'base' => BASE_PATH . '/storage',
    'cache' => BASE_PATH . '/storage/cache',
    'logs' => BASE_PATH . '/storage/logs',
    'uploads' => BASE_PATH . '/storage/uploads',
  ],

  /*
    |--------------------------------------------------------------------------
    | Thư mục resources
    |--------------------------------------------------------------------------
    |
    | Thư mục chứa các tài nguyên như views, css, js,...
    |
    */
  'resources' => [
    'base' => BASE_PATH . '/resources',
    'views' => BASE_PATH . '/resources/views',
    'css' => BASE_PATH . '/resources/css',
    'js' => BASE_PATH . '/resources/js',
  ],

  /*
    |--------------------------------------------------------------------------
    | Thư mục database
    |--------------------------------------------------------------------------
    |
    | Thư mục chứa migrations, seeds,...
    |
    */
  'database' => [
    'base' => BASE_PATH . '/database',
    'migrations' => BASE_PATH . '/database/migrations',
    'seeds' => BASE_PATH . '/database/seeds',
  ],
];
