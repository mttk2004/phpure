<?php

namespace Core;

class Storage
{
    private static string $uploadDir;
    private static array $allowedExtensions;
    private static int $maxSize;
    private static array $permissions;

    /**
     * Initialize the storage configuration
     */
    private static function init(): void
    {
        if (! isset(self::$uploadDir)) {
            self::$uploadDir = config('storage.uploads_path', BASE_PATH . '/storage/uploads/');
            self::$allowedExtensions = config('storage.allowed_extensions', []);
            self::$maxSize = config('storage.max_size', 10 * 1024 * 1024); // 10 MB
            self::$permissions = config('storage.permissions', [
              'dir' => 0755,
              'file' => 0644,
            ]);
        }
    }

    /**
     * Save a file to the upload directory
     */
    public static function put(string $path, $file): string
    {
        self::init();

        // Check the file extension
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        if (! empty(self::$allowedExtensions) && ! in_array(strtolower($extension), self::$allowedExtensions)) {
            throw new \Exception("File extension not allowed: $extension");
        }

        // Check the file size
        if ($file['size'] > self::$maxSize) {
            throw new \Exception("File size too large: {$file['size']} bytes");
        }

        $directory = self::$uploadDir . dirname($path);

        // Create the directory if it does not exist
        if (! is_dir($directory)) {
            mkdir($directory, self::$permissions['dir'], true);
        }

        // Save the file
        $filePath = self::$uploadDir . $path;
        move_uploaded_file($file['tmp_name'], $filePath);

        // Set the file permissions
        chmod($filePath, self::$permissions['file']);

        return $filePath;
    }

    /**
     * Get the file path
     */
    public static function get(string $path): string
    {
        self::init();

        $filePath = self::$uploadDir . $path;

        if (! file_exists($filePath)) {
            throw new \Exception("File not found: $path");
        }

        return $filePath;
    }

    /**
     * Delete a file
     */
    public static function delete(string $path): bool
    {
        self::init();

        $filePath = self::$uploadDir . $path;

        if (file_exists($filePath)) {
            return unlink($filePath);
        }

        return false;
    }

    /**
     * List files in the directory
     */
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
