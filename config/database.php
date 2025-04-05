<?php

/**
 * Cấu hình kết nối cơ sở dữ liệu
 *
 * File này chứa các cấu hình kết nối cơ sở dữ liệu của ứng dụng PHPure.
 */

return [
  /*
    |--------------------------------------------------------------------------
    | Kết nối cơ sở dữ liệu mặc định
    |--------------------------------------------------------------------------
    |
    | Đây là kết nối mặc định được sử dụng bởi ứng dụng, bạn có thể
    | thay đổi giá trị này để sử dụng kết nối khác.
    |
    */
  'default' => getenv('DB_CONNECTION') ?? 'mysql',

  /*
    |--------------------------------------------------------------------------
    | Các kết nối cơ sở dữ liệu
    |--------------------------------------------------------------------------
    |
    | Đây là thông tin kết nối cho từng cơ sở dữ liệu trong ứng dụng.
    | Bạn có thể thiết lập nhiều kết nối khác nhau.
    |
    */
  'connections' => [
    'mysql' => [
      'adapter' => getenv('DB_ADAPTER') ?? 'mysql',
      'host' => getenv('DB_HOST') ?? 'localhost',
      'port' => getenv('DB_PORT') ?? 3306,
      'database' => getenv('DB_NAME') ?? 'phpure',
      'username' => getenv('DB_USER') ?? 'root',
      'password' => getenv('DB_PASS') ?? '',
      'charset' => getenv('DB_CHARSET') ?? 'utf8mb4',
      'collation' => getenv('DB_COLLATION') ?? 'utf8mb4_unicode_ci',
      'prefix' => getenv('DB_PREFIX') ?? '',
    ],

    'sqlite' => [
      'adapter' => 'sqlite',
      'database' => getenv('DB_NAME') ?? BASE_PATH . '/database/database.sqlite',
    ],
  ],
];
