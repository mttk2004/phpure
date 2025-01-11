<?php

namespace Core;


abstract class Model
{
	protected string $table;            // Tên bảng
	protected array $attributes = [];   // Thuộc tính của model
	protected bool $softDelete = false; // Mặc định không hỗ trợ Soft Deletes
	
	// Khởi tạo với dữ liệu
	public function __construct(array $attributes = [])
	{
		$this->attributes = $attributes;
	}
	
	// Truy cập thuộc tính động
	public function __get(string $key)
	{
		return $this->attributes[$key] ?? null;
	}
	
	public function __set(string $key, $value)
	{
		$this->attributes[$key] = $value;
	}
	
	// Lấy tất cả bản ghi
	public function all(): array
	{
		$query = Database::table($this->table);
		
		// Nếu bảng hỗ trợ Soft Deletes, thêm điều kiện lọc `deleted_at`
		if ($this->softDelete) {
			$query->whereNull('deleted_at');
		}
		
		return $query->get();
	}
	
	// Tìm bản ghi theo ID
	public static function find(int $id): ?self
	{
		$instance = new static();
		
		$query = Database::table($instance->table)->where('id', '=', $id);
		
		// Nếu bảng hỗ trợ Soft Deletes, thêm điều kiện lọc `deleted_at`
		if ($instance->softDelete) {
			$query->whereNull('deleted_at');
		}
		
		$record = $query->first();
		
		if (!$record) {
			return null;
		}
		
		$instance->fill($record);
		
		return $instance;
	}
	
	// Thêm bản ghi mới
	public function create(array $data): bool
	{
		return Database::table($this->table)->insert($data);
	}
	
	// Cập nhật bản ghi
	public function update(array $data, $id): bool
	{
		return Database::table($this->table)->where('id', '=', $id)->update($data);
	}
	
	// Xóa bản ghi
	public function delete(int $id): bool
	{
		if ($this->softDelete) {
			// Xóa mềm nếu bảng hỗ trợ Soft Deletes
			return Database::table($this->table)
						   ->where('id', '=', $id)
						   ->update(['deleted_at' => date('Y-m-d H:i:s')]);
		} else {
			// Xóa cứng nếu không hỗ trợ Soft Deletes
			return Database::table($this->table)
						   ->where('id', '=', $id)
						   ->delete();
		}
	}
	
	// Khôi phục bản ghi
	public function restore(int $id): bool
	{
		if (!$this->softDelete) {
			throw new \Exception("Restore is not supported for table '{$this->table}'");
		}
		
		return Database::table($this->table)
					   ->where('id', '=', $id)
					   ->update(['deleted_at' => null]);
	}
	
	// Lấy bản ghi đã xóa
	public function onlyTrashed(): array
	{
		if (!$this->softDelete) {
			throw new \Exception("Soft Deletes are not enabled for table '{$this->table}'");
		}
		
		return Database::table($this->table)->whereNotNull('deleted_at')->get();
	}
	
	// Quan hệ One-to-One
	public function hasOne(
			string $relatedModel,
			string $foreignKey,
			string $localKey = 'id',
	): ?Model {
		$related = new $relatedModel();
		$record = Database::table($related->table)
						  ->where($foreignKey, '=', $this->{$localKey})
						  ->first();
		
		if (!$record) {
			return null;
		}
		
		// Gắn dữ liệu vào đối tượng Model
		$related->fill($record);
		
		return $related;
	}
	
	// Quan hệ One-to-Many
	public function hasMany(
			string $relatedModel,
			string $foreignKey,
			string $localKey = 'id',
	): array {
		$related = new $relatedModel();
		$records = Database::table($related->table)
						   ->where($foreignKey, '=', $this->{$localKey})
						   ->get();
		
		// Gắn dữ liệu vào danh sách các đối tượng Model
		return array_map(function ($record) use ($relatedModel) {
			$instance = new $relatedModel();
			$instance->fill($record);
			
			return $instance;
		}, $records);
	}
	
	// Quan hệ Many-to-Many
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
		
		// Gắn dữ liệu vào danh sách các đối tượng Model
		return array_map(function ($record) use ($relatedModel) {
			$instance = new $relatedModel();
			$instance->fill($record);
			
			return $instance;
		}, $records);
	}
	
	// Gắn dữ liệu từ cơ sở dữ liệu vào Model
	public function fill(array $data): void
	{
		foreach ($data as $key => $value) {
			$this->{$key} = $value;
		}
	}
}
