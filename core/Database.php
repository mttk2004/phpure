<?php

namespace Core;

use PDO;
use PDOException;

class Database
{
  private static ?PDO $pdo = null;       // Kết nối PDO
  private static string $table = '';     // Bảng hiện tại
  private static array $queryParts = []; // Các phần của query

  // Kết nối database
  private static function connect(): PDO
  {
    if (self::$pdo === null) {
      try {
        // Lấy cấu hình kết nối từ file config/database.php
        $default = config('database.default', 'mysql');
        $connection = config('database.connections.' . $default);

        $host = $connection['host'];
        $dbname = $connection['database'];
        $username = $connection['username'];
        $password = $connection['password'];
        $port = $connection['port'] ?: 3306;
        $charset = $connection['charset'] ?: 'utf8mb4';

        $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=$charset";
        self::$pdo = new PDO($dsn, $username, $password);
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
        die("Database Connection Failed: " . $e->getMessage());
      }
    }

    return self::$pdo;
  }

  // Chọn bảng
  public static function table(string $table): self
  {
    self::$table = $table;
    self::$queryParts = []; // Reset query parts

    // Mặc định thêm SELECT *
    self::$queryParts['select'] = "SELECT * FROM $table";

    return new self();
  }

  // Chọn cột, nếu không truyền tham số sẽ chọn tất cả
  public static function select(array $columns = ['*']): self
  {
    self::$queryParts['select'] = "SELECT " . implode(', ', $columns) . " FROM " . self::$table;

    return new self();
  }

  // Thêm điều kiện WHERE
  public static function where(string $column, string $operator, $value): self
  {
    self::$queryParts['where'][] = "$column $operator ?";
    self::$queryParts['params'][] = $value;

    return new self();
  }

  // Thêm điều kiện WHERE NULL
  public static function whereNull(string $column): self
  {
    self::$queryParts['where'][] = "$column IS NULL";

    return new self();
  }

  // Thêm điều kiện WHERE NOT NULL
  public static function whereNotNull(string $column): self
  {
    self::$queryParts['where'][] = "$column IS NOT NULL";

    return new self();
  }

  // Sắp xếp dữ liệu, mặc định là ASC
  public static function orderBy(string $column, string $direction = 'ASC'): self
  {
    self::$queryParts['orderBy'] = "ORDER BY $column $direction";

    return new self();
  }

  // Giới hạn số lượng kết quả
  public static function limit(int $limit): self
  {
    self::$queryParts['limit'] = "LIMIT $limit";

    return new self();
  }

  // Thực thi lấy dữ liệu
  public static function get(): array
  {
    $sql = self::buildQuery();
    $stmt = self::connect()->prepare($sql);
    $stmt->execute(self::$queryParts['params'] ?? []);

    return $stmt->fetchAll();
  }

  // Lấy dòng đầu tiên
  public static function first()
  {
    $sql = self::buildQuery() . " LIMIT 1";
    $stmt = self::connect()->prepare($sql);
    $stmt->execute(self::$queryParts['params'] ?? []);

    return $stmt->fetch();
  }

  // Đếm số lượng bản ghi
  public static function count(): int
  {
    $sql = "SELECT COUNT(*) as count FROM " . self::$table;
    if (! empty(self::$queryParts['where'])) {
      $sql .= " WHERE " . implode(' AND ', self::$queryParts['where']);
    }

    $stmt = self::connect()->prepare($sql);
    $stmt->execute(self::$queryParts['params'] ?? []);

    return $stmt->fetch()['count'] ?? 0;
  }

  // Thêm dữ liệu
  public static function insert(array $data): bool
  {
    $columns = implode(', ', array_keys($data));
    $placeholders = implode(', ', array_fill(0, count($data), '?'));
    $sql = "INSERT INTO " . self::$table . " ($columns) VALUES ($placeholders)";

    $stmt = self::connect()->prepare($sql);

    return $stmt->execute(array_values($data));
  }

  // Cập nhật dữ liệu
  public static function update(array $data): bool
  {
    $set = implode(', ', array_map(fn($key) => "$key = ?", array_keys($data)));
    $sql = "UPDATE " . self::$table . " SET $set";

    if (! empty(self::$queryParts['where'])) {
      $sql .= " WHERE " . implode(' AND ', self::$queryParts['where']);
    }

    $stmt = self::connect()->prepare($sql);

    return $stmt->execute(array_merge(array_values($data), self::$queryParts['params'] ?? []));
  }

  // Xóa dữ liệu
  public static function delete(): bool
  {
    $sql = "DELETE FROM " . self::$table;
    if (! empty(self::$queryParts['where'])) {
      $sql .= " WHERE " . implode(' AND ', self::$queryParts['where']);
    }

    $stmt = self::connect()->prepare($sql);

    return $stmt->execute(self::$queryParts['params'] ?? []);
  }

  // Xây dựng câu truy vấn SQL
  private static function buildQuery(): string
  {
    $sql = self::$queryParts['select'] ?? '';
    if (! empty(self::$queryParts['where'])) {
      $sql .= " WHERE " . implode(' AND ', self::$queryParts['where']);
    }
    if (! empty(self::$queryParts['orderBy'])) {
      $sql .= " " . self::$queryParts['orderBy'];
    }
    if (! empty(self::$queryParts['limit'])) {
      $sql .= " " . self::$queryParts['limit'];
    }

    return $sql;
  }

  // Chạy câu SQL trực tiếp
  public static function raw(string $sql, array $params = []): array
  {
    $stmt = self::connect()->prepare($sql);
    $stmt->execute($params);

    return $stmt->fetchAll();
  }
}
