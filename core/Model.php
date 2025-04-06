<?php

namespace Core;

abstract class Model
{
    protected string $table;            // Table name
    protected array $attributes = [];   // Attributes of the model
    protected bool $softDelete = false; // Default does not support Soft Deletes

    /**
     * Initialize with data
     */
    public function __construct(array $attributes = [])
    {
        $this->attributes = $attributes;
    }

    /**
     * Access dynamic properties
     */
    public function __get(string $key)
    {
        return $this->attributes[$key] ?? null;
    }

    /**
     * Set dynamic properties
     */
    public function __set(string $key, $value)
    {
        $this->attributes[$key] = $value;
    }

    /**
     * Get all records
     */
    public static function all(): array
    {
        $instance = new static();
        $query = Database::table($instance->table);

        // Filter `deleted_at` if the table supports Soft Deletes
        if ($instance->softDelete) {
            $query->whereNull('deleted_at');
        }

        $records = $query->get();

        // Attach data to the list of Model objects
        return array_map(function ($record) use ($instance) {
            $model = new static();
            $model->fill($record);

            return $model;
        }, $records);
    }

    /**
     * Find a record by ID
     */
    public static function find(int $id): ?self
    {
        $instance = new static();

        $query = Database::table($instance->table)->where('id', '=', $id);

        // If the table supports Soft Deletes, add the condition to filter `deleted_at`
        if ($instance->softDelete) {
            $query->whereNull('deleted_at');
        }

        $record = $query->first();

        if (! $record) {
            return null;
        }

        // Attach data to the Model object
        $instance->fill($record);

        return $instance;
    }

    /**
     * Get only deleted records
     */
    public static function onlyTrashed(): array
    {
        $instance = new static();

        // If the table does not support Soft Deletes, throw an error
        if (! $instance->softDelete) {
            throw new \Exception("Soft Deletes are not enabled for table '{$instance->table}'");
        }

        $records = Database::table($instance->table)->whereNotNull('deleted_at')->get();

        // Attach data to the list of Model objects
        return array_map(function ($record) use ($instance) {
            $model = new static();
            $model->fill($record);

            return $model;
        }, $records);
    }

    /**
     * Create a new record
     */
    public function create(array $data): bool
    {
        return Database::table($this->table)->insert($data);
    }

    /**
     * Update a record
     */
    public function update(array $data, $id): bool
    {
        return Database::table($this->table)->where('id', '=', $id)->update($data);
    }

    /**
     * Delete a record
     */
    public function delete(int $id): bool
    {
        if ($this->softDelete) {
            // Soft delete if the table supports Soft Deletes
            return Database::table($this->table)
              ->where('id', '=', $id)
              ->update(['deleted_at' => date('Y-m-d H:i:s')]);
        } else {
            // Hard delete if the table does not support Soft Deletes
            return Database::table($this->table)
              ->where('id', '=', $id)
              ->delete();
        }
    }

    /**
     * Restore a record
     */
    public function restore(int $id): bool
    {
        if (! $this->softDelete) {
            throw new \Exception("Restore is not supported for table '{$this->table}'");
        }

        return Database::table($this->table)
          ->where('id', '=', $id)
          ->update(['deleted_at' => null]);
    }

    /**
     * One-to-One relationship
     */
    public function hasOne(
        string $relatedModel,
        string $foreignKey,
        string $localKey = 'id',
    ): ?Model {
        $related = new $relatedModel();
        $record = Database::table($related->table)
          ->where($foreignKey, '=', $this->{$localKey})
          ->first();

        if (! $record) {
            return null;
        }

        // Attach data to the Model object
        $related->fill($record);

        return $related;
    }

    /**
     * One-to-Many relationship
     */
    public function hasMany(
        string $relatedModel,
        string $foreignKey,
        string $localKey = 'id',
    ): array {
        $related = new $relatedModel();
        $records = Database::table($related->table)
          ->where($foreignKey, '=', $this->{$localKey})
          ->get();

        // Attach data to the list of Model objects
        return array_map(function ($record) use ($relatedModel) {
            $instance = new $relatedModel();
            $instance->fill($record);

            return $instance;
        }, $records);
    }

    /**
     * Many-to-Many relationship
     */
    public function belongsToMany(
        string $relatedModel,
        string $pivotTable,
        string $foreignKey,
        string $relatedKey,
        string $localKey = 'id',
        string $relatedLocalKey = 'id',
    ): array {
        $related = new $relatedModel();

        $sql = "SELECT `{$related->table}`.*
            FROM `{$related->table}`
            INNER JOIN `{$pivotTable}`
            ON `{$related->table}`.`{$relatedLocalKey}` = `{$pivotTable}`.`{$relatedKey}`
            WHERE `{$pivotTable}`.`{$foreignKey}` = ?";

        $records = Database::raw($sql, [$this->{$localKey}]);

        // Attach data to the list of Model objects
        return array_map(function ($record) use ($relatedModel) {
            $instance = new $relatedModel();
            $instance->fill($record);

            return $instance;
        }, $records);
    }

    /**
     * Attach data from the database to the Model
     */
    public function fill(array $data): void
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }
}
