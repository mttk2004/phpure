<?php

/**
 * Cấu hình hệ thống lưu trữ (Storage)
 *
 * File này chứa các thiết lập liên quan đến hệ thống lưu trữ
 */

return [
  /*
    |--------------------------------------------------------------------------
    | Thư mục gốc lưu trữ
    |--------------------------------------------------------------------------
    |
    | Đường dẫn đến thư mục gốc lưu trữ các file tải lên
    |
    */
  'uploads_path' => BASE_PATH . '/storage/uploads',

  /*
    |--------------------------------------------------------------------------
    | Phân quyền mặc định
    |--------------------------------------------------------------------------
    |
    | Phân quyền mặc định khi tạo thư mục
    |
    */
  'permissions' => [
    'dir' => 0755,    // Phân quyền cho thư mục
    'file' => 0644,   // Phân quyền cho file
  ],

  /*
    |--------------------------------------------------------------------------
    | Phần mở rộng được phép
    |--------------------------------------------------------------------------
    |
    | Danh sách các phần mở rộng file được phép tải lên
    |
    */
  'allowed_extensions' => [
    'jpg',
    'jpeg',
    'png',
    'gif',
    'webp',
    'svg',  // Hình ảnh
    'pdf',
    'doc',
    'docx',
    'xls',
    'xlsx',
    'txt',  // Tài liệu
    'zip',
    'rar',
    '7z',                         // Nén
    'mp3',
    'mp4',
    'wav',
    'ogg',
    'avi',
    'webm',  // Media
  ],

  /*
    |--------------------------------------------------------------------------
    | Giới hạn kích thước
    |--------------------------------------------------------------------------
    |
    | Giới hạn kích thước file tải lên (bytes)
    | Mặc định: 10MB = 10 * 1024 * 1024
    |
    */
  'max_size' => 10 * 1024 * 1024,  // 10MB
];
