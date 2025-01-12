<?php

namespace Core\Http;

use App\Middleware\Auth;
use App\Middleware\Guest;

class Middleware
{
    // Danh sách middleware có thể đăng ký
    private const array MAP
            = [
                    'auth' => Auth::class,
                    'guest' => Guest::class,
                // TODO: Add more middleware here as needed
            ];

    // Xử lý Middleware
    public static function resolve(string $key): bool
    {
        // Kiểm tra middleware có tồn tại trong MAP không
        if (!isset(self::MAP[$key])) {
            throw new \Exception("Middleware '$key' không tồn tại!");
        }

        // Sử dụng biến trung gian
        $middlewareClass = self::MAP[$key];   // Trích xuất lớp từ MAP
        $middleware = new $middlewareClass(); // Khởi tạo middleware

        return $middleware->handle();         // Thực thi middleware
    }
}
