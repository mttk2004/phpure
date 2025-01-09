<?php

namespace App\Controllers;

use Core\Controller;
use Core\Database;

class UserController extends Controller
{
	public function index()
	{
		// Lấy tất cả người dùng
		$users = Database::table('users')->select(['id', 'name'])->get();
		$this->render('user/index', ['users' => $users]);
	}
	
	public function store()
	{
		// Thêm người dùng mới
		Database::table('users')->insert([
				'name' => 'John Doe',
				'email' => 'john@example.com'
		]);
		
		echo "User Added Successfully!";
	}
	
	public function update()
	{
		// Cập nhật người dùng
		Database::table('users')->where('id', '=', 1)->update([
				'name' => 'Jane Doe'
		]);
		
		echo "User Updated Successfully!";
	}
	
	public function delete()
	{
		// Xóa người dùng
		Database::table('users')->where('id', '=', 1)->delete();
		echo "User Deleted Successfully!";
	}
}
