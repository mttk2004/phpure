<?php

namespace Core;


use Core\Database;


abstract class Model
{
	protected string $table;          // Tên bảng
	protected array $attributes = []; // Thuộc tính của model
	
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
		return Database::table($this->table)->get();
	}
	
	// Tìm bản ghi theo ID
	public function find($id)
	{
		$data = Database::table($this->table)->where('id', '=', $id)->first();
		
		return $data ? new static($data) : null;
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
	public function delete($id): bool
	{
		return Database::table($this->table)->where('id', '=', $id)->delete();
	}
	
	// Quan hệ One-to-One
	public function hasOne(string $relatedModel, string $foreignKey, string $localKey = 'id')
	{
		$related = new $relatedModel();
		
		return Database::table($related->table)
					   ->where($foreignKey, '=', $this->{$localKey})
					   ->first();
	}
	
	// Quan hệ One-to-Many
	public function hasMany(
			string $relatedModel,
			string $foreignKey,
			string $localKey = 'id',
	): array {
		$related = new $relatedModel(); // Khởi tạo model liên kết
		
		return Database::table($related->table)
					   ->where($foreignKey, '=', $this->{$localKey})
					   ->get();
	}
	
	public function belongsToMany(
			string $relatedModel,
			string $pivotTable,
			string $foreignKey,
			string $relatedKey,
			string $localKey = 'id',
			string $relatedLocalKey = 'id',
	): array {
		$related = new $relatedModel();
		
		// Thêm dấu backtick vào tên bảng và cột
		$sql = "SELECT `{$related->table}`.*
            FROM `{$related->table}`
            INNER JOIN `{$pivotTable}`
            ON `{$related->table}`.`{$relatedLocalKey}` = `{$pivotTable}`.`{$relatedKey}`
            WHERE `{$pivotTable}`.`{$foreignKey}` = ?";
		
		return Database::raw($sql, [$this->{$localKey}]);
	}
}
