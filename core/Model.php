<?php

namespace Core;


use Core\Database;


abstract class Model
{
	protected string $table;          // Tên bảng
	protected array $attributes = []; // Thuộc tính của model
	
	// Lấy tất cả bản ghi
	public function all(): array
	{
		return Database::table($this->table)->get();
	}
	
	
	// Tìm bản ghi theo ID
	public function find($id)
	{
		return Database::table($this->table)->where('id', '=', $id)->first();
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
}
