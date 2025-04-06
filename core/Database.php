<?php

namespace Core;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $pdo = null;       // PDO connection
    private static string $table = '';     // Current table
    private static array $queryParts = []; // Query parts

    /**
     * Connect to database
     */
    private static function connect(): PDO
    {
        if (self::$pdo === null) {
            try {
                // Get the connection configuration from the config/database.php file
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

    /**
     * Select table
     */
    public static function table(string $table): self
    {
        self::$table = $table;
        self::$queryParts = []; // Reset query parts

        // Default add SELECT *
        self::$queryParts['select'] = "SELECT * FROM $table";

        return new self();
    }

    /**
     * Select column, if not pass parameters will select all
     */
    public static function select(array $columns = ['*']): self
    {
        self::$queryParts['select'] = "SELECT " . implode(', ', $columns) . " FROM " . self::$table;

        return new self();
    }

    /**
     * Add WHERE condition
     */
    public static function where(string $column, string $operator, $value): self
    {
        self::$queryParts['where'][] = "$column $operator ?";
        self::$queryParts['params'][] = $value;

        return new self();
    }

    /**
     * Add WHERE NULL condition
     */
    public static function whereNull(string $column): self
    {
        self::$queryParts['where'][] = "$column IS NULL";

        return new self();
    }

    /**
     * Add WHERE NOT NULL condition
     */
    public static function whereNotNull(string $column): self
    {
        self::$queryParts['where'][] = "$column IS NOT NULL";

        return new self();
    }

    /**
     * Sort data, default is ASC
     */
    public static function orderBy(string $column, string $direction = 'ASC'): self
    {
        self::$queryParts['orderBy'] = "ORDER BY $column $direction";

        return new self();
    }

    /**
     * Limit the number of results
     */
    public static function limit(int $limit): self
    {
        self::$queryParts['limit'] = "LIMIT $limit";

        return new self();
    }

    /**
     * Execute to get data
     */
    public static function get(): array
    {
        $sql = self::buildQuery();
        $stmt = self::connect()->prepare($sql);
        $stmt->execute(self::$queryParts['params'] ?? []);

        return $stmt->fetchAll();
    }

    /**
     * Get the first row
     */
    public static function first()
    {
        $sql = self::buildQuery() . " LIMIT 1";
        $stmt = self::connect()->prepare($sql);
        $stmt->execute(self::$queryParts['params'] ?? []);

        return $stmt->fetch();
    }

    /**
     * Count the number of records
     */
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

    /**
     * Add data
     */
    public static function insert(array $data): bool
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        $sql = "INSERT INTO " . self::$table . " ($columns) VALUES ($placeholders)";

        $stmt = self::connect()->prepare($sql);

        return $stmt->execute(array_values($data));
    }

    /**
     * Update data
     */
    public static function update(array $data): bool
    {
        $set = implode(', ', array_map(fn ($key) => "$key = ?", array_keys($data)));
        $sql = "UPDATE " . self::$table . " SET $set";

        if (! empty(self::$queryParts['where'])) {
            $sql .= " WHERE " . implode(' AND ', self::$queryParts['where']);
        }

        $stmt = self::connect()->prepare($sql);

        return $stmt->execute(array_merge(array_values($data), self::$queryParts['params'] ?? []));
    }

    /**
     * Delete data
     */
    public static function delete(): bool
    {
        $sql = "DELETE FROM " . self::$table;
        if (! empty(self::$queryParts['where'])) {
            $sql .= " WHERE " . implode(' AND ', self::$queryParts['where']);
        }

        $stmt = self::connect()->prepare($sql);

        return $stmt->execute(self::$queryParts['params'] ?? []);
    }

    /**
     * Build the SQL query
     */
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

    /**
     * Run the SQL query directly
     */
    public static function raw(string $sql, array $params = []): array
    {
        $stmt = self::connect()->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }
}
