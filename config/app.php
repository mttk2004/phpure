<?php

/**
 * Cấu hình cơ bản của ứng dụng
 *
 * File này chứa các cấu hình cốt lõi của ứng dụng PHPure.
 */

return [
  /*
    |--------------------------------------------------------------------------
    | Tên ứng dụng
    |--------------------------------------------------------------------------
    |
    | Giá trị này xác định tên của ứng dụng của bạn. Tên này được sử dụng khi
    | framework cần đặt tên cho ứng dụng trong các thông báo hoặc giao diện.
    |
    */
  'name' => getenv('APP_NAME') ?? 'PHPure',

  /*
    |--------------------------------------------------------------------------
    | Môi trường ứng dụng
    |--------------------------------------------------------------------------
    |
    | Cấu hình này xác định môi trường mà ứng dụng đang chạy. Các giá trị phổ biến
    | bao gồm "production", "development", và "testing".
    |
    */
  'env' => getenv('APP_ENV') ?? 'development',

  /*
    |--------------------------------------------------------------------------
    | Debug Mode
    |--------------------------------------------------------------------------
    |
    | Khi debug mode được bật, các lỗi sẽ được hiển thị chi tiết.
    | Trong môi trường production, nên tắt tính năng này.
    |
    */
  'debug' => filter_var(getenv('APP_DEBUG') ?? true, FILTER_VALIDATE_BOOLEAN),

  /*
    |--------------------------------------------------------------------------
    | Múi giờ ứng dụng
    |--------------------------------------------------------------------------
    |
    | Xác định múi giờ mặc định cho ứng dụng của bạn, được sử dụng bởi
    | các hàm xử lý ngày tháng, giờ.
    |
    */
  'timezone' => getenv('APP_TIMEZONE') ?? 'Asia/Ho_Chi_Minh',

  /*
    |--------------------------------------------------------------------------
    | Mã hóa ứng dụng
    |--------------------------------------------------------------------------
    |
    | Mã hóa mặc định sử dụng bởi ứng dụng khi xử lý chuỗi, mật khẩu, v.v.
    |
    */
  'encoding' => 'UTF-8',
];
