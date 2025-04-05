<?php

/**
 * File cấu hình Phinx
 *
 * File này chỉ chuyển hướng đến file cấu hình trong thư mục config
 * CHÚ Ý: KHÔNG SỬA FILE NÀY.
 * NẾU CẦN THAY ĐỔI CẤU HÌNH, HÃY SỬA FILE config/phinx.php
 */

const BASE_PATH = __DIR__;
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/utils/helpers.php';

// Load các biến môi trường từ file .env để sử dụng hàm getenv()
loadEnv();

// Chuyển hướng đến file cấu hình trong thư mục config
return require __DIR__ . '/config/phinx.php';
