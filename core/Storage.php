<?php

namespace Core;

class Storage
{
    private static string $uploadDir = BASE_PATH . '/storage/uploads/';

    // Lưu file vào thư mục upload
    public static function put(string $path, $file): string
    {
        $directory = self::$uploadDir . dirname($path);

        // Tạo thư mục nếu chưa tồn tại
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        // Lưu file
        $filePath = self::$uploadDir . $path;
        move_uploaded_file($file['tmp_name'], $filePath);

        return $filePath;
    }

    // Lấy đường dẫn file
    public static function get(string $path): string
    {
        $filePath = self::$uploadDir . $path;

        if (!file_exists($filePath)) {
            throw new \Exception("File not found: $path");
        }

        return $filePath;
    }

    // Xóa file
    public static function delete(string $path): bool
    {
        $filePath = self::$uploadDir . $path;

        if (file_exists($filePath)) {
            return unlink($filePath);
        }

        return false;
    }

    // Liệt kê file trong thư mục
    public static function files(string $directory = ''): array
    {
        $dir = self::$uploadDir . $directory;

        if (!is_dir($dir)) {
            return [];
        }

        return array_diff(scandir($dir), ['.', '..']);
    }
}
