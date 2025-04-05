<?php

namespace Core;

class Cache
{
  private static string $cacheDir;
  private static int $ttl;

  // Khởi tạo cache
  private static function init(): void
  {
    if (!isset(self::$cacheDir)) {
      self::$cacheDir = config('cache.path', BASE_PATH . '/storage/cache/');
      self::$ttl = config('cache.ttl', 60); // Mặc định 60 phút
    }
  }

  // Lưu dữ liệu vào cache
  public static function put(string $key, $data, ?int $minutes = null): bool
  {
    self::init();

    $fileName = self::fileName($key);
    $expiration = time() + (($minutes ?? self::$ttl) * 60);
    $content = serialize([
      'expires' => $expiration,
      'data' => $data,
    ]);

    return file_put_contents($fileName, $content) !== false;
  }

  // Lấy dữ liệu từ cache
  public static function get(string $key, $default = null)
  {
    self::init();

    $fileName = self::fileName($key);

    if (! file_exists($fileName)) {
      return $default;
    }

    $content = unserialize(file_get_contents($fileName));

    if (time() > $content['expires']) {
      self::delete($key);

      return $default;
    }

    return $content['data'];
  }

  // Xóa cache
  public static function delete(string $key): bool
  {
    self::init();

    $fileName = self::fileName($key);

    if (file_exists($fileName)) {
      return unlink($fileName);
    }

    return false;
  }

  // Xóa tất cả cache
  public static function flush(): bool
  {
    self::init();

    $files = glob(self::$cacheDir . '*');

    foreach ($files as $file) {
      if (is_file($file)) {
        unlink($file);
      }
    }

    return true;
  }

  // Tạo tên file cache
  private static function fileName(string $key): string
  {
    self::init();

    return self::$cacheDir . md5($key);
  }
}
