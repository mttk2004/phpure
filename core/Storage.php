<?php

namespace Core;

class Storage
{
  private static string $uploadDir;
  private static array $allowedExtensions;
  private static int $maxSize;
  private static array $permissions;

  // Khởi tạo cấu hình Storage
  private static function init(): void
  {
    if (!isset(self::$uploadDir)) {
      self::$uploadDir = config('storage.uploads_path', BASE_PATH . '/storage/uploads/');
      self::$allowedExtensions = config('storage.allowed_extensions', []);
      self::$maxSize = config('storage.max_size', 10 * 1024 * 1024); // 10 MB
      self::$permissions = config('storage.permissions', [
        'dir' => 0755,
        'file' => 0644,
      ]);
    }
  }

  // Lưu file vào thư mục upload
  public static function put(string $path, $file): string
  {
    self::init();

    // Kiểm tra phần mở rộng file
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    if (!empty(self::$allowedExtensions) && !in_array(strtolower($extension), self::$allowedExtensions)) {
      throw new \Exception("File extension not allowed: $extension");
    }

    // Kiểm tra kích thước file
    if ($file['size'] > self::$maxSize) {
      throw new \Exception("File size too large: {$file['size']} bytes");
    }

    $directory = self::$uploadDir . dirname($path);

    // Tạo thư mục nếu chưa tồn tại
    if (! is_dir($directory)) {
      mkdir($directory, self::$permissions['dir'], true);
    }

    // Lưu file
    $filePath = self::$uploadDir . $path;
    move_uploaded_file($file['tmp_name'], $filePath);

    // Đặt quyền cho file
    chmod($filePath, self::$permissions['file']);

    return $filePath;
  }

  // Lấy đường dẫn file
  public static function get(string $path): string
  {
    self::init();

    $filePath = self::$uploadDir . $path;

    if (! file_exists($filePath)) {
      throw new \Exception("File not found: $path");
    }

    return $filePath;
  }

  // Xóa file
  public static function delete(string $path): bool
  {
    self::init();

    $filePath = self::$uploadDir . $path;

    if (file_exists($filePath)) {
      return unlink($filePath);
    }

    return false;
  }

  // Liệt kê file trong thư mục
  public static function files(string $directory = ''): array
  {
    self::init();

    $dir = self::$uploadDir . $directory;

    if (! is_dir($dir)) {
      return [];
    }

    return array_diff(scandir($dir), ['.', '..']);
  }
}
