<?php

/**
 * Cấu hình hệ thống cache
 *
 * File này chứa các thiết lập liên quan đến hệ thống cache
 */

return [
  /*
    |--------------------------------------------------------------------------
    | Thời gian mặc định
    |--------------------------------------------------------------------------
    |
    | Thời gian mặc định (phút) mà các mục cache sẽ được lưu trữ
    |
    */
  'ttl' => 60,

  /*
    |--------------------------------------------------------------------------
    | Thư mục lưu trữ
    |--------------------------------------------------------------------------
    |
    | Đường dẫn thư mục lưu trữ cache của ứng dụng
    |
    */
  'path' => BASE_PATH . '/storage/cache',

  /*
    |--------------------------------------------------------------------------
    | Tối ưu cache
    |--------------------------------------------------------------------------
    |
    | Các thiết lập liên quan đến tối ưu hóa hệ thống cache
    |
    */
  'optimize' => [
    'auto_clean' => true,      // Tự động xóa cache hết hạn
    'cleanable' => true,       // Cho phép xóa cache
  ],
];
