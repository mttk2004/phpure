<?php
namespace Core;

class Cache
{
    private static string $cacheDir = BASE_PATH . '/storage/cache/';

    // Lưu dữ liệu vào cache
    public static function put(string $key, $data, int $minutes = 60): bool
    {
        $fileName = self::fileName($key);
        $expiration = time() + ($minutes * 60);
        $content = serialize([
            'expires' => $expiration,
            'data' => $data
        ]);

        return file_put_contents($fileName, $content) !== false;
    }

    // Lấy dữ liệu từ cache
    public static function get(string $key, $default = null)
    {
        $fileName = self::fileName($key);

        if (!file_exists($fileName)) {
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
        $fileName = self::fileName($key);

        if (file_exists($fileName)) {
            return unlink($fileName);
        }

        return false;
    }

    // Xóa tất cả cache
    public static function flush(): bool
    {
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
        return self::$cacheDir . md5($key);
    }
}
